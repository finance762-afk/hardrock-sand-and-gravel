<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$pageTitle       = 'Sand, Gravel and Site Work in Sherman, TX | HARDROCK';
$pageDescription = 'All 13 HARDROCK Sand and Gravel services: pea gravel, road base, 57/67 rock, fill dirt, rip rap, driveways, house pads, ponds and land clearing in Sherman, TX.';
$canonicalUrl    = $siteUrl . '/services/';
$ogImage         = '/assets/images/gravel-stockpiles-job-site.jpg';
$currentPage     = 'services';
$pageType        = 'other';
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = 'gravel-stockpiles-job-site';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* Grid order: site work first, then delivery (featured 2x2) and the eight materials. Adjacent cards never share a photo. */
$siteWork  = ['driveways', 'house-pads', 'ponds', 'land-clearing'];
$materials = ['delivery', 'pea-gravel', 'road-base', 'decomposed-granite', '57-67-rock', 'fill-dirt', 'river-rock', 'mason-sand', 'rip-rap'];

/* Job → material chooser (general material properties; nothing here is a HARDROCK price or spec) */
$chooser = [
    ['job' => 'Gravel driveway on a rural lot', 'slugs' => ['road-base', '57-67-rock'], 'why' => 'Road base compacts into a firm lower layer; 57 rock on top drains and gives tires grip.'],
    ['job' => 'Building pad for a new slab', 'slugs' => ['fill-dirt', 'road-base'], 'why' => 'Fill raises the grade in compacted lifts; base caps it so the slab crew has a firm, level surface.'],
    ['job' => 'Walkway or garden path', 'slugs' => ['decomposed-granite', 'pea-gravel'], 'why' => 'Decomposed granite packs firm underfoot; pea gravel stays loose and drains fast but needs edging.'],
    ['job' => 'French drain or downspout trench', 'slugs' => ['57-67-rock', 'river-rock'], 'why' => 'Clean crushed or rounded stone leaves open space for water to move through.'],
    ['job' => 'Pond bank, creek bend or culvert outlet', 'slugs' => ['rip-rap'], 'why' => 'Large angular rock stays put where waves and moving water would carry smaller stone away.'],
    ['job' => 'Mortar, paver or flagstone bedding', 'slugs' => ['mason-sand'], 'why' => 'Fine, even sand mixes smooth and screeds flat under pavers and stone.'],
    ['job' => 'Low spot, backfill or raising grade', 'slugs' => ['fill-dirt'], 'why' => 'Fill dirt is for bulk and shape, not for growing; it is placed in layers and compacted.'],
    ['job' => 'Lot covered in brush and small trees', 'slugs' => ['land-clearing'], 'why' => 'Clearing comes first so the drive, pad or pond can be laid out on open ground.'],
];

$hubSchema = ['@context' => 'https://schema.org', '@graph' => [
    [
        '@type' => 'CollectionPage',
        '@id' => $canonicalUrl . '#webpage',
        'url' => $canonicalUrl,
        'name' => 'Sand, gravel and site work services from ' . $siteName,
        'about' => ['@id' => rtrim($siteUrl, '/') . '/#organization'],
        'mainEntity' => [
            '@type' => 'ItemList',
            'itemListElement' => array_map(fn($i, $s) => ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $s['name'], 'url' => rtrim($siteUrl, '/') . '/services/' . $s['slug'] . '/'], array_keys($services), $services),
        ],
    ],
    array_diff_key(sp_breadcrumb_schema('Services'), ['@context' => 1]),
]];
$pageSchemas = [$hubSchema];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style>
/* ==========================================================================
   /services/ hub — page-specific composition
   Signature: the job → material chooser table with material "tags".
   ========================================================================== */
.hub-hero .hero-bg img { object-position: 50% 62%; }
.hub-hero .hero-text { max-width: 44rem; }
.hub-hero .hero-title { max-width: 26ch; }
.hub-hero .hub-hero__actions { display: flex; flex-wrap: wrap; gap: var(--space-sm) var(--space-lg); align-items: center; }
.hub-hero .hub-hero__actions .btn-primary { background: var(--color-accent); border-color: var(--color-accent); }

