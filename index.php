<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$pageTitle       = 'Sand and Gravel Delivery in Sherman, TX | HARDROCK';
$pageDescription = 'HARDROCK Sand and Gravel delivers pea gravel, road base, 57/67 rock, fill dirt and rip rap in Sherman, Denison and Grayson County. Call ' . formatPhone($phone) . '.';
$canonicalUrl    = $siteUrl . '/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$schemaImage     = $siteUrl . '/assets/images/rip-rap-crew-skid-steer.jpg';
$currentPage     = 'home';
$pageType        = 'home';
$headerDark      = true;

/* Hero: the allocator's homepage hero (recommended_hero_image = the rip rap close-up), re-encoded under the 150KB hero budget */
$heroImage       = 'hero-rip-rap-v1';
$heroPreload     = ['srcset' => pictureSrcset($heroImage, 'avif'), 'sizes' => '100vw'];
$heroPreloadImage = '/assets/images/' . $heroImage . '-1600.webp';

$homeCity  = $address['city'];
$homeState = $address['state'];
$homeCall  = formatPhone($phone);
$homeTel   = 'tel:' . $phoneE164;

/* ---- Service cards: the seven services with a matching client photo lead the grid; the other six sit in the
   "more" tile so all 13 are one click from the homepage. Alt text describes what is in each photo. ------------- */
$homeCards = [
    ['slug' => 'delivery', 'photo' => 'gravel-stockpiles-job-site', 'icon' => 'truck',
     'alt'  => 'Rows of dumped gravel loads across a staked site at sundown',
     'desc' => 'Bulk sand, gravel, rock and dirt dropped where the job needs it.',
     'bullets' => ['Sand, gravel, rock and dirt', 'Homes, farms and job sites', 'Sherman, Denison, Grayson County']],
    ['slug' => 'driveways', 'photo' => 'gravel-driveway-rural', 'icon' => 'route',
     'alt'  => 'New gravel drive running across open pasture beside a green tractor',
     'desc' => 'Gravel driveways for homes, farms and rural lots around Sherman.',
     'bullets' => ['Gravel drives for rural lots', 'Road base and rock surfaces', 'Material and work together']],
    ['slug' => 'house-pads', 'photo' => 'excavator-crushed-rock-pad', 'icon' => 'house',
     'alt'  => 'Excavator spreading crushed rock across a graded pad under power lines',
     'desc' => 'Building pads raised with fill and base for a new slab.',
     'bullets' => ['Pads for new slabs', 'Fill and base material', 'Ready for the slab crew']],
    ['slug' => 'ponds', 'photo' => 'pond-excavation-trees', 'icon' => 'droplets',
     'alt'  => 'Freshly dug pond basin among mature trees',
     'desc' => 'Pond digging and shaping for rural and residential property.',
     'bullets' => ['New ponds dug out', 'Basins shaped between trees', 'Rip rap for pond banks']],
    ['slug' => 'pea-gravel', 'photo' => 'pea-gravel-closeup', 'icon' => 'footprints',
     'alt'  => 'Close-up of small rounded pea gravel',
     'desc' => 'Small, rounded stone for walkways, beds, play areas and drainage.',
     'bullets' => ['Walkways and play areas', 'Landscape beds and drainage', 'Smooth, rounded stone']],
    ['slug' => 'decomposed-granite', 'photo' => 'crushed-red-granite-closeup', 'icon' => 'layers',
     'alt'  => 'Close-up of crushed red granite',
     'desc' => 'Fine crushed granite for paths, patios and xeriscape beds.',
     'bullets' => ['Paths, patios and xeriscape', 'Packs firm underfoot', 'Warm red granite color']],
    ['slug' => 'rip-rap', 'photo' => 'rip-rap-crew-skid-steer', 'icon' => 'waves',
     'alt'  => 'Two workers setting rip rap on filter fabric while a skid steer brings more rock',
     'desc' => 'Large rock that stops erosion on banks, pond edges and culverts.',
     'bullets' => ['Erosion control on banks', 'Pond edges and culverts', 'Set over filter fabric']],
];
$homeCardSlugs = array_column($homeCards, 'slug');
$homeMore = array_values(array_filter($services, fn($s) => !in_array($s['slug'], $homeCardSlugs, true)));
$serviceByslug = array_column($services, null, 'slug');

