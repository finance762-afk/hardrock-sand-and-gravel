<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/inner-page.php';

$pageTitle       = 'Sand and Gravel FAQ: Pricing and Delivery | HARDROCK';
$pageDescription = 'Straight answers on gravel and sand pricing, delivery, cubic yards, 57 vs 67 rock, driveways and site work from HARDROCK Sand and Gravel in Sherman, TX.';
$canonicalUrl    = $siteUrl . '/faq/';
$ogImage         = '/assets/images/rip-rap-stockpile-closeup.jpg';
$currentPage     = 'faq';
$pageType        = 'faq';
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = 'rip-rap-stockpile-closeup';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* ---- Questions: only what intake, the hours and general material facts support. Anything the client has not
   confirmed (load sizes, delivery speed or radius, pickup, trade accounts, delivery fees, insurance) is NOT asserted;
   those answers send the customer to the phone (see content-confirmations.json). --------------------------------- */
$faqCats = [
    'general' => [
        'title' => 'About HARDROCK', 'icon' => 'info',
        'lead'  => 'HARDROCK Sand and Gravel is a Sherman, TX supplier that has served Sherman, Denison and Grayson County since ' . $yearEstablished . ' and takes calls Monday through Saturday.',
        'items' => [
            ['q' => 'Where is HARDROCK Sand and Gravel and what area does it serve?',
             'a' => 'HARDROCK Sand and Gravel is based in Sherman, Texas and serves Sherman, Denison and the rest of Grayson County. If your address is outside the county, call ' . $spCall . ' before you plan the job around it and HARDROCK will tell you whether it can deliver there.'],
            ['q' => 'How long has HARDROCK Sand and Gravel been in business?',
             'a' => 'HARDROCK Sand and Gravel has been in business since ' . $yearEstablished . ', which makes ' . $yearsInBusiness . ' years in ' . date('Y') . '. ' . $ownerName . ' owns the business.'],
            ['q' => 'What are the business hours?',
             'a' => 'HARDROCK Sand and Gravel is open Monday to Thursday 6:00 AM to 5:00 PM, Friday 9:00 AM to 5:00 PM and Saturday 9:00 AM to 2:00 PM, and closed Sunday. Call ' . $spCall . ' in those hours, or send the estimate form at any time and HARDROCK will call back.'],
            ['q' => 'Who does HARDROCK Sand and Gravel work for?',
             'a' => 'HARDROCK Sand and Gravel works with homeowners, farms and contractors in Sherman, Denison and Grayson County. Whether you need material for a garden path or a house pad, describe the job on the phone and HARDROCK will tell you what it recommends.'],
        ],
    ],
    'services' => [
        'title' => 'Materials and services', 'icon' => 'layers',
        'lead'  => 'HARDROCK Sand and Gravel offers ' . count($services) . ' services: eight bulk materials, delivery, and driveways, house pads, ponds and land clearing.',
        'items' => [
            ['q' => 'What materials does HARDROCK Sand and Gravel sell?',
             'a' => 'HARDROCK Sand and Gravel sells pea gravel, decomposed granite, road base, 57 and 67 rock, fill dirt, mason sand, rip rap and river rock. Each material has its own page under Services with what it is used for and how to size an order.'],
            ['q' => 'Does HARDROCK Sand and Gravel do more than deliver material?',
             'a' => 'Yes. Besides bulk delivery, HARDROCK Sand and Gravel builds driveways and house pads, digs ponds and clears land in Sherman, Denison and Grayson County. Call with the property location and a rough size and HARDROCK will confirm the job is in its area.'],
            ['q' => 'What is the difference between 57 rock and 67 rock?',
             'a' => 'Both are clean crushed stone. 57 rock is the larger of the two and suits French drains, culvert bedding and the finish layer on a gravel drive. 67 rock is smaller and suits concrete mixes, finer drainage layers and places where a tighter surface matters. If a job could go either way, describe it to HARDROCK on the phone first.'],
            ['q' => 'Which gravel is best for a driveway?',
             'a' => 'A gravel driveway usually takes two layers: road base, which compacts into a firm lower layer, and 57 rock on top, which drains and gives tires grip. Soft ground may need fill dirt first. Tell HARDROCK Sand and Gravel the length of the drive and what will drive on it and it will recommend the layers.'],
            ['q' => 'What is the difference between pea gravel and decomposed granite?',
             'a' => 'Pea gravel is small, rounded stone that stays loose, drains fast and needs edging to stay in place. Decomposed granite is fine crushed granite that packs firm underfoot, which suits paths, patios and xeriscape beds. HARDROCK Sand and Gravel sells both.'],
            ['q' => 'Is fill dirt the same thing as topsoil?',
             'a' => 'No. Fill dirt is subsoil meant to be packed down to build height, while topsoil carries the organic matter that grass needs. Build the height with fill dirt, then finish with a few inches of topsoil only where you want a lawn or garden bed.'],
        ],
    ],
    'pricing' => [
        'title' => 'Pricing and quantities', 'icon' => 'ruler',
        'lead'  => 'HARDROCK Sand and Gravel prices every order by phone. Work out your cubic yards first so the quote matches the job.',
        'items' => [
            ['q' => 'How does HARDROCK Sand and Gravel price an order?',
             'a' => 'HARDROCK Sand and Gravel prices each order by phone because the material, the amount and the delivery address all change the number. Ask for the delivered price so the quote includes the haul to your address, and ask which unit, ton or cubic yard, it is quoted in.'],
            ['q' => 'How do I get a price?',
             'a' => 'Call ' . $spCall . ' or send the form with the material, the delivery address and how much you need. HARDROCK Sand and Gravel prices the order from those three details.'],
            ['q' => 'How many cubic yards do I need?',
             'a' => 'Multiply length by width by depth in feet, then divide by 27. A 10 ft by 10 ft area covered 4 inches deep needs about 1.2 cubic yards. Add 5 to 10 percent for settling and spillage, and HARDROCK Sand and Gravel can check your numbers before you order.'],
            ['q' => 'How far does one cubic yard go?',
             'a' => 'One cubic yard is 27 cubic feet. Spread 2 inches deep it covers about 162 square feet, 3 inches deep about 108 square feet and 4 inches deep about 81 square feet. Add 5 to 10 percent for settling.'],
        ],
    ],
    'process' => [
        'title' => 'Ordering and delivery', 'icon' => 'truck',
        'lead'  => 'HARDROCK Sand and Gravel takes an order by phone or form, checks the quantity with you, then quotes the price and sets a delivery day.',
        'items' => [
            ['q' => 'How do I order from HARDROCK Sand and Gravel?',
             'a' => 'Call ' . $spCall . ' or send the estimate form with the delivery address, the material and the size of the area in feet. HARDROCK Sand and Gravel checks the quantity with you, gives the price and sets a delivery day by phone.'],
            ['q' => 'How soon can HARDROCK deliver?',
             'a' => 'HARDROCK Sand and Gravel sets the delivery day when it confirms your order, because the day depends on the material, the amount and the truck schedule. If you have a firm deadline, say so on the first call.'],
            ['q' => 'What should I do before a delivery?',
             'a' => 'Pick the exact spot for the load and make sure a loaded truck can reach it. Check gate width, overhead lines, soft or wet ground and slopes, and tell HARDROCK Sand and Gravel about any of them when you call. Mark anything that must be protected, and call 811 before digging.'],
            ['q' => 'How do I get a price on a driveway, house pad, pond or land-clearing job?',
             'a' => 'Call or send the form with the property location, what you want built and a rough size. HARDROCK Sand and Gravel confirms the job is in its area and prices site work by phone once the size and the site are known.'],
        ],
    ],
];

