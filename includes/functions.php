<?php
/**
 * includes/functions.php — shared helpers for head.php / header.php / footer.php and every page.
 *
 * Page skeleton (every page, in this order):
 *   require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
 *   require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
 *   $currentPage = 'home';            // home|services|areas|about|blog|faq|contact|legal|other — drives aria-current
 *   $pageType    = 'home';            // home|service|city|blog|about|faq|contact|other — lead attribution
 *   $pageTitle / $pageDescription / $canonicalUrl / $ogImage / $noindex / $heroPreload / $pageSchemas (all optional)
 *   include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
 *   include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
 *   ... page content ...
 *   include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
 *
 * Helper-local variables are prefixed ($fn…) — pages own $svc, $area, $c, $card.
 */

if (!function_exists('esc')) {
    /** HTML-escape for text and attribute values. */
    function esc($value): string {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('isActivePage')) {
    /** True when $page matches the page's $currentPage. */
    function isActivePage(string $page): bool {
        global $currentPage;
        return isset($currentPage) && $currentPage === $page;
    }
}

if (!function_exists('ariaCurrent')) {
    /** ' aria-current="page"' for the active nav link, '' otherwise. */
    function ariaCurrent(string $page): string {
        return isActivePage($page) ? ' aria-current="page"' : '';
    }
}

if (!function_exists('formatPhone')) {
    /** Normalizes any US phone string to the NAP form used site-wide: 903-420-0330. */
    function formatPhone($phone): string {
        $fnDigits = preg_replace('/\D+/', '', (string) $phone);
        if (strlen($fnDigits) === 11 && $fnDigits[0] === '1') $fnDigits = substr($fnDigits, 1);
        if (strlen($fnDigits) !== 10) return trim((string) $phone);
        return substr($fnDigits, 0, 3) . '-' . substr($fnDigits, 3, 3) . '-' . substr($fnDigits, 6);
    }
}

if (!function_exists('slugify')) {
    function slugify(string $text): string {
        $fnSlug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $text), '-'));
        return $fnSlug;
    }
}

if (!function_exists('getServiceSlug')) {
    /** 'House pads' -> 'house-pads'; '57/67 rock' -> '57-67-rock' (matches the slug column in config.php). */
    function getServiceSlug(string $name): string {
        global $services;
        foreach ((array) ($services ?? []) as $fnRow) {
            if (is_array($fnRow) && strcasecmp($fnRow['name'] ?? '', $name) === 0 && !empty($fnRow['slug'])) return $fnRow['slug'];
        }
        return slugify($name);
    }
}

if (!function_exists('getAreaSlug')) {
    /** 'Sherman, TX' -> 'sherman'; 'Grayson County, TX' -> 'grayson-county'. */
    function getAreaSlug(string $city): string {
        $fnName = preg_replace('/,\s*[A-Za-z]{2}\s*$/', '', trim($city));
        return slugify($fnName);
    }
}

if (!function_exists('areaUrl')) {
    /**
     * Link target for an area page. LINK INTEGRITY: only a page that exists on disk is linked directly.
     * Both layouts are checked (/service-areas/{slug}/ is what the Phase 4 prompt builds, /areas/{slug}/ is the
     * scaffold folder); until one exists the link falls back to the hub anchor.
     */
    function areaUrl(string $slug): string {
        $fnRoot = rtrim((string) ($_SERVER['DOCUMENT_ROOT'] ?? ''), '/');
        foreach (['/service-areas/', '/areas/'] as $fnBase) {
            if (is_file($fnRoot . $fnBase . $slug . '/index.php')) return $fnBase . $slug . '/';
        }
        return '/service-areas/#' . $slug;
    }
}