.hub-services { background: var(--color-paper); }
.hub-services .section-title { max-width: 70ch; }
.hub-group { display: grid; grid-template-columns: auto 1fr; align-items: center; gap: var(--space-md); margin: var(--space-2xl) 0 var(--space-lg); }
.hub-group:first-of-type { margin-top: var(--space-lg); }
.hub-group h3 { font-size: 1.35rem; text-transform: uppercase; letter-spacing: .04em; color: var(--color-ink); }
.hub-group::after { content: ""; height: 2px; background: repeating-linear-gradient(90deg, var(--color-accent) 0 var(--space-lg), transparent var(--space-lg) var(--space-xl)); }
.hub-services .services-grid--site { grid-template-columns: repeat(4, minmax(0, 1fr)); }
.hub-services .service-card-with-image { border-radius: var(--radius-sm); }
.hub-services .service-card-with-image h3 { text-transform: uppercase; letter-spacing: .02em; font-size: 1.2rem; }
.hub-services .service-card__image::after { content: ""; position: absolute; inset: auto 0 0 0; height: var(--space-1); background: var(--color-accent); transform: scaleX(.18); transform-origin: left; transition: transform var(--transition-slow); }
.hub-services .service-card-with-image:hover .service-card__image::after { transform: scaleX(1); }
.hub-services .services-grid--featured > :first-child h3 { font-size: 1.6rem; }
.hub-services .services-grid--featured > :first-child .service-card__image::after { content: "Sherman · Denison · Grayson County"; inset: var(--space-md) auto auto var(--space-md); height: auto; transform: none; background: var(--color-accent-dark); color: var(--color-white); }
@media (max-width: 1000px) { .hub-services .services-grid, .hub-services .services-grid--site { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
@media (max-width: 560px) { .hub-services .services-grid, .hub-services .services-grid--site { grid-template-columns: 1fr; } .hub-services .services-grid--featured > :first-child { grid-column: auto; grid-row: auto; } }

.hub-chooser .hub-tags { display: flex; flex-wrap: wrap; gap: var(--space-xs); }
.hub-chooser .hub-tags a { display: inline-flex; align-items: center; min-height: 2.25rem; padding: 0 var(--space-sm); border-radius: var(--radius-full); border: 1px solid color-mix(in srgb, var(--color-accent) 45%, var(--color-line)); background: var(--color-card-tint-3); color: var(--color-accent-dark); font-weight: 600; font-size: var(--fs-small); text-decoration: none; transition: background-color var(--transition), color var(--transition); }
.hub-chooser .hub-tags a:hover, .hub-chooser .hub-tags a:focus-visible { background: var(--color-accent-dark); color: var(--color-white); }
.hub-chooser .sp-table tbody th { white-space: normal; text-transform: none; letter-spacing: 0; font-family: var(--font-body); font-weight: 700; font-size: .98rem; }

.hub-order .hub-order__formula { margin-top: var(--space-lg); padding: var(--space-md) var(--space-lg); border-left: var(--space-1) solid var(--color-accent); background: color-mix(in srgb, var(--color-white) 6%, transparent); font-family: var(--font-heading); font-size: 1.3rem; text-transform: uppercase; letter-spacing: .03em; color: var(--color-white); }
.hub-order .hub-order__formula em { font-style: normal; color: var(--color-accent-bright); }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero hub-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Rows of grey gravel loads dumped across a staked, graded site at sunset', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo sp_breadcrumb(); ?>
    <div class="hero-text hero-copy">
      <span class="eyebrow">All services · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
      <h1 class="hero-title" id="sp-hero-title"><span class="text-accent">Sand, Gravel</span> and Site Work in Sherman, TX</h1>
      <p class="hero-answer">HARDROCK Sand and Gravel sells and delivers eight bulk materials, from pea gravel to rip rap, and builds the driveways, house pads and ponds they go into. This page lists all <?php echo count($services); ?> services for homeowners, farms and contractors in Sherman, Denison and Grayson County, with a guide to which material suits which job.</p>
      <div class="hub-hero__actions">
        <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Get a free estimate</button>
        <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
      </div>
      <ul class="hero-chips">
        <li><?php echo icon('layers', 16); ?>8 bulk materials</li>
        <li><?php echo icon('hard-hat', 16); ?>4 kinds of site work</li>
        <li><?php echo icon('calendar-check', 16); ?>Since <?php echo esc($yearEstablished); ?></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ ALL SERVICES (required component) ============ -->
<section class="section hub-services" aria-labelledby="hub-services-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow-label">What We Do</span>
      <h2 id="hub-services-title">Which <span class="text-accent">sand, gravel and site work</span> services does HARDROCK offer?</h2>
      <p class="hero-answer">HARDROCK Sand and Gravel offers <?php echo count($services); ?> services in Sherman, Denison and Grayson County. Four are site work: driveways, house pads, ponds and land clearing. The rest are bulk delivery of pea gravel, road base, decomposed granite, 57 and 67 rock, fill dirt, river rock, mason sand and rip rap. Each card opens the full page for that service.</p>
    </div>

    <div class="hub-group reveal-left"><h3>Site work</h3></div>
    <div class="services-grid services-grid--site">
      <?php foreach ($siteWork as $hubIdx => $hubSlug) echo sp_card($hubSlug, ($hubIdx % 3) + 1, '(max-width: 560px) 100vw, (max-width: 1000px) 50vw, 300px'); ?>
    </div>

    <div class="hub-group reveal-left"><h3>Delivery and bulk materials</h3></div>
    <div class="services-grid services-grid--featured">
      <?php foreach ($materials as $hubIdx => $hubSlug) echo sp_card($hubSlug, (($hubIdx + 1) % 3) + 1, $hubIdx === 0 ? '(max-width: 560px) 100vw, (max-width: 1000px) 100vw, 620px' : '(max-width: 560px) 100vw, (max-width: 1000px) 50vw, 300px'); ?>
    </div>
  </div>
</section>

<!-- ============ MATERIAL CHOOSER (signature) ============ -->
<section class="section sp-compare hub-chooser edge-curve-top" aria-labelledby="hub-chooser-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Match the material to the job</span>
      <h2 id="hub-chooser-title">Which material should you order for your job?</h2>
      <p class="answer-block">The right material depends on what the ground has to do: carry weight, drain water, stay put on a slope or look good underfoot. Road base and 57 rock build driveways, fill dirt and base build pads, rip rap holds banks, and pea gravel, decomposed granite and river rock finish paths and beds.</p>
    </div>
    <div class="sp-table-wrap reveal-up">
      <table class="sp-table">
        <caption>General guidance. Tell HARDROCK what you are building and we will confirm the material before the load is ordered.</caption>
        <thead>
          <tr><th scope="col">The job</th><th scope="col">Material or service</th><th scope="col">Why it fits</th></tr>
        </thead>
        <tbody>
          <?php foreach ($chooser as $row): ?>
          <tr>
            <th scope="row"><?php echo esc($row['job']); ?></th>
            <td><div class="hub-tags"><?php foreach ($row['slugs'] as $rowSlug): ?><a href="/services/<?php echo esc($rowSlug); ?>/"><?php echo esc(sp_service($rowSlug)['name']); ?></a><?php endforeach; ?></div></td>
            <td><?php echo esc($row['why']); ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- ============ HOW ORDERING WORKS ============ -->
<section class="section on-dark texture-grain slant-top sp-breakdown hub-order" aria-labelledby="hub-order-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="sp-breakdown__grid">
      <div class="reveal-left">
        <span class="eyebrow">Ordering</span>
        <h2 id="hub-order-title">How do you order sand, gravel or site work from HARDROCK?</h2>
        <p class="answer-block">You order from HARDROCK Sand and Gravel by phone or with the estimate form. Give the material or job, the address and a rough size, and HARDROCK calls back with the price and a delivery or work day. HARDROCK opens at 6 AM Monday through Thursday.</p>
        <p class="hub-order__formula">Length × Width × Depth (ft) <em>÷ 27 = cubic yards</em></p>
        <p>A 12 × 20 ft parking area 4 inches deep is 12 × 20 × ⅓ = 80 cubic feet, about 3 cubic yards. Every material page has its own worked example, and HARDROCK can check the math on the phone. Hours are Monday to Thursday 6 AM to 5 PM, Friday 9 AM to 5 PM and Saturday 9 AM to 2 PM; call <a href="<?php echo esc($spTel); ?>"><?php echo esc($spCall); ?></a> or email <a href="mailto:<?php echo esc($email); ?>"><?php echo esc($email); ?></a>.</p>
      </div>
      <ol class="sp-steps reveal-right">
        <li><b>Pick the material or job</b><span>Use the cards above or the chooser table. Not sure? Describe the project and HARDROCK will suggest one.</span></li>
        <li><b>Size it</b><span>Measure the area and depth. For site work, the address and a few photos of the ground help.</span></li>
        <li><b>Call or send the form</b><span>HARDROCK quotes the load or the job by phone and sets the day.</span></li>
        <li><b>Delivered or built</b><span>The load is dumped where you want it, or the drive, pad, pond or clearing is done.</span></li>
      </ol>
    </div>
  </div>
</section>

<!-- ============ GOOGLE REVIEWS (Page One feed; renders nothing when the feed is empty) ============ -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
$hubReviews = p1_google_reviews($slug, ['heading' => 'What do Grayson County customers say about HARDROCK?', 'limit' => 8]);
if ($hubReviews !== ''): ?>
<section class="section sp-proof edge-wave-top" aria-label="Google reviews">
  <div class="container">
    <?php echo $hubReviews; ?>
    <div class="sp-proof__foot">
      <a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a>
      <p>Owner <?php echo esc($ownerName); ?> and the HARDROCK team have supplied Sherman and Grayson County since <?php echo esc($yearEstablished); ?>.<?php if (is_dir($_SERVER['DOCUMENT_ROOT'] . '/about')): ?> <a href="/about/">More about HARDROCK</a>.<?php endif; ?></p>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Need a load or a job priced this week?',
    'Call HARDROCK Sand and Gravel or send the form with the material, the amount and the address. We call back with a price and a day.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