$faqAll = [];
foreach ($faqCats as $faqCat) foreach ($faqCat['items'] as $faqItem) $faqAll[] = $faqItem;

$pageSchemas = [ip_webpage_schema('FAQPage', 'Frequently asked questions about ' . $siteName, '/faq/', $pageDescription,
    ['mainEntity' => generateFAQSchema($faqAll)['mainEntity']])];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/inner-page.css'; ?></style>
<style>
/* ==========================================================================
   /faq/ — page-specific composition
   Signature: the sticky category rail beside each question list, alternating light and dark bands.
   ========================================================================== */
.fq-hero .hero-bg img { object-position: 50% 45%; }
.fq-hero .hero-text { max-width: 46rem; }
.fq-hero .hero-title { max-width: 24ch; }
.fq-hero .fq-hero__actions { display: flex; flex-wrap: wrap; gap: var(--space-sm) var(--space-lg); align-items: center; }
.fq-hero .fq-hero__actions .btn-primary { background: var(--color-accent); border-color: var(--color-accent); }

.fq-jump { background: var(--color-paper-2); border-bottom: 1px solid var(--color-line); padding-block: var(--space-md); }
.fq-jump ul { display: flex; flex-wrap: wrap; gap: var(--space-xs) var(--space-sm); margin: 0; padding: 0; list-style: none; align-items: center; }
.fq-jump li:first-child { font-family: var(--font-accent); text-transform: uppercase; letter-spacing: .12em; font-size: var(--fs-small); color: var(--color-muted); margin-right: var(--space-xs); }
.fq-jump a { display: inline-flex; align-items: center; gap: var(--space-xs); min-height: 2.75rem; padding: 0 var(--space-md); border-radius: var(--radius-full); border: 1px solid color-mix(in srgb, var(--color-accent) 45%, var(--color-line)); background: var(--color-card-tint-3); color: var(--color-accent-dark); font-weight: 600; font-size: var(--fs-small); text-decoration: none; transition: background-color var(--transition), color var(--transition); }
.fq-jump a:hover, .fq-jump a:focus-visible { background: var(--color-accent-dark); color: var(--color-white); }

