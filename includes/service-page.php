<?php
/**
 * includes/service-page.php — shared pieces for the 13 /services/<slug>/ pages and the /services/ hub (Phase 4).
 *
 * Pages keep their own copy, hero form, H2s, schema and page <style>. This file only holds what is
 * identical everywhere: the card data for each service (real client photo + alt that describes the photo),
 * the "related services" grid, the closing CTA band, breadcrumb markup/schema and the hero preload.
 * Helper-local variables are prefixed ($sp…) — pages own $svc, $area, $c, $card.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

/* Card data. Photos are the ten client photos in /assets/images/; several services have no photo of their own
   yet, so they borrow the closest real photo and the alt says only what the photo shows (never the material). */
$spCards = [
    'delivery' => ['photo' => 'gravel-stockpiles-job-site', 'icon' => 'truck',
        'alt' => 'Rows of dumped gravel loads across a staked site at sundown',
        'desc' => 'Bulk sand, gravel, rock and dirt dropped where the job needs it.',
        'bullets' => ['Sand, gravel, rock and dirt', 'Homes, farms and job sites', 'Sherman, Denison, Grayson County']],
    'driveways' => ['photo' => 'gravel-driveway-rural', 'icon' => 'route',
        'alt' => 'New gravel drive running across open pasture beside a green tractor',
        'desc' => 'Gravel driveways for homes, farms and rural lots around Sherman.',
        'bullets' => ['Gravel drives for rural lots', 'Base and top rock together', 'Material and work, one call']],
    'house-pads' => ['photo' => 'excavator-crushed-rock-pad', 'icon' => 'house',
        'alt' => 'Excavator spreading crushed rock across a graded pad under power lines',
        'desc' => 'Building pads raised with fill and base ahead of a new slab.',
        'bullets' => ['Pads for new slabs', 'Fill and base material', 'Ready for the slab crew']],
    'ponds' => ['photo' => 'pond-excavation-trees', 'icon' => 'droplets',
        'alt' => 'Freshly dug pond basin among mature trees',
        'desc' => 'Pond digging and shaping for rural and residential property.',
        'bullets' => ['New ponds dug out', 'Basins shaped around trees', 'Rip rap for pond banks']],
    'land-clearing' => ['photo' => 'pond-excavation-trees', 'icon' => 'trees',
        'alt' => 'Bare, worked ground opened up between standing trees',
        'desc' => 'Brush and trees cleared from lots ahead of a drive, pad or pond.',
        'bullets' => ['Brush and trees cleared', 'Ground ready for the build', 'Keep the trees you want']],
    'pea-gravel' => ['photo' => 'pea-gravel-closeup', 'icon' => 'footprints',
        'alt' => 'Close-up of small rounded pea gravel',
        'desc' => 'Small, rounded stone for walkways, beds, play areas and drainage.',
        'bullets' => ['Walkways and play areas', 'Landscape beds and drainage', 'Smooth, rounded stone']],
    'decomposed-granite' => ['photo' => 'crushed-red-granite-closeup', 'icon' => 'layers',
        'alt' => 'Close-up of crushed red granite',
        'desc' => 'Fine crushed granite for paths, patios and xeriscape beds.',
        'bullets' => ['Paths, patios and xeriscape', 'Packs firm underfoot', 'Natural earth-tone finish']],
    'road-base' => ['photo' => 'gravel-driveway-rural', 'icon' => 'milestone',
        'alt' => 'Long tan gravel drive cut across pasture',
        'desc' => 'Crushed base that compacts firm under drives, pads and parking.',
        'bullets' => ['Compacts into a firm layer', 'Under drives and pads', 'Parking and work areas']],
    '57-67-rock' => ['photo' => 'gravel-stockpiles-job-site', 'icon' => 'mountain',
        'alt' => 'Grey gravel loads dumped in rows on a staked site',
        'desc' => 'Crushed stone in #57 and #67 sizes for drainage, drives and concrete.',
        'bullets' => ['French drains and footings', 'Driveway top course', 'Concrete aggregate']],
    'fill-dirt' => ['photo' => 'excavator-crushed-rock-pad', 'icon' => 'tractor',
        'alt' => 'Excavator working on a graded dirt site',
        'desc' => 'Fill for leveling, backfill and raising grade on a lot.',
        'bullets' => ['Raise low spots and grade', 'Backfill walls and trenches', 'Build up pad areas']],
    'mason-sand' => ['photo' => 'flagstone-patio-fire-pit', 'icon' => 'hammer',
        'alt' => 'Flagstone patio with a square stone fire pit',
        'desc' => 'Fine, clean sand for mortar, paver bedding and sandboxes.',
        'bullets' => ['Mortar and stucco mixes', 'Paver and flagstone bedding', 'Soft sand for sandboxes']],
    'rip-rap' => ['photo' => 'rip-rap-crew-skid-steer', 'icon' => 'waves',
        'alt' => 'Two workers setting rip rap on filter fabric while a skid steer brings more rock',
        'desc' => 'Large rock that stops erosion on banks, pond edges and culverts.',
        'bullets' => ['Erosion control on banks', 'Pond edges and culverts', 'Set over filter fabric']],
    'river-rock' => ['photo' => 'pea-gravel-closeup', 'icon' => 'sprout',
        'alt' => 'Close-up of smooth, rounded stones',
        'desc' => 'Smooth, rounded rock for beds, dry creek beds and drainage.',
        'bullets' => ['Dry creek beds', 'Landscape bed cover', 'Downspout splash areas']],
];

