<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/area-page.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$pageTitle       = 'Sand and Gravel in Sherman, TX & Nearby Towns | HARDROCK';
$pageDescription = 'Hardrock Sand And Gravel delivers gravel, sand, rock and fill dirt in Sherman, Denison and across Grayson County, TX. Pick your area. Call ' . formatPhone($phone) . '.';
$canonicalUrl    = $siteUrl . '/service-areas/';
$ogImage         = '/assets/images/gravel-stockpiles-job-site.jpg';
$currentPage     = 'areas';
$pageType        = 'other';
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = 'gravel-stockpiles-job-site';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* Cards come from config.php $serviceAreas; each links through areaUrl() so a page that is not on disk never 404s. */
$hubAreas = [];
foreach ($serviceAreas as $hubName) $hubAreas[] = ['slug' => getAreaSlug($hubName)] + ap_area(getAreaSlug($hubName));

$hubMapSrc = 'https://www.google.com/maps?q=' . rawurlencode('Grayson County, TX') . '&output=embed';

$hubSchema = ['@context' => 'https://schema.org', '@graph' => [
    [
        '@type' => 'CollectionPage',
        '@id' => $canonicalUrl . '#webpage',
        'url' => $canonicalUrl,
        'name' => 'Service areas for ' . $siteName,
        'description' => $pageDescription,
        'isPartOf' => ['@id' => rtrim($siteUrl, '/') . '/#website'],
        'about' => ['@id' => rtrim($siteUrl, '/') . '/#organization'],
        'mainEntity' => [
            '@type' => 'ItemList',
            'itemListElement' => array_map(fn($i, $a) => ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $a['label'], 'url' => rtrim($siteUrl, '/') . ap_url($a['slug'])], array_keys($hubAreas), $hubAreas),
        ],
    ],
    ap_breadcrumb_schema(),
]];
$pageSchemas = [$hubSchema];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/area-page.css'; ?></style>
<style>
/* ==========================================================================
   /service-areas/ hub — page-specific composition
   Signature: the coverage band — a live county map beside a distance ladder from the Sherman base.
   ========================================================================== */
.sa-hero .hero-bg img { object-position: 50% 62%; }
.sa-hero .hero-text { max-width: 46rem; }
.sa-hero .hero-title { max-width: 26ch; }
.sa-hero .hero-actions .btn-primary { background: var(--color-accent); border-color: var(--color-accent); }