.fq-section { scroll-margin-top: calc(var(--nav-height) + var(--space-lg)); }
.fq-section--light { background: var(--color-paper); }
.fq-section--surface { background: var(--color-surface); }
.fq-grid2 { display: grid; grid-template-columns: minmax(0, .8fr) minmax(0, 1.6fr); gap: var(--space-2xl); align-items: start; }
.fq-rail { position: sticky; top: calc(var(--nav-height) + var(--space-lg)); display: grid; gap: var(--space-sm); }
.fq-rail h2 { max-width: 14ch; }
.fq-rail .answer-block { margin: 0; }
.fq-count { font-family: var(--font-accent); font-weight: 800; font-size: var(--fs-small); letter-spacing: .12em; text-transform: uppercase; color: var(--color-accent-dark); }
.fq-list { display: grid; }
.fq-list .faq summary { min-height: 2.75rem; text-wrap: balance; }
.fq-list .faq p { max-width: 62ch; }
.fq-section.on-dark .fq-count { color: var(--color-accent-bright); }
.fq-section.on-dark .faq { border-top-color: color-mix(in srgb, var(--color-white) 14%, transparent); }
.fq-section.on-dark .faq summary { color: var(--color-white); }
.fq-section.on-dark .faq summary::after, .fq-section.on-dark .faq summary:hover { color: var(--color-accent-bright); }
.fq-section.on-dark .faq p { color: color-mix(in srgb, var(--color-white) 82%, transparent); }
.fq-section.on-dark .answer-block { background: color-mix(in srgb, var(--color-white) 7%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.fq-more { display: flex; flex-wrap: wrap; align-items: center; gap: var(--space-sm) var(--space-lg); margin-top: var(--space-xl); }
.fq-more p { margin: 0; max-width: 56ch; color: var(--color-ink-2); }
@media (max-width: 900px) { .fq-grid2 { grid-template-columns: 1fr; gap: var(--space-lg); } .fq-rail { position: static; } .fq-rail h2 { max-width: none; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero fq-hero" aria-labelledby="fq-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Large grey limestone rip rap piled up with a golf ball resting on a rock for scale', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo ip_breadcrumb('FAQ'); ?>
    <div class="hero-text hero-copy">
      <span class="eyebrow">FAQ · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
      <h1 class="hero-title" id="fq-hero-title"><span class="text-accent">Sand and Gravel</span> Questions, Answered for Sherman, TX</h1>
      <p class="hero-answer"><?php echo count($faqAll); ?> answers from HARDROCK Sand and Gravel on pricing, cubic yards, delivery, 57 vs 67 rock, driveways and site work in Sherman, Denison and Grayson County.</p>
      <div class="fq-hero__actions">
        <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Get a free estimate</button>
        <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
      </div>
      <ul class="hero-chips">
        <li><?php echo icon('layers', 16); ?>8 bulk materials</li>
        <li><?php echo icon('ruler', 16); ?>Cubic-yard math inside</li>
        <li><?php echo icon('clock', 16); ?>Open Monday to Saturday</li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ JUMP LINKS ============ -->
<nav class="fq-jump" aria-label="FAQ categories">
  <div class="container">
    <ul>
      <li>Jump to</li>
      <?php foreach ($faqCats as $faqKey => $faqCat): ?>
      <li><a href="#faq-<?php echo esc($faqKey); ?>"><?php echo icon($faqCat['icon'], 16); ?><?php echo esc($faqCat['title']); ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</nav>

<article class="sp-article" aria-labelledby="fq-hero-title">
<?php
/* Band rhythm: light, (estimate band after the first category), surface, dark, light. Edge classes alternate. */
$faqBands = ['general' => ['fq-section--light', ''], 'services' => ['fq-section--surface', 'edge-curve-top'], 'pricing' => ['on-dark texture-grain slant-top', ''], 'process' => ['fq-section--light', '']];
$faqNum = 0;
foreach ($faqCats as $faqKey => $faqCat):
    $faqBand = $faqBands[$faqKey];
    $faqDark = strpos($faqBand[0], 'on-dark') !== false;
?>

<!-- ============ <?php echo strtoupper($faqKey); ?> ============ -->
<section class="section fq-section <?php echo esc(trim($faqBand[0] . ' ' . $faqBand[1])); ?>" id="faq-<?php echo esc($faqKey); ?>" aria-labelledby="faq-<?php echo esc($faqKey); ?>-title">
  <?php if ($faqDark): ?><span class="grain-layer" aria-hidden="true"></span><?php endif; ?>
  <div class="container">
    <div class="fq-grid2">
      <div class="fq-rail reveal-left">
        <span class="fq-count"><?php echo count($faqCat['items']); ?> questions</span>
        <h2 id="faq-<?php echo esc($faqKey); ?>-title"><?php echo esc($faqCat['title']); ?></h2>
        <p class="answer-block"><?php echo esc($faqCat['lead']); ?></p>
      </div>
      <div class="fq-list reveal-up">
        <?php foreach ($faqCat['items'] as $faqI => $faqItem): ?>
        <details class="faq"<?php echo ($faqNum === 0) ? ' open' : ''; ?>>
          <summary><?php echo esc($faqItem['q']); ?></summary>
          <p><?php echo esc($faqItem['a']); ?></p>
        </details>
        <?php $faqNum++; endforeach; ?>
      </div>
    </div>
  </div>
</section>
<?php if ($faqKey === 'general'): ?>

<!-- ============ MID-PAGE ESTIMATE BAND (one per FAQ page, after the first category) ============ -->
<?php $ctaBandTitle = 'Your question is not <span class="text-accent">on the list</span>?';
$ctaBandCopy  = 'Send the material or job and the delivery address. HARDROCK calls back with answers, a price and a delivery day.';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/cta-band.php'; ?>
<?php endif; ?>
<?php endforeach; ?>

<section class="section fq-section--light fq-closer" aria-labelledby="fq-more-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow-label">Keep reading</span>
      <h2 id="fq-more-title">Where can I find more detail on each material?</h2>
      <p class="answer-block">Every HARDROCK Sand and Gravel material and service has its own page with uses, a quantity example and local questions. Start with the Services page for a job-to-material guide, or open <a href="/services/pea-gravel/">pea gravel</a>, <a href="/services/road-base/">road base</a> or <a href="/services/57-67-rock/">57 and 67 rock</a> directly.</p>
    </div>
    <div class="fq-more reveal-up">
      <a class="btn btn-secondary" href="/services/">See all <?php echo count($services); ?> services</a>
      <p>Still deciding? Call <a href="<?php echo esc($spTel); ?>"><?php echo esc($spCall); ?></a> and describe the job.</p>
    </div>
  </div>
</section>

</article>

<?php echo sp_final_cta('Ready to price <span class="text-accent">your load</span>?', 'Call ' . $spCall . ' or send the estimate form. HARDROCK Sand and Gravel quotes by phone and sets a delivery day for Sherman, Denison and Grayson County.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