/* ---- Recent work gallery (all ten client photos; captions say only what the photo shows) ---------------------- */
$galleryItems = [
    ['img' => 'rip-rap-crew-skid-steer', 'wide' => true,  'tag' => 'Rip rap',    'alt' => 'Crew hand-setting limestone rip rap over black filter fabric as a skid steer unloads more rock', 'cap' => 'Hand-setting rip rap over filter fabric while the skid steer feeds rock'],
    ['img' => 'gravel-driveway-rural',   'wide' => false, 'tag' => 'Driveways',  'alt' => 'Long gravel driveway cut across pasture with a tractor parked alongside', 'cap' => 'A new gravel drive running out across open pasture'],
    ['img' => 'pea-gravel-closeup',      'wide' => false, 'tag' => 'Pea gravel', 'alt' => 'Close-up of rounded grey and tan pea gravel', 'cap' => 'Pea gravel up close: small, rounded and smooth'],
    ['img' => 'pond-excavation-trees',   'wide' => true,  'tag' => 'Ponds',      'alt' => 'Pond basin dug out of grey clay among standing trees', 'cap' => 'A pond basin dug out between mature trees'],
    ['img' => 'crushed-red-granite-closeup', 'wide' => false, 'tag' => 'Granite', 'alt' => 'Close-up of crushed red granite chips', 'cap' => 'Crushed red granite, close up'],
    ['img' => 'flagstone-patio-fire-pit','wide' => false, 'tag' => 'Hardscape',  'alt' => 'Flagstone patio with a square stone fire pit, joints filled with fine gravel', 'cap' => 'Flagstone patio and fire pit set in fine gravel'],
    ['img' => 'gravel-stockpiles-job-site', 'wide' => true, 'tag' => 'Delivery', 'alt' => 'Rows of gravel loads dumped across a staked site at sunset', 'cap' => 'Gravel loads dropped in rows across a staked site'],
    ['img' => 'rip-rap-stockpile-closeup', 'wide' => false, 'tag' => 'Rip rap',  'alt' => 'Large grey limestone rip rap with a golf ball resting on it for scale', 'cap' => 'Limestone rip rap, with a golf ball for scale'],
    ['img' => 'excavator-crushed-rock-pad', 'wide' => false, 'tag' => 'Site work', 'alt' => 'Yellow excavator working a pile of crushed rock on a graded pad', 'cap' => 'Excavator spreading crushed rock on a graded pad'],
    ['img' => 'rip-rap-slope-filter-fabric', 'wide' => true, 'tag' => 'Rip rap', 'alt' => 'Workers rolling filter fabric down a cleared bank before placing rip rap', 'cap' => 'Filter fabric goes down the bank before the rock goes on'],
];

/* ---- FAQ: questions from the research brief that intake can answer truthfully ---------------------------------- */
$homeFaqs = [
    ['q' => 'Do you deliver sand and gravel to Sherman and the surrounding area?',
     'a' => 'Yes. HARDROCK Sand and Gravel delivers across Sherman, Denison and the rest of Grayson County. Call ' . $homeCall . ' or send the estimate form with your delivery address, the material and roughly how much you need, and we will confirm the area, the price and a delivery day.'],
    ['q' => 'How much sand or gravel do I need for my project?',
     'a' => 'Multiply length by width by depth in feet, then divide by 27 to get cubic yards. A 10 ft by 10 ft area 4 inches deep needs about 1.2 cubic yards. Add 5 to 10 percent for compaction and waste, and HARDROCK can check your numbers before you order.'],
    ['q' => 'Which type of sand or gravel should I use?',
     'a' => 'It depends on the job. Road base compacts firm under driveways and house pads, 57 and 67 rock drain well and top driveways, pea gravel and river rock suit walkways and beds, mason sand goes into mortar and paver bedding, and rip rap holds pond banks and culverts. Tell HARDROCK what you are building and we will recommend a material.'],
    ['q' => 'How is sand and gravel priced?',
     'a' => 'HARDROCK Sand and Gravel quotes each order by phone, because the price depends on the material, the amount and the delivery address. Call ' . $homeCall . ' Monday through Thursday from 6 AM, Friday from 9 AM, or Saturday from 9 AM to 2 PM to get a current price for your load.'],
];
/* FAQPage (AI comprehension aid only). The LocalBusiness + WebSite graph comes from head.php on the homepage. */
$schemaMarkup = '<script type="application/ld+json">' . json_encode(generateFAQSchema($homeFaqs), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) . '</script>';

