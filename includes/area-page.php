<?php
/**
 * includes/area-page.php — shared pieces for the /service-areas/ hub and the /service-areas/{slug}/ pages (Phase 6).
 *
 * Pages keep their own copy, H2s, schema facts and page <style>. This file only holds what is identical everywhere:
 * the per-area card data (photo + alt that describes the photo), breadcrumb markup/schema,
 * the compact "services available" list, the neighbouring-areas strip and the area WebPage/LocalBusiness schema.
 * Pair it with includes/service-page.php (hero preload, final CTA) and includes/area-page.css.
 * Helper-local variables are prefixed ($ap…) — pages own $svc, $area, $c, $card.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';

/* Card data per area slug (the slug is getAreaSlug() of a config.php $serviceAreas entry). Photos are client photos in
   /assets/images/; the alt says only what the photo shows, never a place the photo may not be. */
$apAreas = [
    'sherman' => [
        'name' => 'Sherman', 'label' => 'Sherman, TX', 'kind' => 'City',
        'photo' => 'excavator-crushed-rock-pad', 'alt' => 'Yellow excavator beside a long pile of light grey crushed rock on a graded pad, with power lines overhead',
        'blurb' => 'The Grayson County seat and HARDROCK\'s home base: in-town lots, building pads and acreage at the edge of the city.',
        'bullets' => ['Based in Sherman since 2019', 'Pads, drives and beds in town', 'Loads priced by phone'],
    ],
    'denison' => [
        'name' => 'Denison', 'label' => 'Denison, TX', 'kind' => 'City',
        'photo' => 'rip-rap-slope-filter-fabric', 'alt' => 'Two workers laying black filter fabric on a graded slope beside a pile of rip rap',
        'blurb' => 'The Katy railroad town about 11 miles north of Sherman, five miles from Denison Dam and Lake Texoma: bank, drainage and pond work.',
        'bullets' => ['Rip rap for banks and culverts', 'Pond and drainage rock', 'About 11 miles from Sherman'],
    ],
    'grayson-county' => [
        'name' => 'Grayson County', 'label' => 'Grayson County, TX', 'kind' => 'County',
        'photo' => 'pond-excavation-trees', 'alt' => 'Freshly dug pond basin among mature trees',
        'blurb' => 'Acreage across 979 square miles: long drives, ponds, clearing and fill for rural lots from the Red River south to the Collin County line.',
        'bullets' => ['Rural drives and culvert rock', 'Land clearing and ponds', 'Delivery across the county'],
    ],
];

if (!function_exists('ap_area')) {
    /** Card data row for an area slug (falls back to a bare row so a new config entry never fatals). */
    function ap_area(string $slug): array {
        global $apAreas;
        return $apAreas[$slug] ?? ['name' => ucwords(str_replace('-', ' ', $slug)), 'label' => ucwords(str_replace('-', ' ', $slug)) . ', TX', 'kind' => 'City',
                                   'photo' => 'gravel-stockpiles-job-site', 'alt' => 'Rows of dumped gravel loads across a staked site at sundown', 'blurb' => '', 'bullets' => []];
    }
}

if (!function_exists('ap_url')) {
    /** Absolute path of an area page. */
    function ap_url(string $slug): string { return '/service-areas/' . $slug . '/'; }
}

if (!function_exists('ap_breadcrumb')) {
    /** Visible breadcrumb for the dark interior hero: Home › Service Areas › {name} ('' = the hub itself). */
    function ap_breadcrumb(string $name = ''): string {
        $apOut = '<nav class="breadcrumb sp-breadcrumb" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>';
        if ($name === '') return $apOut . '<li aria-current="page">Service Areas</li></ol></nav>';
        return $apOut . '<li><a href="/service-areas/">Service Areas</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li><li aria-current="page">' . esc($name) . '</li></ol></nav>';
    }
}

if (!function_exists('ap_breadcrumb_schema')) {
    /** BreadcrumbList node (no @context): Home › Service Areas [› {name}]. */
    function ap_breadcrumb_schema(string $name = '', string $slug = ''): array {
        global $siteUrl;
        $apBase = rtrim((string) $siteUrl, '/');
        $apItems = [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $apBase . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Service Areas', 'item' => $apBase . '/service-areas/'],
        ];
        if ($slug !== '') $apItems[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $name, 'item' => $apBase . ap_url($slug)];
        return ['@type' => 'BreadcrumbList', 'itemListElement' => $apItems];
    }
}

