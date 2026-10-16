<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';

$pageTitle       = 'Thank You | Hardrock Sand And Gravel, Sherman TX';
$pageDescription = 'Your request reached Hardrock Sand And Gravel in Sherman, TX. Expect a call back with a price and a delivery day. Open Monday to Saturday.';
$canonicalUrl    = $siteUrl . '/thank-you';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'other';
$pageType        = 'other';
$noindex         = true;     /* conversion page: never indexed (robots.txt also disallows it) */
$headerDark      = true;

$tyCall = formatPhone($phone);
$tyTel  = 'tel:' . $phoneE164;

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style>
/* ==========================================================================
   Thank-you — page-specific composition
   Signature: a check-mark seal beside the "what happens next" ladder.
   ========================================================================== */
.ty-hero { padding-bottom: calc(clamp(2rem, 4vw, 3rem) + 3vw); clip-path: polygon(0 0, 100% 0, 100% calc(100% - 3vw), 0 100%); }
.ty-hero .container { display: grid; grid-template-columns: max-content minmax(0, 46rem); justify-content: start; gap: var(--space-xl); align-items: center; }
.ty-seal { display: grid; place-items: center; width: clamp(5rem, 12vw, 8rem); aspect-ratio: 1; border-radius: var(--radius-full); background: var(--color-accent); color: var(--color-white); box-shadow: 0 0 0 var(--space-2) var(--color-dark), 0 0 0 calc(var(--space-2) + var(--space-1)) var(--color-accent-bright); }
.ty-seal svg { width: 52%; height: 52%; stroke-width: 3; }
.ty-hero h1 { text-transform: uppercase; letter-spacing: .01em; line-height: 1.04; text-wrap: balance; }
.ty-hero .ty-actions { display: flex; flex-wrap: wrap; gap: var(--space-sm) var(--space-lg); align-items: center; }
.ty-hero .ty-actions .btn-primary { background: var(--color-accent); border-color: var(--color-accent); }

.ty-next { background: var(--color-paper); }
.ty-next__grid > div:first-child { display: grid; gap: var(--space-md); align-content: start; }
.ty-next__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.2fr); gap: var(--space-2xl); align-items: start; }
.ty-next h2, .ty-more h2 { text-transform: uppercase; letter-spacing: .015em; text-wrap: balance; }
.ty-steps { counter-reset: tystep; display: grid; gap: var(--space-md); margin: 0; padding: 0; list-style: none; }
.ty-steps li { counter-increment: tystep; position: relative; display: grid; gap: var(--space-1); padding: var(--space-lg) var(--space-lg) var(--space-lg) calc(var(--space-3xl) + var(--space-sm)); border-radius: var(--radius-sm); border: 1px solid var(--color-line); box-shadow: var(--shadow-sm); }
.ty-steps li:nth-child(3n+1) { background: var(--color-card-tint-1); }
.ty-steps li:nth-child(3n+2) { background: var(--color-card-tint-2); }
.ty-steps li:nth-child(3n) { background: var(--color-card-tint-3); }
.ty-steps li::before { content: counter(tystep, decimal-leading-zero); position: absolute; left: var(--space-lg); top: var(--space-lg); font-family: var(--font-accent); font-weight: 800; font-size: 1.6rem; line-height: 1; color: var(--color-accent-dark); }
.ty-steps b { font-family: var(--font-heading); font-size: 1.15rem; text-transform: uppercase; letter-spacing: .03em; color: var(--color-ink); }
.ty-steps span { color: var(--color-ink-2); font-size: .95rem; }
.ty-hours { display: grid; margin: var(--space-md) 0 0; max-width: 24rem; }
.ty-hours div { display: flex; justify-content: space-between; gap: var(--space-md); padding: var(--space-xs) 0; border-bottom: 1px dashed var(--color-line); }
.ty-hours dt { color: var(--color-ink-2); }
.ty-hours dd { margin: 0; font-family: var(--font-accent); font-weight: 700; }

.ty-more { background: var(--color-surface); }
.ty-more .services-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
.ty-more .service-card-with-image { border-radius: var(--radius-sm); }
.ty-more .service-card-with-image h3 { text-transform: uppercase; letter-spacing: .02em; font-size: 1.25rem; }
.ty-review { margin-top: var(--space-xl); display: flex; flex-wrap: wrap; align-items: center; gap: var(--space-sm) var(--space-lg); }
.ty-review p { margin: 0; max-width: 56ch; color: var(--color-ink-2); }