/* ---- Ticker (decorative, aria-hidden): materials, work and the area served --------------------------------------- */
$tickerItems = [
    ['truck', 'Bulk delivery'], ['footprints', 'Pea gravel'], ['layers', 'Decomposed granite'], ['route', 'Road base'],
    ['mountain', '57/67 rock'], ['tractor', 'Fill dirt'], ['waves', 'Rip rap'], ['droplets', 'Ponds'],
    ['house', 'House pads'], ['trees', 'Land clearing'], ['map-pin', 'Sherman · Denison · Grayson County'],
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style>
/* ==========================================================================
   Homepage — HARDROCK Sand and Gravel (Phase 3, archetype bold-industrial)
   Page-specific composition only; framework.css owns the shared classes.
   Every value is a token (var()) or a color-mix() of tokens.
   ========================================================================== */

/* --- Headings: balanced wraps everywhere on this page --- */
.home-hero h1, .hr-services h2, .hr-services h3, .hr-gallery h2, .hr-cta h2, .hr-about h2, .hr-about h3, .hr-faq h2, .hr-faq summary, .hr-estimate h2, .hr-estimate h3, .hr-more h3 { text-wrap: balance; }

/* --- Hero: full-bleed rock, Ken Burns, 3-stop diagonal, all-caps condensed H1 --- */
.home-hero { padding-bottom: calc(var(--space-3xl) + 3.5vw); }
.home-hero .hero-bg picture { display: block; height: 100%; }
.home-hero .hero-bg img { height: 100%; animation: hr-kenburns 28s var(--ease) infinite alternate; transform-origin: 62% 40%; }
@keyframes hr-kenburns { from { transform: scale(1); } to { transform: scale(1.08) translate(-1%, -1%); } }
.home-hero .hero-overlay {
  background: linear-gradient(105deg,
    color-mix(in srgb, var(--color-dark) 94%, transparent) 0%,
    color-mix(in srgb, var(--color-dark) 78%, transparent) 46%,
    color-mix(in srgb, var(--color-accent) 30%, color-mix(in srgb, var(--color-dark) 40%, transparent)) 100%);
}
.home-hero .hero-title { text-transform: uppercase; letter-spacing: .01em; line-height: 1.02; max-width: none; }
.home-hero .hero-title .text-accent { text-decoration: none; color: var(--color-accent-bright); }
.home-hero .hero-text { position: relative; padding-left: var(--space-lg); }
.home-hero .hero-text::before { content: ""; position: absolute; left: 0; top: var(--space-xs); bottom: var(--space-xs); width: var(--space-1); background: linear-gradient(to bottom, var(--color-accent), color-mix(in srgb, var(--color-accent) 10%, transparent)); }
.home-hero .hero-chips li { backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); }
.home-hero .hero-form-card { border-top: var(--space-1) solid var(--color-accent); }
.home-hero .hero-form-card h2 { text-transform: uppercase; letter-spacing: .02em; }
.home-hero .hero-form .consent { color: var(--color-ink-2); }
.home-hero .hero-form .consent a { color: var(--color-primary); }
@media (max-width: 560px) {
  .home-hero .hero-text { padding-left: var(--space-md); }
  .home-hero { padding-bottom: calc(var(--space-2xl) + 3.5vw); }
}

/* --- Ticker: sits on the paper the hero's slant reveals --- */
.hr-ticker { background: var(--color-paper); border-top: 0; }
.hr-ticker .ticker-track svg { color: var(--color-accent-dark); }
.hr-ticker .ticker-track > * + *::before { content: ""; width: var(--space-1); height: var(--space-1); border-radius: var(--radius-full); background: var(--color-line); margin-right: var(--space-lg); }

/* --- Proof strip: dark brushed band, accent-colored key words --- */
.hr-proof { padding-top: calc(var(--space-2xl) + 3.5vw); padding-bottom: var(--space-2xl); color: var(--color-white);
  background: linear-gradient(115deg, var(--color-dark) 0%, var(--color-dark-alt) 55%, var(--color-primary-deep) 130%); }
.hr-proof .stat-item { border-left-color: color-mix(in srgb, var(--color-white) 14%, transparent); }
.hr-proof .stat-number { color: var(--color-white); font-size: clamp(1.6rem, 1.1rem + 1.2vw, 2.25rem); text-transform: uppercase; white-space: nowrap; }
.hr-proof .stat-number span { color: var(--color-accent-bright); }
.hr-proof .stat-label { color: color-mix(in srgb, var(--color-white) 72%, transparent); }

/* --- Gallery: head row with a scroll hint, two faint rings --- */
.hr-gallery { background: var(--color-surface); }
.hr-gallery .gallery-head { display: grid; grid-template-columns: minmax(0, 1fr) auto; align-items: end; gap: var(--space-lg); margin-bottom: var(--space-xl); }
.hr-gallery .gallery-head p { margin: 0; color: var(--color-ink-2); max-width: 60ch; }
.hr-gallery .gallery-track { padding-inline: max(var(--space-md), calc((100vw - var(--container)) / 2)); scroll-padding-inline: max(var(--space-md), calc((100vw - var(--container)) / 2)); }
.hr-gallery .gallery-item { box-shadow: var(--shadow); }
.hr-gallery .gallery-item:focus-within { outline: 3px solid var(--color-accent); outline-offset: 2px; }
.hr-gallery .floating-ring--a { top: var(--space-2xl); right: -6rem; }
.hr-gallery .floating-ring--b { bottom: -8rem; left: -7rem; width: 240px; height: 240px; animation-duration: 24s; }
.hr-gallery .gallery-foot { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: var(--space-md); margin-top: var(--space-lg); }
@media (max-width: 700px) { .hr-gallery .gallery-head { grid-template-columns: 1fr; } }