if (!function_exists('ap_schema')) {
    /**
     * @graph for one area page: WebPage (about the homepage #organization), a LocalBusiness node carrying the SAME
     * @id as the homepage (…/#organization) so it merges instead of duplicating, with areaServed for THIS area only,
     * BreadcrumbList. The page appends its own FAQPage node (mirrors the visible FAQ; AI comprehension aid only).
     * $area: ['name', 'type' => City|AdministrativeArea, 'sameAs' => Wikipedia URL]. No ratings, ever.
     */
    function ap_schema(string $slug, string $pageName, string $description, array $area, string $image = ''): array {
        global $siteUrl, $siteName, $phoneE164, $address;
        $apBase = rtrim((string) $siteUrl, '/');
        $apPath = ap_url($slug);
        $apNode = ['@type' => $area['type'] ?? 'City', 'name' => $area['name'], 'containedInPlace' => ['@type' => 'State', 'name' => 'Texas']];
        if (!empty($area['sameAs'])) $apNode['sameAs'] = $area['sameAs'];
        $apGraph = [
            ['@type' => 'WebPage', '@id' => $apBase . $apPath . '#webpage', 'url' => $apBase . $apPath, 'name' => $pageName, 'description' => $description,
             'isPartOf' => ['@id' => $apBase . '/#website'], 'about' => ['@id' => $apBase . '/#organization'], 'inLanguage' => 'en-US']
             + ($image !== '' ? ['primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => $image]] : []),
            ['@type' => 'LocalBusiness', '@id' => $apBase . '/#organization', 'name' => $siteName, 'url' => $apBase . '/', 'telephone' => $phoneE164,
             'address' => ['@type' => 'PostalAddress', 'addressLocality' => $address['city'] ?? '', 'addressRegion' => $address['state'] ?? '', 'addressCountry' => 'US'],
             'areaServed' => $apNode],
            ap_breadcrumb_schema($area['name'], $slug),
        ];
        return ['@context' => 'https://schema.org', '@graph' => $apGraph];
    }
}

if (!function_exists('ap_service_list')) {
    /**
     * "Services available here": the first $featured slugs as larger tiles (icon, description, link), then every other
     * config.php service as a compact link chip. All 13 are always listed, so no service is orphaned from the area page.
     */
    function ap_service_list(array $featured, string $areaName): string {
        global $services, $spCards;
        $apTiles = '';
        foreach ($featured as $apSlug) {
            $apCard = $spCards[$apSlug] ?? null;
            if (!$apCard) continue;
            $apTiles .= '<li class="ap-svc__tile reveal-up"><a href="/services/' . esc($apSlug) . '/">' . icon($apCard['icon'], 24)
                      . '<b>' . esc(sp_service($apSlug)['name']) . '</b><span>' . esc($apCard['desc']) . '</span>'
                      . '<em>' . esc($areaName) . ' details</em></a></li>';
        }
        $apChips = '';
        foreach ((array) $services as $apRow) {
            if (in_array($apRow['slug'], $featured, true)) continue;
            $apChips .= '<li><a href="/services/' . esc($apRow['slug']) . '/">' . esc($apRow['name']) . '</a></li>';
        }
        return '<ul class="ap-svc__tiles">' . $apTiles . '</ul><ul class="ap-svc__chips" aria-label="More HARDROCK materials and services">' . $apChips . '</ul>';
    }
}

if (!function_exists('ap_nearby')) {
    /** Neighbouring-areas strip: link cards to every other config.php area (only ones that exist on disk) plus the hub. */
    function ap_nearby(string $currentSlug): string {
        global $serviceAreas;
        $apOut = '';
        foreach ((array) $serviceAreas as $apName) {
            $apSlug = getAreaSlug($apName);
            if ($apSlug === $currentSlug) continue;
            $apRow = ap_area($apSlug);
            $apOut .= '<li><a href="' . esc(areaUrl($apSlug)) . '">' . icon('map-pin', 18) . '<b>' . esc($apRow['label']) . '</b><span>' . esc($apRow['bullets'][0] ?? '') . '</span></a></li>';
        }
        return '<ul class="ap-nearby">' . $apOut . '<li><a href="/service-areas/">' . icon('map', 18) . '<b>All service areas</b><span>Sherman, Denison and Grayson County</span></a></li></ul>';
    }
}