if (!function_exists('sp_service')) {
    /** The config.php $services row for a slug. */
    function sp_service(string $slug): array {
        global $services;
        foreach ((array) $services as $spRow) if (($spRow['slug'] ?? '') === $slug) return $spRow;
        return ['name' => ucwords(str_replace('-', ' ', $slug)), 'slug' => $slug, 'description' => ''];
    }
}

if (!function_exists('sp_hero_preload')) {
    /** head.php imagesrcset preload for the hero <picture> (the only fetchpriority="high" image on the page). */
    function sp_hero_preload(string $base): array {
        return ['srcset' => pictureSrcset($base, 'avif'), 'sizes' => '100vw'];
    }
}

if (!function_exists('sp_breadcrumb_schema')) {
    /** BreadcrumbList: Home › Services › {name}. Pass '' as $slug for the /services/ hub itself. */
    function sp_breadcrumb_schema(string $name, string $slug = ''): array {
        global $siteUrl;
        $spBase = rtrim((string) $siteUrl, '/');
        $spItems = [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $spBase . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => $spBase . '/services/'],
        ];
        if ($slug !== '') $spItems[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $name, 'item' => $spBase . '/services/' . $slug . '/'];
        return ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $spItems];
    }
}

if (!function_exists('sp_breadcrumb')) {
    /** Visible breadcrumb for the dark interior hero. */
    function sp_breadcrumb(string $name = ''): string {
        $spOut = '<nav class="breadcrumb sp-breadcrumb" aria-label="Breadcrumb"><ol>'
               . '<li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>';
        if ($name === '') return $spOut . '<li aria-current="page">Services</li></ol></nav>';
        return $spOut . '<li><a href="/services/">Services</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>'
             . '<li aria-current="page">' . esc($name) . '</li></ol></nav>';
    }
}

if (!function_exists('sp_card')) {
    /** One required-component service card (services-grid / service-card-with-image), tint 1-3. */
    function sp_card(string $slug, int $tint, string $sizes = '(max-width: 440px) 100vw, (max-width: 720px) 50vw, (max-width: 1000px) 33vw, 380px'): string {
        global $spCards;
        $spC = $spCards[$slug] ?? null;
        if (!$spC) return '';
        $spSvc = sp_service($slug);
        $spLis = '';
        foreach ($spC['bullets'] as $spB) $spLis .= '<li>' . esc($spB) . '</li>';
        return '<article class="service-card-with-image card-tint-' . $tint . ' reveal-up reveal-delay-' . $tint . '">'
             . '<div class="service-card__image">' . pictureTag($spC['photo'], $spC['alt'], $sizes) . '</div>'
             . '<div class="service-card__body">'
             . '<div class="service-card__icon">' . icon($spC['icon'], 22) . '</div>'
             . '<h3>' . esc($spSvc['name']) . '</h3>'
             . '<p class="service-card__desc">' . esc($spC['desc']) . '</p>'
             . '<ul>' . $spLis . '</ul>'
             . '<a href="/services/' . esc($slug) . '/" class="service-card__cta">Learn more<span class="sr-only"> about ' . esc(strtolower($spSvc['name'])) . '</span></a>'
             . '</div></article>';
    }
}

if (!function_exists('sp_related_section')) {
    /**
     * "Other services you may need" — exactly 3 cards, tint 1→2→3. $titleHtml is a question H2 (may hold a
     * <span class="text-accent">); $answer is the 40-60 word answer paragraph under it.
     */
    function sp_related_section(array $slugs, string $titleHtml, string $answer): string {
        $spCardsOut = '';
        foreach (array_values(array_slice($slugs, 0, 3)) as $spI => $spSlug) $spCardsOut .= sp_card($spSlug, $spI + 1);
        return '<section class="section sp-related" aria-labelledby="sp-related-title"><div class="container">'
             . '<div class="section-title reveal-up"><span class="eyebrow-label">What We Do</span>'
             . '<h2 id="sp-related-title">' . $titleHtml . '</h2>'
             . '<p class="hero-answer">' . esc($answer) . '</p></div>'
             . '<div class="services-grid services-grid--3">' . $spCardsOut . '</div>'
             . '<div class="sp-related__foot"><a class="btn btn-secondary" href="/services/">See all ' . count($GLOBALS['services'] ?? []) . ' materials and services</a></div>'
             . '</div></section>';
    }
}

if (!function_exists('sp_final_cta')) {
    /** Closing CTA band (hazard-striped dark band). $title should read as a CTA ("Need … ?"), $copy one or two sentences. */
    function sp_final_cta(string $title, string $copy, string $buttonLabel = 'Get a free estimate'): string {
        global $phone, $phoneE164;
        return '<section class="cta-banner texture-grain edge-parallelogram-top sp-cta" aria-labelledby="sp-cta-title">'
             . '<span class="grain-layer" aria-hidden="true"></span><div class="container">'
             . '<div class="sp-cta__copy reveal-left"><span class="eyebrow">Call or send the form</span>'
             . '<h2 id="sp-cta-title">' . $title . '</h2><p>' . esc($copy) . '</p>'
             . '<span class="sp-cta__hours">' . icon('clock', 16) . 'Mon–Thu 6–5 · Fri 9–5 · Sat 9–2</span></div>'
             . '<div class="actions reveal-right">'
             . '<button type="button" class="btn btn-accent btn-lg" data-open-estimate>' . esc($buttonLabel) . '</button>'
             . '<a class="btn btn-outline-white btn-lg" href="tel:' . esc($phoneE164) . '">' . icon('phone', 18) . 'Call ' . esc(formatPhone($phone)) . '</a>'
             . '</div></div></section>';
    }
}