/* --- Services: square-shouldered industrial cards + a dark "more materials" tile --- */
.hr-services { background: var(--color-paper); }
.hr-services .section-title { max-width: 68ch; }
.hr-services .service-card-with-image { border-radius: var(--radius-sm); }
.hr-services .service-card-with-image h3 { text-transform: uppercase; letter-spacing: .02em; font-size: 1.25rem; }
.hr-services .service-card__image::after { content: ""; position: absolute; inset: auto 0 0 0; height: var(--space-1); background: var(--color-accent); transform: scaleX(.18); transform-origin: left; transition: transform var(--transition-slow); }
.hr-services .service-card-with-image:hover .service-card__image::after { transform: scaleX(1); }
.hr-services .service-card-with-image:has(.service-card__cta:focus-visible) { outline: 3px solid var(--color-accent); outline-offset: 2px; }
.hr-more { position: relative; isolation: isolate; overflow: clip; display: grid; align-content: start; gap: var(--space-sm); padding: var(--space-lg); border-radius: var(--radius-sm); color: var(--color-white);
  background: linear-gradient(150deg, var(--color-dark) 0%, var(--color-primary-deep) 100%); }
.hr-more::before { content: ""; position: absolute; inset: 0 0 auto 0; height: var(--space-sm); background: repeating-linear-gradient(-45deg, var(--color-accent) 0 var(--space-sm), var(--color-dark) var(--space-sm) var(--space-lg)); }
.hr-more h3 { color: var(--color-white); text-transform: uppercase; letter-spacing: .02em; margin-top: var(--space-sm); font-size: 1.25rem; }
.hr-more p { margin: 0; font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 76%, transparent); }
.hr-more ul { list-style: none; margin: 0; padding: 0; display: grid; gap: var(--space-1); }
.hr-more ul a { display: flex; align-items: center; justify-content: space-between; gap: var(--space-xs); min-height: 2.5rem; padding: 0 var(--space-xs); border-bottom: 1px solid color-mix(in srgb, var(--color-white) 12%, transparent); color: var(--color-white); text-decoration: none; font-weight: 600; }
.hr-more ul a svg { color: var(--color-accent-bright); transition: transform var(--transition); }
.hr-more ul a:hover svg, .hr-more ul a:focus-visible svg { transform: translateX(var(--space-1)); }
.hr-services .services-foot { display: flex; justify-content: center; margin-top: var(--space-xl); }

/* --- Mid-page CTA band: parallelogram top, hazard stripe along the bottom edge --- */
.hr-cta { padding-bottom: calc(var(--section-pad) + var(--space-sm)); }
.hr-cta::after { content: ""; position: absolute; inset: auto 0 0 0; height: var(--space-sm); background: repeating-linear-gradient(-45deg, var(--color-accent) 0 var(--space-md), var(--color-dark) var(--space-md) var(--space-xl)); }
.hr-cta h2 { text-transform: uppercase; letter-spacing: .02em; }
.hr-cta .hr-cta__copy { max-width: 58ch; }
.hr-cta .hr-cta__hours { display: inline-flex; align-items: center; gap: var(--space-xs); margin-top: var(--space-sm); font-family: var(--font-accent); text-transform: uppercase; letter-spacing: .12em; font-size: var(--fs-small); color: var(--color-accent-bright); }
.hr-cta .actions .btn-accent { box-shadow: var(--shadow-lg); }

/* --- Reviews band: light, never grained --- */
.home-reviews { background: var(--color-paper-2); }

/* --- About / process: asymmetric 60/40, photo dropped and framed, clipped corner --- */
.hr-about { background: var(--color-paper); }
.hr-about .about-split { grid-template-columns: minmax(0, 1.5fr) minmax(0, 1fr); align-items: start; }
.hr-about .about-left { display: grid; gap: var(--space-md); }
.hr-about .about-left > p { margin: 0; color: var(--color-ink-2); max-width: 62ch; }
.hr-about .about-right { margin-top: var(--space-4xl); }
.hr-about .hr-about-photo { position: relative; }
.hr-about .hr-about-photo::before { content: ""; position: absolute; inset: calc(-1 * var(--space-lg)) var(--space-lg) var(--space-lg) calc(-1 * var(--space-lg)); border: 2px solid var(--color-accent); border-radius: var(--radius-sm); z-index: 0; }
.hr-about .hr-about-photo picture { position: relative; z-index: 1; display: block; aspect-ratio: 4 / 4.6; overflow: hidden; box-shadow: var(--shadow-lg); clip-path: polygon(0 0, 100% 0, 100% 88%, 86% 100%, 0 100%); }
.hr-about .hr-about-photo img { width: 100%; height: 100%; object-fit: cover; object-position: 55% 50%; filter: var(--photo-grade); }
.hr-about .about-stat-card { display: grid; gap: var(--space-1); border-left: var(--space-1) solid var(--color-accent); }
.hr-about .about-stat-card b { font-family: var(--font-accent); font-size: 2rem; line-height: 1; text-transform: uppercase; color: var(--color-ink); }
.hr-about .about-stat-card span { font-size: var(--fs-small); color: var(--color-muted); }
.hr-about .process-steps li b { text-transform: uppercase; letter-spacing: .03em; }
.hr-about .hr-about-links { display: flex; flex-wrap: wrap; gap: var(--space-sm) var(--space-lg); align-items: center; margin-top: var(--space-sm); }
@media (max-width: 900px) {
  .hr-about .about-split { grid-template-columns: 1fr; }
  .hr-about .about-right { margin: var(--space-xl) var(--space-lg) var(--space-xl) var(--space-lg); }
}

