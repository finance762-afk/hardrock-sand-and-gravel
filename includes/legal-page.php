<?php
/**
 * includes/legal-page.php — shared pieces for /privacy-policy/, /terms/, /cookie-policy/ and /accessibility/.
 *
 * Company facts come from config.php (Legal pages block): $siteName, $companyEntityType (empty until intake confirms it),
 * $companyState, $companyCounty, $legalUpdated, $email, $phone, $address. Nothing is invented — an unknown entity type
 * simply drops the suffix. Pair with includes/legal-page.css.
 * Helper-local variables are prefixed ($lg…) — pages own $svc, $area, $c, $card.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/inner-page.php';

if (!function_exists('legal_company_name')) {
    /** "HARDROCK Sand and Gravel" or "HARDROCK Sand and Gravel, LLC" once $companyEntityType is set. */
    function legal_company_name(): string {
        global $siteName, $companyEntityType;
        return trim((string) $siteName) . (trim((string) $companyEntityType) !== '' ? ', ' . trim((string) $companyEntityType) : '');
    }
}

if (!function_exists('legal_address')) {
    /** Public mailing location line from config.php (street/ZIP only when supplied). */
    function legal_address(): string {
        global $address, $addressPublic;
        $lgParts = [];
        if (($addressPublic ?? true) && !empty($address['street'])) $lgParts[] = $address['street'];
        $lgParts[] = trim(($address['city'] ?? '') . ', ' . ($address['state'] ?? '') . (!empty($address['zip']) ? ' ' . $address['zip'] : ''), ' ,');
        return implode(', ', $lgParts);
    }
}

if (!function_exists('legal_schema')) {
    /** WebPage + BreadcrumbList for a legal page. */
    function legal_schema(string $name, string $path, string $description): array {
        global $legalUpdated;
        return ip_webpage_schema('WebPage', $name, $path, $description, ['dateModified' => date('Y-m-d', strtotime((string) $legalUpdated))]);
    }
}

if (!function_exists('legal_hero_start')) {
    /** Opens the 40vh solid hero (no image): grain, breadcrumb, eyebrow. The page writes its own <h1 id="legal-title"> next. */
    function legal_hero_start(string $breadcrumbName): string {
        return '<section class="hero hero--legal texture-grain" aria-labelledby="legal-title"><span class="grain-layer" aria-hidden="true"></span>'
             . '<div class="container container-narrow">' . ip_breadcrumb($breadcrumbName) . '<span class="eyebrow">Legal</span>';
    }
}

if (!function_exists('legal_hero_end')) {
    /** One-line subtitle, Last Updated stamp, closes the hero. */
    function legal_hero_end(string $subtitle): string {
        global $legalUpdated;
        return '<p class="legal-hero__sub">' . esc($subtitle) . '</p>'
             . '<p class="legal-hero__updated">Last Updated: <time datetime="' . esc(date('Y-m-d', strtotime((string) $legalUpdated))) . '">' . esc($legalUpdated) . '</time></p>'
             . '</div></section>';
    }
}

if (!function_exists('legal_toc')) {
    /** "On this page" list for a legal document: [anchor-id => label]. */
    function legal_toc(array $sections): string {
        $lgOut = '<nav class="legal-toc" aria-label="On this page"><p class="legal-toc__title">On this page</p><ol>';
        foreach ($sections as $lgId => $lgLabel) $lgOut .= '<li><a href="#' . esc($lgId) . '">' . esc($lgLabel) . '</a></li>';
        return $lgOut . '</ol></nav>';
    }
}

if (!function_exists('legal_contact_block')) {
    /** The standard "Contact Us" block. */
    function legal_contact_block(): string {
        global $email, $phone, $phoneE164;
        return '<p><strong>' . esc(legal_company_name()) . '</strong><br>'
             . 'Email: <a href="mailto:' . esc($email) . '">' . esc($email) . '</a><br>'
             . 'Phone: <a href="tel:' . esc($phoneE164) . '">' . esc(formatPhone($phone)) . '</a><br>'
             . 'Location: ' . esc(legal_address()) . '</p>';
    }
}

if (!function_exists('legal_disclaimer')) {
    /** Closing attorney-review note required on every legal template. */
    function legal_disclaimer(string $documentType): string {
        global $companyState;
        return '<p class="legal-disclaimer">This ' . esc($documentType) . ' is provided as a general template. We recommend reviewing this document with a licensed '
             . esc($companyState) . ' attorney before publication.</p>';
    }
}