if (!function_exists('icon')) {
    /**
     * Inline Lucide SVG, read at render time from references/lucide-icons/<name>.svg (v6.2: no runtime injection,
     * no CDN). Returns '' when the file is missing so a bad name never breaks a page.
     */
    function icon(string $name, int $size = 20, string $class = ''): string {
        static $fnCache = [];
        if (!preg_match('/^[a-z0-9-]+$/', $name)) return '';
        if (!isset($fnCache[$name])) {
            $fnFile = dirname(__DIR__) . '/references/lucide-icons/' . $name . '.svg';
            $fnSvg = is_file($fnFile) ? (string) file_get_contents($fnFile) : '';
            $fnSvg = preg_replace('/<!--.*?-->/s', '', $fnSvg);
            $fnCache[$name] = trim((string) $fnSvg);
        }
        if ($fnCache[$name] === '') return '';
        $fnSvg = preg_replace('/\s+/', ' ', $fnCache[$name]);
        $fnAttrs = 'width="' . $size . '" height="' . $size . '" aria-hidden="true" focusable="false"' . ($class !== '' ? ' class="' . esc($class) . '"' : '');
        // Rewrite the opening <svg> tag only — inner shapes (e.g. mail's <rect width height>) keep their own sizes.
        return preg_replace_callback('/^<svg\b[^>]*>/', function ($fnTag) use ($fnAttrs) {
            return '<svg ' . $fnAttrs . ' ' . trim(preg_replace('/\s(width|height|class)="[^"]*"/', '', substr($fnTag[0], 4)));
        }, $fnSvg, 1);
    }
}

if (!function_exists('siteLogo')) {
    /**
     * Newest logo file in /assets/images/, or null (header/footer then render the text logo).
     * Derived marks are versioned (logo-mark-v2.png …) and never overwritten, so the highest version wins.
     * Returns ['src','width','height','ratio','class'].
     */
    function siteLogo(): ?array {
        static $fnLogo = false;
        if ($fnLogo !== false) return $fnLogo;
        $fnDir = dirname(__DIR__) . '/assets/images/';
        $fnFound = glob($fnDir . 'logo-mark-v*.png') ?: [];
        natsort($fnFound);
        $fnFound = array_reverse(array_values($fnFound));
        foreach (['logo-mark.png', 'logo.svg', 'logo.webp', 'logo.png'] as $fnName) $fnFound[] = $fnDir . $fnName;
        foreach ($fnFound as $fnPath) {
            if (!is_file($fnPath)) continue;
            $fnSize = @getimagesize($fnPath);
            if (!$fnSize || $fnSize[0] < 1 || $fnSize[1] < 1) continue;
            $fnRatio = $fnSize[0] / $fnSize[1];
            $fnClass = $fnRatio > 3 ? 'logo--wordmark' : ($fnRatio < 1.5 ? 'logo--square' : 'logo--combo');
            return $fnLogo = ['src' => '/assets/images/' . basename($fnPath), 'width' => $fnSize[0], 'height' => $fnSize[1], 'ratio' => $fnRatio, 'class' => $fnClass];
        }
        return $fnLogo = null;
    }
}

if (!function_exists('logoMarkup')) {
    /** The brand link contents: the logo image when one exists (true aspect ratio at the CSS height), else the text logo. */
    function logoMarkup(bool $footer = false): string {
        global $siteName;
        $fnLogo = siteLogo();
        if ($fnLogo) {
            $fnH = $fnLogo['class'] === 'logo--wordmark' ? 120 : ($fnLogo['class'] === 'logo--square' ? 88 : 96);
            $fnW = (int) round($fnH * $fnLogo['ratio']);
            return '<img src="' . esc($fnLogo['src']) . '" alt="' . esc($siteName) . ' logo" width="' . $fnW . '" height="' . $fnH . '" class="' . ($footer ? 'footer-logo-img' : esc($fnLogo['class'])) . '"'
                 . ($footer ? ' loading="lazy" decoding="async"' : '') . '>';
        }
        // Text logo: first word of the name in the mark badge, full name + descriptor beside it.
        $fnWords = preg_split('/\s+/', trim((string) $siteName));
        $fnFirst = array_shift($fnWords);
        $fnRest = implode(' ', $fnWords);
        return '<span class="logo-mark" aria-hidden="true">' . esc(strtoupper(substr($fnFirst, 0, 1))) . '</span>'
             . '<span class="logo-text"><span class="brand-name">' . esc($fnFirst) . '</span>'
             . ($fnRest !== '' ? '<span class="brand-sub">' . esc($fnRest) . '</span>' : '') . '</span>';
    }
}