/* --- FAQ on a dark slanted band --- */
.hr-faq .section-title { max-width: 60ch; }
.hr-faq .faq { border-top-color: color-mix(in srgb, var(--color-white) 14%, transparent); }
.hr-faq .faq summary { color: var(--color-white); min-height: 2.75rem; }
.hr-faq .faq summary::after { color: var(--color-accent-bright); }
.hr-faq .faq summary:hover { color: var(--color-accent-bright); }
.hr-faq .faq p { color: color-mix(in srgb, var(--color-white) 80%, transparent); }
.hr-faq .hr-faq-more { margin-top: var(--space-xl); }
.hr-faq .hr-faq-more a { color: var(--color-accent-bright); font-weight: 600; }

/* --- Estimate section: form card + what happens next --- */
.hr-estimate { background: var(--color-surface); }
.hr-estimate .card { display: grid; gap: var(--space-md); border-top: var(--space-1) solid var(--color-accent); border-radius: var(--radius-sm); }
.hr-estimate .card h2 { text-transform: uppercase; letter-spacing: .02em; }
.hr-estimate .form-consent-item { margin: 0 0 var(--space-sm); }
.hr-estimate .estimate-form .btn { width: auto; justify-self: start; }
.hr-estimate .hr-next h3 { text-transform: uppercase; letter-spacing: .03em; }
.hr-estimate .hr-next .nap { padding-top: var(--space-lg); border-top: 1px solid var(--color-line); }
.hr-estimate .hr-next .hr-area { margin-top: var(--space-lg); font-size: var(--fs-small); color: var(--color-ink-2); }
@media (max-width: 560px) { .hr-estimate .estimate-form .btn { width: 100%; } }