@media (max-width: 900px) { .ty-next__grid { grid-template-columns: 1fr; } .ty-more .services-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
@media (max-width: 640px) { .ty-hero .container { grid-template-columns: 1fr; } .ty-more .services-grid { grid-template-columns: 1fr; } }
</style>

<!-- ============ CONFIRMATION ============ -->
<section class="hero hero--type hero--interior texture-grain ty-hero" aria-labelledby="ty-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="ty-seal" aria-hidden="true"><?php echo icon('check', 48); ?></div>
    <div class="hero-text hero-copy">
      <span class="eyebrow">Request received</span>
      <h1 class="hero-title" id="ty-title">Thanks. <span class="text-accent">HARDROCK</span> has your request.</h1>
      <p class="hero-answer">Hardrock Sand And Gravel received your details and will call you back with a price and a delivery day. Need it sooner? Call <?php echo esc($tyCall); ?>.</p>
      <div class="ty-actions">
        <a class="btn btn-primary btn-lg" href="<?php echo esc($tyTel); ?>"><?php echo icon('phone', 20); ?>Call <?php echo esc($tyCall); ?></a>
        <a class="link-call" href="/">Back to the homepage</a>
      </div>
    </div>
  </div>
</section>

<!-- ============ WHAT HAPPENS NEXT ============ -->
<section class="section ty-next" aria-labelledby="ty-next-title">
  <div class="container">
    <div class="ty-next__grid">
      <div class="reveal-left">
        <span class="eyebrow">What to expect</span>
        <h2 id="ty-next-title">What happens after I send my request to Hardrock Sand And Gravel?</h2>
        <p class="answer-block">Hardrock Sand And Gravel reads your request and calls the number you gave during business hours, Monday through Saturday. On the call, HARDROCK checks the quantity with you, then gives the price and a delivery day.</p>
        <dl class="ty-hours" aria-label="Business hours">
          <?php foreach ($hours as $tyDay): ?>
          <div><dt><?php echo esc($tyDay['day']); ?></dt><dd><?php echo esc($tyDay['label']); ?></dd></div>
          <?php endforeach; ?>
        </dl>
      </div>
      <ol class="ty-steps reveal-right">
        <li><b>HARDROCK reads your request</b><span>Requests sent after hours or on Sunday wait until the next business day.</span></li>
        <li><b>You get a call back</b><span>Keep your phone nearby. Have the delivery address, the material and the size of the area in feet ready.</span></li>
        <li><b>Quantity, price and a day</b><span>HARDROCK checks the cubic yards with you, quotes the price and sets a delivery day, all by phone.</span></li>
        <li><b>Load dropped where you marked</b><span>Pick the spot and make sure a loaded truck can reach it. Mention gate width or soft ground on the call.</span></li>
      </ol>
    </div>
  </div>
</section>

<!-- ============ BACK TO SERVICES ============ -->
<?php $tyCards = ['pea-gravel', 'road-base', 'rip-rap']; ?>
<section class="section ty-more edge-curve-top" aria-labelledby="ty-more-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow-label">While you wait</span>
      <h2 id="ty-more-title">What else does Hardrock Sand And Gravel deliver?</h2>
      <p class="answer-block">Hardrock Sand And Gravel delivers eight bulk materials and takes on driveways, house pads and ponds across Grayson, Collin, Denton, Fannin and Cooke counties. Here are three of the most asked-about materials, or see the full list of <?php echo count($services); ?> services.</p>
    </div>
    <div class="services-grid services-grid--3">
      <?php foreach ($tyCards as $tyI => $tySlug) echo sp_card($tySlug, $tyI + 1); ?>
    </div>
    <div class="ty-review">
      <a class="btn btn-secondary" href="/services/">See all <?php echo count($services); ?> services</a>
      <p>Already worked with HARDROCK? <a href="<?php echo esc($gbp['review_url']); ?>" target="_blank" rel="noopener">Leave a Google review</a> and help the next neighbor choose.</p>
    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