if (!function_exists('requestCanonical')) {
    /** Canonical URL from the request path: query string dropped, index.php dropped, directories get a trailing slash. */
    function requestCanonical(): string {
        global $siteUrl;
        $fnPath = strtok((string) ($_SERVER['REQUEST_URI'] ?? '/'), '?#') ?: '/';
        $fnPath = preg_replace('#/index\.php$#', '/', $fnPath);
        $fnPath = preg_replace('#\.php$#', '', $fnPath);
        $fnPath = '/' . ltrim($fnPath, '/');
        if ($fnPath !== '/' && substr($fnPath, -1) !== '/' && is_dir(rtrim((string) $_SERVER['DOCUMENT_ROOT'], '/') . $fnPath)) $fnPath .= '/';
        return rtrim((string) $siteUrl, '/') . $fnPath;
    }
}

if (!function_exists('generateMetaTags')) {
    /** <title>, meta description and canonical link, escaped. */
    function generateMetaTags(string $title, string $description, string $canonical): string {
        return '<title>' . esc($title) . "</title>\n"
             . '<meta name="description" content="' . esc($description) . "\">\n"
             . '<link rel="canonical" href="' . esc($canonical) . "\">\n";
    }
}

if (!function_exists('jsonLd')) {
    /** One <script type="application/ld+json"> block. Arrays are encoded; strings are assumed to be valid JSON. */
    function jsonLd($data): string {
        $fnJson = is_string($data) ? $data : json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_PRETTY_PRINT);
        return '<script type="application/ld+json">' . "\n" . $fnJson . "\n" . '</script>' . "\n";
    }
}

if (!function_exists('openingHoursSpec')) {
    /** openingHoursSpecification rows from config.php $hours; consecutive days with identical hours are merged. Closed days are omitted. */
    function openingHoursSpec(array $hours): array {
        $fnRows = [];
        foreach ($hours as $fnDay) {
            if (empty($fnDay['opens']) || empty($fnDay['closes'])) continue;
            $fnKey = $fnDay['opens'] . '-' . $fnDay['closes'];
            $fnLast = count($fnRows) - 1;
            if ($fnLast >= 0 && $fnRows[$fnLast]['_key'] === $fnKey && $fnRows[$fnLast]['_adjacent'] === $fnDay['_idx'] - 1) {
                $fnRows[$fnLast]['dayOfWeek'][] = $fnDay['day'];
                $fnRows[$fnLast]['_adjacent'] = $fnDay['_idx'];
            } else {
                $fnRows[] = ['_key' => $fnKey, '_adjacent' => $fnDay['_idx'], '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => [$fnDay['day']], 'opens' => $fnDay['opens'], 'closes' => $fnDay['closes']];
            }
        }
        foreach ($fnRows as &$fnRow) { unset($fnRow['_key'], $fnRow['_adjacent']); } unset($fnRow);
        return $fnRows;
    }
}

if (!function_exists('generateLocalBusinessSchema')) {
    /**
     * LocalBusiness node from config.php. Every key is omitted when its source is empty — nothing is invented.
     * No self-serving rating markup, ever (real GBP review counts are visible page copy only).
     */
    function generateLocalBusinessSchema(): array {
        global $siteName, $siteUrl, $phoneE164, $email, $businessDescription, $address, $addressPublic, $geo, $gbp, $hours,
               $serviceAreas, $services, $socialLinks, $yearEstablished, $schemaImage;
        $fnBase = rtrim((string) $siteUrl, '/');
        $fnAddr = ['@type' => 'PostalAddress'];
        if (($addressPublic ?? true) && !empty($address['street'])) $fnAddr['streetAddress'] = $address['street'];
        $fnAddr['addressLocality'] = $address['city'] ?? '';
        $fnAddr['addressRegion'] = $address['state'] ?? '';
        if (!empty($address['zip'])) $fnAddr['postalCode'] = $address['zip'];
        $fnAddr['addressCountry'] = 'US';

        $fnHoursIn = [];
        foreach (array_values((array) $hours) as $fnI => $fnH) { $fnH['_idx'] = $fnI; $fnHoursIn[] = $fnH; }

        $fnAreas = [];
        foreach ((array) $serviceAreas as $fnArea) {
            $fnAreas[] = ['@type' => stripos($fnArea, 'county') !== false ? 'AdministrativeArea' : 'City', 'name' => $fnArea];
        }
        $fnOffers = [];
        foreach ((array) $services as $fnSvc) {
            $fnOffers[] = ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => $fnSvc['name'], 'url' => $fnBase . '/services/' . $fnSvc['slug'] . '/']];
        }
        $fnSame = array_values(array_filter(array_merge([$gbp['share_url'] ?? ''], array_values((array) $socialLinks))));

        $fnNode = [
            '@type' => 'LocalBusiness',
            '@id' => $fnBase . '/#organization',
            'name' => $siteName,
            'url' => $fnBase . '/',
            'telephone' => $phoneE164,
            'email' => $email,
            'description' => $businessDescription,
            'address' => $fnAddr,
        ];
        if (!empty($geo['latitude']) && !empty($geo['longitude'])) $fnNode['geo'] = ['@type' => 'GeoCoordinates', 'latitude' => $geo['latitude'], 'longitude' => $geo['longitude']];
        if (!empty($gbp['url'])) $fnNode['hasMap'] = $gbp['url'];
        if (!empty($schemaImage)) $fnNode['image'] = $schemaImage;
        elseif (($fnLogo = siteLogo())) $fnNode['image'] = $fnBase . $fnLogo['src'];
        if (!empty($yearEstablished)) $fnNode['foundingDate'] = (string) $yearEstablished;
        $fnSpec = openingHoursSpec($fnHoursIn);
        if ($fnSpec) $fnNode['openingHoursSpecification'] = $fnSpec;
        if ($fnAreas) $fnNode['areaServed'] = $fnAreas;
        if ($fnOffers) $fnNode['hasOfferCatalog'] = ['@type' => 'OfferCatalog', 'name' => $siteName . ' products and services', 'itemListElement' => $fnOffers];
        if ($fnSame) $fnNode['sameAs'] = $fnSame;
        return $fnNode;
    }
}