/* --- Cross-document view transitions (C13) --- */
::view-transition-old(root) { animation: hr-vt-out .18s ease both; }
::view-transition-new(root) { animation: hr-vt-in .22s ease both; }
@keyframes hr-vt-out { to { opacity: 0; } }
@keyframes hr-vt-in { from { opacity: 0; } }
@media (prefers-reduced-motion: reduce) {
  .home-hero .hero-bg img { animation: none; }
  ::view-transition-old(root), ::view-transition-new(root) { animation: none; }
}
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo slant-bottom home-hero" aria-labelledby="home-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Close-up of grey limestone rip rap stacked in a pile', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <span class="grain" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-grid hero-grid--form">
      <div class="hero-text">
        <span class="eyebrow"><?php echo esc($homeCity); ?>, <?php echo esc($homeState); ?> · Grayson County</span>
        <h1 class="hero-title" id="home-hero-title"><span class="text-accent">Sand and Gravel</span> Delivered Across Sherman, TX</h1>
        <p class="hero-answer">HARDROCK Sand and Gravel delivers gravel, rock, sand and fill dirt across Sherman and Grayson County, and builds the driveways, pads and ponds they go into.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($homeTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($homeCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('calendar-check', 16); ?>Est. <?php echo esc($yearEstablished); ?></li>
          <li><?php echo icon('hard-hat', 16); ?>Materials + site work</li>
          <li><?php echo icon('clock', 16); ?>Open 6 AM Mon–Thu</li>
        </ul>
      </div>

      <aside class="hero-form-card" id="estimate-form">
        <h2>Get a free estimate</h2>
        <p class="hero-form-tagline">No obligation. Tell us the material and the address.</p>
        <form action="<?php echo esc($formAction); ?>" method="POST" class="hero-form">
          <input type="hidden" name="_next" value="<?php echo esc($siteUrl); ?>/thank-you">
          <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">
          <input type="hidden" name="form_location" value="hero">
          <input type="hidden" name="consent_version" value="v2.1">
          <input type="hidden" name="consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8'); ?>">
          <?php echo p1_attribution_fields('hero'); ?>
          <div class="form-row"><label class="sr-only" for="hero-name">Name</label><input id="hero-name" type="text" name="name" placeholder="Name" autocomplete="name" required></div>
          <div class="form-row"><label class="sr-only" for="hero-phone">Phone</label><input id="hero-phone" type="tel" name="phone" placeholder="Phone" autocomplete="tel" inputmode="tel" required></div>
          <div class="form-row"><label class="sr-only" for="hero-service">Service</label><select id="hero-service" name="service"><?php echo p1_service_options(); ?></select></div>
          <?php echo p1_consent_row('hero'); ?>
          <button type="submit" class="btn btn-primary btn-block">Get my free estimate</button>
        </form>
      </aside>
    </div>
  </div>
</section>

<!-- ============ TICKER ============ -->
<div class="ticker-strip hr-ticker" aria-hidden="true">
  <div class="ticker-track">
    <?php for ($tickerPass = 0; $tickerPass < 2; $tickerPass++): foreach ($tickerItems as $tick): ?>
    <span><?php echo icon($tick[0], 18); ?><?php echo esc($tick[1]); ?></span>
    <?php endforeach; endfor; ?>
  </div>
</div>

<!-- ============ PROOF STRIP (intake facts only) ============ -->
<section class="stats-band texture-grain slant-top hr-proof" aria-label="<?php echo esc($siteName); ?> at a glance">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="stats-row">
      <div class="stat-item reveal-up reveal-delay-1"><b class="stat-number"><span><?php echo count($services); ?></span> Services</b><span class="stat-label">Eight bulk materials, plus driveways, pads, ponds and clearing</span></div>
      <div class="stat-item reveal-up reveal-delay-2"><b class="stat-number">Dean <span>Jones</span></b><span class="stat-label">Owner of HARDROCK Sand and Gravel</span></div>
      <div class="stat-item reveal-up reveal-delay-3"><b class="stat-number">Grayson <span>County</span></b><span class="stat-label">Sherman, Denison and the county around them</span></div>
      <div class="stat-item reveal-up reveal-delay-4"><b class="stat-number">Open <span>Sat</span></b><span class="stat-label">Saturdays 9 AM to 2 PM for weekend projects</span></div>
    </div>
  </div>
</section>

<!-- ============ RECENT WORK GALLERY (signature section) ============ -->
<section class="section gallery-section hr-gallery" aria-labelledby="home-gallery-title">
  <span class="floating-ring floating-ring--a" aria-hidden="true"></span>
  <span class="floating-ring floating-ring--b" aria-hidden="true"></span>
  <div class="container">
    <div class="gallery-head reveal-left">
      <div class="section-title">
        <span class="eyebrow">Recent Work</span>
        <h2 id="home-gallery-title">What does HARDROCK's <span class="text-accent">recent work</span> look like?</h2>
        <p>HARDROCK Sand and Gravel's work around Grayson County includes rip rap set by hand over filter fabric, gravel drives across open pasture, a pond basin dug between trees, and close-ups of the rock and gravel HARDROCK sells.</p>
      </div>
      <p class="gallery-hint"><?php echo icon('arrow-right', 16); ?>Scroll for more</p>
    </div>
  </div>
  <div class="gallery-track" data-p1-dynamic tabindex="0" aria-label="Project photos — scroll horizontally">
    <?php foreach ($galleryItems as $gal): ?>
    <figure class="gallery-item<?php echo $gal['wide'] ? ' gallery-item--wide' : ''; ?>">
      <?php echo pictureTag($gal['img'], $gal['alt'], $gal['wide'] ? '(max-width: 700px) 80vw, 480px' : '(max-width: 700px) 60vw, 320px'); ?>
      <figcaption><span class="gallery-item__tag"><?php echo esc($gal['tag']); ?></span><span class="gallery-item__cap"><?php echo esc($gal['cap']); ?></span></figcaption>
    </figure>
    <?php endforeach; ?>
  </div>
  <div class="container">
    <div class="gallery-foot">
      <a class="btn btn-secondary" href="/services/">See all services</a>
    </div>
  </div>
</section>

<!-- ============ SERVICES ============ -->
<section class="section hr-services" aria-label="Sand and gravel services">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow-label">What We Do</span>
      <h2>Which <span class="text-accent">sand, gravel and site work</span> jobs does HARDROCK handle in Sherman?</h2>
      <p class="hero-answer">HARDROCK Sand and Gravel sells and delivers eight bulk materials, from pea gravel and decomposed granite to road base, 57/67 rock, fill dirt, mason sand, river rock and rip rap. The same company also builds driveways and house pads, digs ponds and clears land in Sherman, Denison and Grayson County, so one call covers the material and the work.</p>
    </div>

    <div class="services-grid">
      <?php foreach ($homeCards as $cardIdx => $card):
        $cardTint = ($cardIdx % 3) + 1;
        $cardSvc  = $serviceByslug[$card['slug']]; ?>
      <article class="service-card-with-image card-tint-<?php echo $cardTint; ?> reveal-up reveal-delay-<?php echo $cardTint; ?>">
        <div class="service-card__image">
          <?php echo pictureTag($card['photo'], $card['alt'], '(max-width: 440px) 100vw, (max-width: 720px) 50vw, (max-width: 1000px) 33vw, 290px'); ?>
        </div>
        <div class="service-card__body">
          <div class="service-card__icon"><?php echo icon($card['icon'], 22); ?></div>
          <h3><?php echo esc($cardSvc['name']); ?></h3>
          <p class="service-card__desc"><?php echo esc($card['desc']); ?></p>
          <ul>
            <?php foreach ($card['bullets'] as $cardBullet): ?>
            <li><?php echo esc($cardBullet); ?></li>
            <?php endforeach; ?>
          </ul>
          <a href="/services/<?php echo esc($card['slug']); ?>/" class="service-card__cta">Learn more<span class="sr-only"> about <?php echo esc(strtolower($cardSvc['name'])); ?></span></a>
        </div>
      </article>
      <?php endforeach; ?>

      <aside class="hr-more reveal-scale" aria-labelledby="home-more-title">
        <h3 id="home-more-title"><?php echo count($homeMore); ?> more materials &amp; services</h3>
        <p>Base, fill and landscape rock, plus clearing ahead of a build.</p>
        <ul>
          <?php foreach ($homeMore as $moreSvc): ?>
          <li><a href="/services/<?php echo esc($moreSvc['slug']); ?>/"><?php echo esc($moreSvc['name']); ?><?php echo icon('arrow-right', 16); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </aside>
    </div>

    <div class="services-foot">
      <a href="/services/" class="btn btn-secondary">View All <?php echo count($services); ?> Services →</a>
    </div>
  </div>
</section>

<!-- ============ MID-PAGE CTA ============ -->
<section class="cta-banner texture-grain edge-parallelogram-top hr-cta" aria-labelledby="home-cta-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="hr-cta__copy reveal-left">
      <span class="eyebrow">Plan the week</span>
      <h2 id="home-cta-title">Need a load on site this week?</h2>
      <p>HARDROCK Sand and Gravel opens at 6 AM Monday through Thursday, so an early call is the quickest way to get gravel, base or fill on the schedule before your crew or your weekend project needs it. Saturday hours run 9 AM to 2 PM.</p>
      <span class="hr-cta__hours"><?php echo icon('clock', 16); ?>Mon–Thu 6–5 · Fri 9–5 · Sat 9–2</span>
    </div>
    <div class="actions reveal-right">
      <button type="button" class="btn btn-accent btn-lg" data-open-estimate>Get a free estimate</button>
      <a class="btn btn-outline-white btn-lg" href="<?php echo esc($homeTel); ?>"><?php echo icon('phone', 18); ?>Call <?php echo esc($homeCall); ?></a>
    </div>
  </div>
</section>

<!-- ============ GOOGLE REVIEWS (Page One feed; renders nothing when the feed is empty) ============ -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
$homeReviews = p1_google_reviews($slug, ['heading' => 'What ' . $homeCity . ' customers say on Google']);
if ($homeReviews !== ''): ?>
<section class="section home-reviews" aria-label="Google reviews"><div class="container"><?php echo $homeReviews; ?></div></section>
<?php endif; ?>

<!-- ============ ABOUT / PROCESS (asymmetric) ============ -->
<section class="section hr-about" aria-labelledby="home-about-title">
  <div class="container-wide">
    <div class="about-split">
      <div class="about-left reveal-left">
        <span class="eyebrow">About HARDROCK</span>
        <h2 id="home-about-title">Who is behind <span class="text-accent">HARDROCK Sand and Gravel</span>?</h2>
        <p>HARDROCK Sand and Gravel is a Sherman, Texas sand and gravel supplier owned by <?php echo esc($ownerName); ?>, in business since <?php echo esc($yearEstablished); ?>. HARDROCK sells and delivers pea gravel, decomposed granite, road base, 57/67 rock, fill dirt, mason sand, river rock and rip rap to homes, farms and job sites across Sherman, Denison and Grayson County.</p>
        <p>HARDROCK also does the work the material is for: gravel driveways, house pads, ponds and land clearing. A rural property owner can have the lot cleared, the pad built, the drive laid and the pond dug by the company that hauls the rock, instead of lining up a supplier and a separate contractor for each step.</p>
        <h3>How does an order with HARDROCK work?</h3>
        <ol class="process-steps">
          <li><b>Tell us the job</b><span>Call or send the form with the material or work you need and the address.</span></li>
          <li><b>Check the quantity</b><span>Length × width × depth in feet, divided by 27, gives cubic yards. We can check the math.</span></li>
          <li><b>Get the price and a day</b><span>HARDROCK quotes your load or job by phone and sets the delivery or work date.</span></li>
          <li><b>Load dropped or job done</b><span>The material is dumped where you need it, or the drive, pad or pond is built.</span></li>
        </ol>
        <div class="hr-about-links">
          <a class="btn btn-primary" href="/about/">More about HARDROCK</a>
          <a class="link-call" href="<?php echo esc($homeTel); ?>"><?php echo icon('phone', 18); ?><?php echo esc($homeCall); ?></a>
        </div>
      </div>
      <div class="about-right reveal-right">
        <div class="hr-about-photo">
          <?php echo pictureTag('rip-rap-slope-filter-fabric', 'Two workers rolling black filter fabric down a cleared bank beside piles of limestone rip rap', '(max-width: 900px) 100vw, 540px'); ?>
          <div class="about-stat-card">
            <b><?php echo (int) $yearsInBusiness; ?> years</b>
            <span>supplying Grayson County</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain slant-top hr-faq" aria-labelledby="home-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="home-faq-title">What do Sherman customers ask before ordering <span class="text-accent">sand and gravel</span>?</h2>
      <p>Most questions HARDROCK Sand and Gravel hears before an order come down to four things: whether we deliver to your address, how much material the job needs, which material fits the job, and how a load is priced.</p>
    </div>
    <div class="faq-grid">
      <?php foreach ($homeFaqs as $faqIdx => $faq): ?>
      <details class="faq reveal-up reveal-delay-<?php echo ($faqIdx % 2) + 1; ?>"<?php echo $faqIdx < 2 ? ' open' : ''; ?>>
        <summary><?php echo esc($faq['q']); ?></summary>
        <p><?php echo esc($faq['a']); ?></p>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ ESTIMATE ============ -->
<section class="section hr-estimate" id="estimate" aria-labelledby="home-estimate-title">
  <div class="container estimate">
    <div class="card reveal-left">
      <span class="eyebrow">Free estimate</span>
      <h2 id="home-estimate-title">Tell us about the job</h2>
      <form class="estimate-form" action="<?php echo esc($formAction); ?>" method="POST">
        <input type="hidden" name="_next" value="<?php echo esc($siteUrl); ?>/thank-you">
        <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">
        <input type="hidden" name="form_location" value="estimate-section">
        <input type="hidden" name="consent_version" value="v2.1">
        <input type="hidden" name="consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8'); ?>">
        <?php echo p1_attribution_fields('estimate-section'); ?>
        <div class="form-grid">
          <div class="field">
            <label for="estimate-name">Your name</label>
            <input type="text" id="estimate-name" name="name" autocomplete="name" required>
          </div>
          <div class="field">
            <label for="estimate-phone">Phone</label>
            <input type="tel" id="estimate-phone" name="phone" autocomplete="tel" inputmode="tel" required>
          </div>
          <div class="field">
            <label for="estimate-email">Email</label>
            <input type="email" id="estimate-email" name="email" autocomplete="email" required>
          </div>
          <div class="field">
            <label for="estimate-service">Material or service</label>
            <select id="estimate-service" name="service"><?php echo p1_service_options(); ?></select>
          </div>
          <div class="field full">
            <label for="estimate-street">Delivery or job address (optional)</label>
            <input type="text" id="estimate-street" name="address_street" autocomplete="street-address">
          </div>
          <div class="field">
            <label for="estimate-city">City (optional)</label>
            <input type="text" id="estimate-city" name="address_city" autocomplete="address-level2">
          </div>
          <div class="field">
            <label for="estimate-zip">ZIP (optional)</label>
            <input type="text" id="estimate-zip" name="address_zip" autocomplete="postal-code" inputmode="numeric">
          </div>
          <input type="hidden" name="address_state" value="<?php echo esc($homeState); ?>">
          <div class="field full">
            <label for="estimate-message">Project details (optional)</label>
            <textarea id="estimate-message" name="message" rows="4" placeholder="Material, amount, and anything about the site we should know"></textarea>
          </div>
        </div>
        <?php echo consentFieldset('estimate'); ?>
        <button type="submit" class="btn btn-primary btn-lg">Request my estimate</button>
      </form>
    </div>

    <div class="hr-next reveal-right">
      <h3>What happens next</h3>
      <ol class="next-steps">
        <li><strong>We get your details</strong>The material or work, the amount and the address go straight to HARDROCK.</li>
        <li><strong>We call you back</strong>HARDROCK calls with pricing and availability for your load or job.</li>
        <li><strong>We set the day</strong>Pick a delivery or work date that fits your schedule.</li>
      </ol>
      <div class="nap">
        <div><?php echo icon('phone', 18); ?><a href="<?php echo esc($homeTel); ?>"><?php echo esc($homeCall); ?></a></div>
        <div><?php echo icon('mail', 18); ?><a href="mailto:<?php echo esc($email); ?>"><?php echo esc($email); ?></a></div>
        <div><?php echo icon('map-pin', 18); ?><span><?php echo esc($homeCity); ?>, <?php echo esc($homeState); ?></span></div>
        <div><?php echo icon('clock', 18); ?><span>Mon–Thu 6 AM–5 PM · Fri 9 AM–5 PM · Sat 9 AM–2 PM · Sun closed</span></div>
      </div>
      <p class="hr-area">HARDROCK Sand and Gravel delivers and works across Sherman, Denison and Grayson County, Texas.</p>
    </div>
  </div>
</section>

<?php echo $schemaMarkup; ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