.sa-areas { background: var(--color-paper); }
.sa-areas .section-title { max-width: 70ch; }
.sa-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-lg); margin: 0; padding: 0; list-style: none; }
.sa-card { display: grid; grid-template-rows: auto 1fr; height: 100%; border-radius: var(--radius-sm); overflow: hidden; border: 1px solid var(--color-line); box-shadow: var(--shadow); transition: transform var(--transition), box-shadow var(--transition); }
.sa-card:hover { transform: translateY(calc(-1 * var(--space-1))); box-shadow: var(--shadow-lg); }
.sa-grid > li:nth-child(3n+1) .sa-card { background: var(--color-card-tint-1); }
.sa-grid > li:nth-child(3n+2) .sa-card { background: var(--color-card-tint-2); }
.sa-grid > li:nth-child(3n) .sa-card { background: var(--color-card-tint-3); }
.sa-card__image { position: relative; aspect-ratio: 16 / 10; overflow: hidden; }
.sa-card__image img { width: 100%; height: 100%; object-fit: cover; transition: transform var(--transition-slow); }
.sa-card:hover .sa-card__image img { transform: scale(1.04); }
.sa-card__image::after { content: ""; position: absolute; inset: auto 0 0 0; height: var(--space-1); background: var(--color-accent); transform: scaleX(.18); transform-origin: left; transition: transform var(--transition-slow); }
.sa-card:hover .sa-card__image::after { transform: scaleX(1); }
.sa-card__kind { position: absolute; z-index: 1; top: var(--space-md); left: var(--space-md); padding: var(--space-1) var(--space-sm); border-radius: var(--radius-sm); background: var(--color-accent-dark); color: var(--color-white); font-family: var(--font-accent); text-transform: uppercase; letter-spacing: .12em; font-size: var(--fs-small); font-weight: 700; }
.sa-card__body { display: grid; gap: var(--space-sm); align-content: start; padding: var(--space-lg); }
.sa-card__body h3 { font-size: 1.45rem; text-transform: uppercase; letter-spacing: .02em; }
.sa-card__body p { margin: 0; font-size: var(--fs-small); color: var(--color-ink-2); }
.sa-card__body ul { margin: 0; padding: 0; list-style: none; display: grid; gap: var(--space-1); }
.sa-card__body li { display: grid; grid-template-columns: auto 1fr; gap: var(--space-xs); font-size: var(--fs-small); color: var(--color-ink); }
.sa-card__body li svg { color: var(--color-accent-dark); margin-top: 2px; }
.sa-card__cta { text-decoration: none; margin-top: var(--space-xs); display: inline-flex; align-items: center; min-height: 2.75rem; font-family: var(--font-accent); text-transform: uppercase; letter-spacing: .1em; font-weight: 700; color: var(--color-accent-dark); }
.sa-card__cta::after { content: " \2192"; white-space: pre; }
@media (max-width: 1000px) { .sa-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
@media (max-width: 640px) { .sa-grid { grid-template-columns: 1fr; } }

.sa-map__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.4fr); gap: var(--space-3xl); align-items: center; }
.sa-map__lead { display: grid; gap: var(--space-md); }
.sa-map .answer-block { background: color-mix(in srgb, var(--color-white) 7%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.sa-ladder { counter-reset: saladder; display: grid; gap: var(--space-xs); margin: 0; padding: 0; list-style: none; }
.sa-ladder li { display: grid; grid-template-columns: auto 1fr; gap: var(--space-md); align-items: baseline; padding: var(--space-sm) 0; border-bottom: 1px dashed color-mix(in srgb, var(--color-white) 20%, transparent); font-size: .95rem; color: color-mix(in srgb, var(--color-white) 80%, transparent); }
.sa-ladder b { min-width: 7.5rem; font-family: var(--font-heading); font-size: 1.1rem; text-transform: uppercase; letter-spacing: .03em; color: var(--color-white); }
.sa-map .map-embed { box-shadow: var(--shadow-lg); border: var(--space-1) solid color-mix(in srgb, var(--color-white) 18%, transparent); }
.sa-map__actions { display: flex; flex-wrap: wrap; gap: var(--space-sm); }
@media (max-width: 900px) { .sa-map__grid { grid-template-columns: 1fr; gap: var(--space-2xl); } }

.sa-how { background: var(--color-surface); }
.sa-how__grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-lg); margin: 0; padding: 0; list-style: none; counter-reset: sahow; }
.sa-how__grid li { counter-increment: sahow; position: relative; display: grid; gap: var(--space-xs); padding: var(--space-xl) var(--space-lg) var(--space-lg); border-radius: var(--radius-sm); border: 1px solid var(--color-line); background: var(--color-paper); }
.sa-how__grid li::before { content: counter(sahow, decimal-leading-zero); font-family: var(--font-accent); font-weight: 800; font-size: 2rem; line-height: 1; color: var(--color-accent-dark); }
.sa-how__grid b { font-family: var(--font-heading); font-size: 1.2rem; text-transform: uppercase; letter-spacing: .02em; color: var(--color-ink); }
.sa-how__grid span { font-size: var(--fs-small); color: var(--color-ink-2); }
@media (max-width: 900px) { .sa-how__grid { grid-template-columns: 1fr; } }
@media (prefers-reduced-motion: reduce) { .sa-card, .sa-card__image img, .sa-card__image::after { transition: none; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero sa-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Rows of grey gravel loads dumped across a staked, graded site at sunset', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo ap_breadcrumb(); ?>
    <div class="hero-text hero-copy">
      <span class="eyebrow">Service areas · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
      <h1 class="hero-title" id="sp-hero-title">Sand and Gravel in <span class="text-accent">Sherman, TX</span> &amp; Surrounding Communities</h1>
      <p class="hero-answer">Hardrock Sand And Gravel delivers bulk gravel, sand, rock and fill dirt from its Sherman base to Sherman, Denison and across Grayson County. Pick your area below for the roads, ground conditions and materials that matter there.</p>
      <div class="hero-actions">
        <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Get a free estimate</button>
        <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
      </div>
      <ul class="hero-chips">
        <li><?php echo icon('map-pin', 16); ?><?php echo count($hubAreas); ?> service areas</li>
        <li><?php echo icon('truck', 16); ?>Bulk delivery</li>
        <li><?php echo icon('calendar', 16); ?>Since <?php echo esc($yearEstablished); ?></li>
      </ul>
    </div>
  </div>
</section>

<article class="sp-article" aria-labelledby="sp-hero-title">

<!-- ============ AREA CARDS ============ -->
<section class="section sa-areas" aria-labelledby="sa-areas-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Where HARDROCK delivers</span>
      <h2 id="sa-areas-title">Which Texoma-area towns does Hardrock Sand And Gravel serve?</h2>
      <p class="answer-block">Hardrock Sand And Gravel serves three areas from its Sherman, TX base: the city of Sherman, the city of Denison about 11 miles north, and the rest of Grayson County. Each page below covers that area's roads, ground and the materials that suit it, and every order is priced by phone at <?php echo esc($spCall); ?>.</p>
      <p>These three pages cover Grayson County, where HARDROCK is based. The delivery area also takes in Collin, Denton, Fannin and Cooke counties, and every order is delivered (there is no customer pickup). If your address sits outside those five Texas counties, call before planning a job around it.</p>
    </div>
    <ul class="sa-grid">
      <?php foreach ($hubAreas as $hubIdx => $hubA): ?>
      <li class="reveal-up reveal-delay-<?php echo ($hubIdx % 3) + 1; ?>">
        <article class="sa-card">
          <div class="sa-card__image">
            <span class="sa-card__kind"><?php echo esc($hubA['kind']); ?></span>
            <?php echo pictureTag($hubA['photo'], $hubA['alt'], '(max-width: 640px) 100vw, (max-width: 1000px) 50vw, 360px'); ?>
          </div>
          <div class="sa-card__body">
            <h3><?php echo esc($hubA['label']); ?></h3>
            <p><?php echo esc($hubA['blurb']); ?></p>
            <ul>
              <?php foreach ($hubA['bullets'] as $hubBullet): ?><li><?php echo icon('badge-check', 16); ?><span><?php echo esc($hubBullet); ?></span></li><?php endforeach; ?>
            </ul>
            <a class="sa-card__cta" href="<?php echo esc(areaUrl($hubA['slug'])); ?>">Sand and gravel in <?php echo esc($hubA['name']); ?><span class="sr-only">, TX</span></a>
          </div>
        </article>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- ============ SIGNATURE: COVERAGE MAP ============ -->
<section class="section on-dark texture-grain slant-top sa-map" aria-labelledby="sa-map-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="sa-map__grid">
      <div class="sa-map__lead reveal-left">
        <span class="eyebrow">Coverage</span>
        <h2 id="sa-map-title">How far does HARDROCK's delivery area reach?</h2>
        <p class="answer-block">Hardrock Sand And Gravel's delivery area is five Texas counties: Grayson, Collin, Denton, Fannin and Cooke. Grayson County, the home county, spans 979 square miles from the Red River and Lake Texoma in the north toward Collin County in the south, with the Sherman base near the middle and Denison about 11 miles to the north. Delivery only; there is no customer pickup.</p>
        <ul class="sa-ladder">
          <li><b>Sherman</b><span>The home base and county seat. Orders in town start here.</span></li>
          <li><b>Denison</b><span>About 11 miles north by city center, on the Red River and Lake Texoma side.</span></li>
          <li><b>Grayson County</b><span>Rural lots, small towns and acreage across the rest of the county.</span></li>
          <li><b>Neighboring counties</b><span>Collin, Denton, Fannin and Cooke counties. Call with the address and HARDROCK sets the delivery day.</span></li>
        </ul>
        <div class="sa-map__actions">
          <a class="btn btn-accent" href="<?php echo esc($gbp['directions']); ?>" target="_blank" rel="noopener"><?php echo icon('map-pin', 18); ?>Get directions</a>
          <a class="btn btn-outline-white" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>Call to confirm an address</a>
        </div>
      </div>
      <div class="map-embed reveal-right">
        <iframe title="Map of Grayson County, Texas, the home county of the Hardrock Sand And Gravel delivery area" src="<?php echo esc($hubMapSrc); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</section>

<!-- ============ HOW ORDERING WORKS BY AREA ============ -->
<section class="section sa-how edge-curve-top" aria-labelledby="sa-how-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Ordering</span>
      <h2 id="sa-how-title">How do you order sand and gravel for your Texoma-area address?</h2>
      <p class="answer-block">Call <?php echo esc($spCall); ?> or send the form with your address, the material and the size of the area. Hardrock Sand And Gravel prices the load by phone, checks the cubic yards with you and sets a delivery day. The steps are the same in every service area; only the roads and ground differ.</p>
    </div>
    <ol class="sa-how__grid">
      <li class="reveal-up reveal-delay-1"><b>Pick your area</b><span>Open the Sherman, Denison or Grayson County page for local roads, ground conditions and the materials that suit each.</span></li>
      <li class="reveal-up reveal-delay-2"><b>Describe the job</b><span>Give the address, the material and the area in feet. The <a href="/services/delivery/">delivery page</a> has the cubic-yard formula.</span></li>
      <li class="reveal-up reveal-delay-3"><b>Get a price and a day</b><span>HARDROCK prices the load by phone. Phones open Monday to Thursday at 6:00 AM, Friday at 9:00 AM and Saturday 9:00 AM to 2:00 PM.</span></li>
    </ol>
  </div>
</section>

<!-- ============ GOOGLE REVIEWS (Page One feed; renders nothing when the feed is empty) ============ -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
$saReviews = p1_google_reviews($slug, ['heading' => 'What do Grayson County customers say about HARDROCK?', 'limit' => 6]);
if ($saReviews !== ''): ?>
<section class="section sp-proof edge-wave-top" aria-label="Google reviews">
  <div class="container">
    <?php echo $saReviews; ?>
    <div class="sp-proof__foot"><a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a></div>
  </div>
</section>
<?php endif; ?>

</article>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Get a Free Estimate in Your Area',
    'Call Hardrock Sand And Gravel or send the form with your address in Sherman, Denison, Grayson County or the neighboring Collin, Denton, Fannin and Cooke counties. HARDROCK prices the load by phone and sets a delivery day.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