if (!function_exists('generateServiceSchema')) {
    /** Service node for a config.php $services row (name, slug, description); provider references the homepage #organization. */
    function generateServiceSchema(array $service): array {
        global $siteUrl, $serviceAreas;
        $fnBase = rtrim((string) $siteUrl, '/');
        $fnAreas = [];
        foreach ((array) $serviceAreas as $fnArea) {
            $fnAreas[] = ['@type' => stripos($fnArea, 'county') !== false ? 'AdministrativeArea' : 'City', 'name' => $fnArea];
        }
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            '@id' => $fnBase . '/services/' . ($service['slug'] ?? getServiceSlug($service['name'] ?? '')) . '/#service',
            'name' => $service['name'] ?? '',
            'serviceType' => $service['name'] ?? '',
            'description' => $service['description'] ?? '',
            'url' => $fnBase . '/services/' . ($service['slug'] ?? getServiceSlug($service['name'] ?? '')) . '/',
            'provider' => ['@id' => $fnBase . '/#organization'],
            'areaServed' => $fnAreas,
        ];
    }
}

if (!function_exists('generateFAQSchema')) {
    /** FAQPage from [['q' => '…', 'a' => '…'], …]. AI comprehension aid only — never described as a rich-result feature. */
    function generateFAQSchema(array $faqs): array {
        $fnItems = [];
        foreach ($faqs as $fnFaq) {
            $fnQ = $fnFaq['q'] ?? ($fnFaq['question'] ?? '');
            $fnA = $fnFaq['a'] ?? ($fnFaq['answer'] ?? '');
            if ($fnQ === '' || $fnA === '') continue;
            $fnItems[] = ['@type' => 'Question', 'name' => strip_tags($fnQ), 'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($fnA)]];
        }
        return ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $fnItems];
    }
}
