<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$svc             = sp_service('land-clearing');
$pageTitle       = 'Land Clearing in Sherman, TX | Hardrock Sand And Gravel';
$pageDescription = 'Brush and tree clearing for lots and acreage in Sherman, Denison and Grayson County, ahead of driveways, house pads and ponds. Call HARDROCK at ' . formatPhone($phone) . '.';
$canonicalUrl    = $siteUrl . '/services/land-clearing/';
$ogImage         = '/assets/images/pond-excavation-trees.jpg';
$currentPage     = 'services';
$pageType        = 'service';
$serviceSlug     = 'land-clearing';
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = 'pond-excavation-trees';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* FAQ: research-brief questions this page can answer truthfully (service area, which material) */
$faqs = [
    ['q' => 'Do you clear land outside Sherman?',
     'a' => 'Hardrock Sand And Gravel clears land in Sherman, Denison and the rest of Grayson County, and in Collin, Denton, Fannin and Cooke counties. Call ' . $spCall . ' with the property location and what is growing on it. There is always a site visit to check the elevation and the soil type before the job is priced.'],
    ['q' => 'Which material goes on the ground after clearing?',
     'a' => 'That depends on what is being built. A gravel driveway goes down as a base layer with rock on top, a house pad is raised with fill and base, and soft or low spots are leveled with fill dirt. Hardrock Sand And Gravel sells and delivers each of those, so describe the project and HARDROCK will match the material to it.'],
];

$pageSchemas = [
    ['@context' => 'https://schema.org', '@graph' => [
        array_diff_key(generateServiceSchema($svc), ['@context' => 1]) + ['image' => $siteUrl . '/assets/images/pond-excavation-trees.jpg'],
        array_diff_key(sp_breadcrumb_schema($svc['name'], 'land-clearing'), ['@context' => 1]),
        array_diff_key(generateFAQSchema($faqs), ['@context' => 1]),
    ]],
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style>
/* ==========================================================================
   /services/land-clearing/ — page-specific composition
   Signature: the "before the build" sequence strip, four chevron stages with the
   clearing stage set dark, opening the page right under the hero.
   ========================================================================== */
.lc-hero .hero-bg img { object-position: 40% 58%; }
.lc-before { background: var(--color-paper); }
.lc-before__head { display: grid; grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr); gap: var(--space-2xl); align-items: end; }
.lc-before__head .answer-block { margin: 0; }
.lc-before__note { margin: var(--space-lg) 0 0; max-width: var(--measure); color: var(--color-ink-2); }
.lc-sequence { counter-reset: lcstep; display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: var(--space-xs); margin: var(--space-2xl) 0 0; padding: 0; list-style: none; }
.lc-sequence li { counter-increment: lcstep; position: relative; display: grid; gap: var(--space-xs); align-content: start;
  padding: var(--space-lg) calc(var(--space-xl) + var(--space-xs)) var(--space-lg) calc(var(--space-lg) + var(--space-lg));
  background: var(--color-card-tint-2); box-shadow: var(--shadow-sm);
  clip-path: polygon(0 0, calc(100% - var(--space-lg)) 0, 100% 50%, calc(100% - var(--space-lg)) 100%, 0 100%, var(--space-lg) 50%);
  transition: transform var(--transition), background var(--transition); }
.lc-sequence li:first-child { padding-left: var(--space-lg); clip-path: polygon(0 0, calc(100% - var(--space-lg)) 0, 100% 50%, calc(100% - var(--space-lg)) 100%, 0 100%); }
.lc-sequence li:nth-child(odd) { background: var(--color-card-tint-1); }
.lc-sequence li::before { content: "Stage " counter(lcstep, decimal-leading-zero); font-family: var(--font-accent); font-weight: 700; text-transform: uppercase; letter-spacing: .12em; font-size: var(--fs-small); color: var(--color-muted); }
.lc-sequence li svg { color: var(--color-accent-dark); }
.lc-sequence b { font-family: var(--font-heading); font-size: 1.15rem; text-transform: uppercase; letter-spacing: .02em; color: var(--color-ink); }
.lc-sequence span { font-size: var(--fs-small); color: var(--color-ink-2); }
.lc-sequence li:hover { transform: translateY(calc(-1 * var(--space-1))); }
.lc-sequence li.is-now { background: linear-gradient(135deg, var(--color-dark) 0%, var(--color-dark-alt) 70%, color-mix(in srgb, var(--color-accent) 30%, var(--color-dark)) 100%); }
.lc-sequence li.is-now::before, .lc-sequence li.is-now svg { color: var(--color-accent-bright); }
.lc-sequence li.is-now b { color: var(--color-white); }
.lc-sequence li.is-now span { color: color-mix(in srgb, var(--color-white) 80%, transparent); }
.lc-math .sp-math__card { background: linear-gradient(160deg, var(--color-dark) 0%, var(--color-primary-deep) 100%); }
.lc-proof .sp-proof__single figure picture { display: block; aspect-ratio: 4 / 3.4; overflow: hidden; }
.lc-proof .sp-proof__single figure img { width: 100%; height: 100%; object-fit: cover; object-position: 55% 55%; }
.lc-proof__copy { display: grid; gap: var(--space-md); }
.lc-proof__copy > p { margin: 0; color: var(--color-ink-2); max-width: var(--measure); }
@media (max-width: 900px) {
  .lc-before__head { grid-template-columns: 1fr; }
  .lc-sequence { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: var(--space-sm); }
  .lc-sequence li, .lc-sequence li:first-child { clip-path: none; padding: var(--space-lg); border-left: var(--space-1) solid var(--color-accent); border-radius: var(--radius-sm); }
}
@media (max-width: 560px) { .lc-sequence { grid-template-columns: 1fr; } }
@media (prefers-reduced-motion: reduce) { .lc-sequence li { transition: none; } .lc-sequence li:hover { transform: none; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero lc-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Bare, freshly worked ground opened up between standing trees', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo sp_breadcrumb($svc['name']); ?>
    <div class="hero-grid hero-grid--form">
      <div class="hero-text hero-copy">
        <span class="eyebrow">Land clearing · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
        <h1 class="hero-title" id="sp-hero-title"><span class="text-accent">Land Clearing</span> in Sherman, TX</h1>
        <p class="hero-answer">Hardrock Sand And Gravel clears brush and trees from lots and acreage in Sherman, Denison and Grayson County so a driveway, house pad or pond can go in. Because HARDROCK also builds those projects and hauls the rock and dirt for them, the ground gets cleared with the next step already planned.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('trees', 16); ?>Brush and trees cleared</li>
          <li><?php echo icon('route', 16); ?>Ahead of drives, pads, ponds</li>
          <li><?php echo icon('phone', 16); ?>Priced by phone</li>
        </ul>
      </div>

      <aside class="hero-form-card" id="estimate-form">
        <h2>Want a price on clearing a lot?</h2>
        <p class="hero-form-tagline">Tell us where the land is and what is growing on it. We call back with a price.</p>
        <form action="<?php echo esc($formAction); ?>" method="POST" class="hero-form">
          <?php echo p1_lead_hidden_fields('hero'); ?>
          <?php /* p1_lead_hidden_fields() echoes p1_attribution_fields('hero') */ ?>
          <div class="form-row"><label class="sr-only" for="hero-name">Name</label><input id="hero-name" type="text" name="name" placeholder="Name" autocomplete="name" required></div>
          <div class="form-row"><label class="sr-only" for="hero-phone">Phone</label><input id="hero-phone" type="tel" name="phone" placeholder="Phone" autocomplete="tel" inputmode="tel" required></div>
          <div class="form-row"><label class="sr-only" for="hero-email">Email</label><input id="hero-email" type="email" name="email" placeholder="Email" autocomplete="email" required></div>
          <div class="form-row"><label class="sr-only" for="hero-service">Service</label><select id="hero-service" name="service"><?php echo p1_service_options($svc['name']); ?></select></div>
          <?php echo p1_consent_row('hero'); ?>
          <button type="submit" class="btn btn-primary btn-block">Get my free estimate</button>
        </form>
      </aside>
    </div>
  </div>
</section>

<article class="sp-article" aria-labelledby="sp-hero-title">

<!-- ============ BEFORE THE BUILD (signature: sequence strip) ============ -->
<section class="section lc-before" aria-labelledby="lc-before-title">
  <div class="container-wide">
    <div class="lc-before__head">
      <div class="reveal-left">
        <span class="eyebrow">Before the build</span>
        <h2 id="lc-before-title">What has to happen before a <span class="text-accent">driveway, pad or pond</span> can start?</h2>
      </div>
      <p class="answer-block reveal-right">Before a driveway, house pad or pond can start, the ground has to be opened: brush and trees out of the footprint, the route marked, and buried lines located. Hardrock Sand And Gravel handles the clearing and the build that follows, so the gap between the two stays short.</p>
    </div>
    <ol class="lc-sequence">
      <li class="reveal-up reveal-delay-1"><?php echo icon('map-pin', 22); ?><b>Mark what stays</b><span>Flag the trees, fence lines and house site to leave alone, and call 811 so buried lines get painted.</span></li>
      <li class="is-now reveal-up reveal-delay-2"><?php echo icon('trees', 22); ?><b>Clear the footprint</b><span>Brush and trees come out of the area the project needs, plus working room around it.</span></li>
      <li class="reveal-up reveal-delay-3"><?php echo icon('search', 22); ?><b>Read the ground</b><span>With the cover gone, the real lay of the land shows: low spots, draws and where water runs after rain.</span></li>
      <li class="reveal-up reveal-delay-4"><?php echo icon('hard-hat', 22); ?><b>Build</b><span>The drive, pad or pond goes in, with base, fill or rip rap hauled to the same site.</span></li>
    </ol>
    <p class="lc-before__note reveal-up">Blackland Prairie clay turns greasy after a soaking rain and bakes into a cracked crust in July. Ground stripped of its cover and then left bare for a season ruts and washes, which is why lining the build up right behind the clearing matters around Sherman.</p>
  </div>
</section>

<!-- ============ WHAT'S INCLUDED ============ -->
<section class="section on-dark texture-grain edge-torn-top sp-breakdown" aria-labelledby="lc-breakdown-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="sp-breakdown__grid">
      <div class="reveal-left">
        <span class="eyebrow">What's included</span>
        <h2 id="lc-breakdown-title">What does land clearing from HARDROCK include?</h2>
        <p class="answer-block">Land clearing from Hardrock Sand And Gravel removes the brush and trees standing where the project will go and opens the ground for the next step. When that next step is a HARDROCK driveway, pad or pond, the clearing and the build are worked out in the same phone call.</p>
        <ul class="sp-included">
          <li><?php echo icon('check', 18); ?><span>Brush and trees taken out of the project area</span></li>
          <li><?php echo icon('check', 18); ?><span>Clearing planned around the drive, pad or pond that follows</span></li>
          <li><?php echo icon('check', 18); ?><span>The follow-on build available from the same company</span></li>
          <li><?php echo icon('check', 18); ?><span>Base, fill, gravel or rip rap for that build delivered</span></li>
        </ul>
      </div>
      <ol class="sp-steps reveal-right">
        <li><b>Describe the property</b><span>Call or send the form with the location, roughly how much ground is overgrown and what you plan to build.</span></li>
        <li><b>Work out the area</b><span>HARDROCK goes over the footprint with you, length by width, the same way as the acre math further down.</span></li>
        <li><b>Agree a price and a day</b><span>Both are settled over the phone before anyone shows up.</span></li>
        <li><b>Clear, then build</b><span>Brush and trees come out, and the drive, pad or pond can follow on the same ground.</span></li>
      </ol>
    </div>
  </div>
</section>

<!-- ============ HOW MUCH TO CLEAR (comparison) ============ -->
<section class="section sp-compare edge-curve-top" aria-labelledby="lc-compare-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Size the job</span>
      <h2 id="lc-compare-title">How much ground does each kind of project need cleared?</h2>
      <p class="answer-block">The ground a project needs cleared depends on what goes in next. A driveway needs a corridor, a house pad needs the slab footprint plus working room, and a pond needs the basin plus space for the dug-out dirt. Clearing only that much leaves shade trees and windbreaks standing.</p>
    </div>
    <div class="sp-table-wrap reveal-up">
      <table class="sp-table">
        <caption>General planning guide. HARDROCK always visits the site to check the elevation and the soil type before pricing a clearing job.</caption>
        <thead>
          <tr><th scope="col">Project</th><th scope="col">Area to clear</th><th scope="col">Why the extra room</th><th scope="col">What follows</th></tr>
        </thead>
        <tbody>
          <tr class="is-this"><th scope="row">Overgrown lot or pasture</th><td>Brush and volunteer trees across the whole area</td><td>Fence lines and gates need a clear path</td><td>Mowing, grazing or a later build</td></tr>
          <tr><th scope="row">Gravel driveway</th><td>A corridor wider than the drive itself</td><td>Shoulders, ditches and room for trucks to swing</td><td>Base layer, then rock on top</td></tr>
          <tr><th scope="row">House pad</th><td>The slab footprint plus room on every side</td><td>Equipment access and drainage sloping away from the slab</td><td>Fill and base built up to grade</td></tr>
          <tr><th scope="row">Pond</th><td>Basin, dam line and a spoil area</td><td>Dug-out dirt has to land close to the hole</td><td>Digging, then rock on exposed banks</td></tr>
        </tbody>
      </table>
    </div>
    <p class="reveal-up">Planning the drive first? Start with <a href="/services/driveways/">gravel driveways for rural lots</a>. For a new home site, <a href="/services/house-pads/">house pads built up with fill and base</a> pick up where the clearing leaves off.</p>
  </div>
</section>

<!-- ============ ACRE MATH ============ -->
<section class="section sp-math lc-math edge-wave-top" aria-labelledby="lc-math-title">
  <div class="container">
    <div class="sp-math__grid">
      <div class="reveal-left">
        <span class="eyebrow">Do the math</span>
        <h2 id="lc-math-title">How many acres does clearing for a house pad and driveway add up to?</h2>
        <p class="answer-block">Clearing area in acres is length times width in feet, divided by 43,560. A 50-by-70-foot house pad with 15 feet of working room on every side, plus a 400-foot driveway corridor 20 feet wide, comes to about 0.37 acre of clearing.</p>
        <p>Measuring on an aerial photo or a free online map before calling gives the landowner and HARDROCK the same numbers to work from. Pacing it out works too: a normal walking stride covers roughly two and a half feet, so 160 strides is close to the 400-foot corridor in the example.</p>
      </div>
      <div class="sp-math__card reveal-right">
        <p class="sp-math__formula">Length × Width <em>÷ 43,560</em></p>
        <dl class="sp-math__rows">
          <div><dt>Pad + working room</dt><dd>80 × 100 ft</dd></div>
          <div><dt>Driveway corridor</dt><dd>400 × 20 ft</dd></div>
          <div><dt>Total ground</dt><dd>16,000 ft²</dd></div>
          <div><dt>Clearing area</dt><dd>≈ 0.37 acre</dd></div>
        </dl>
        <p>8,000 + 8,000 = 16,000 square feet. 16,000 ÷ 43,560 = 0.367 acre. One acre is 43,560 square feet.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ LOCAL CHECKS / EXPERT ============ -->
<section class="section sp-expert lc-expert" aria-labelledby="lc-local-title">
  <div class="container-wide">
    <div class="sp-expert__grid">
      <div class="sp-expert__copy reveal-left">
        <span class="eyebrow">Local checks</span>
        <h2 id="lc-local-title">What should Grayson County landowners check before <span class="text-accent">clearing</span> starts?</h2>
        <p class="answer-block">Grayson County landowners should check burn bans, buried utility lines and flood maps before clearing starts. Each one can change how brush is handled and where equipment can safely work. Running through that list on the first call with HARDROCK keeps a surprise from stopping the job halfway.</p>
        <div class="sp-figure"><b>811</b><span>the free call that gets buried lines marked</span></div>
        <ul class="sp-points">
          <li><?php echo icon('flame', 20); ?><span><b>Burn bans.</b> The Grayson County commissioners court puts burn bans in place and lifts them as conditions change. Check the current status before any brush pile is lit.</span></li>
          <li><?php echo icon('waypoints', 20); ?><span><b>Buried lines.</b> Gas, water, power and fiber run under plenty of rural acreage. Calling 811 gets them marked before a stump or root ball is dug out.</span></li>
          <li><?php echo icon('waves', 20); ?><span><b>Creek ground.</b> Land along a creek may sit in a FEMA-mapped flood zone. The FEMA flood map viewer shows the zone, and the county can say whether work there needs a permit.</span></li>
        </ul>
        <p>If the cleared spot is meant to hold water, read about <a href="/services/ponds/">pond digging in Grayson County</a> before the trees come down, since the basin and spoil area set how much ground to open.</p>
      </div>
      <figure class="sp-photo reveal-right">
        <?php echo pictureTag('gravel-stockpiles-job-site', 'Rows of grey gravel piles dumped across a large staked, graded site at sunset', '(max-width: 900px) 100vw, 520px'); ?>
        <figcaption>A large staked site, graded bare, with gravel loads dumped in rows.</figcaption>
      </figure>
    </div>
  </div>
</section>

<!-- ============ PROOF ============ -->
<section class="section sp-proof lc-proof" aria-labelledby="lc-proof-title">
  <div class="container">
    <div class="sp-proof__single">
      <div class="lc-proof__copy reveal-left">
        <span class="eyebrow">Recent work</span>
        <h2 id="lc-proof-title">What does freshly worked ground look like on a HARDROCK job?</h2>
        <p class="answer-block">Freshly worked ground on this HARDROCK job is bare, pale grey clay opened up between mature trees. Several trunks still stand where they grew, and loose dirt sits piled in the foreground, the way ground looks before anything is seeded, surfaced or built on.</p>
        <p>Established trees left in place keep shade on the property and roots in the surrounding soil. The full range of materials and site work HARDROCK offers is on <a href="/services/">the HARDROCK services page</a>.</p>
      </div>
      <figure class="reveal-right">
        <?php echo pictureTag('pond-excavation-trees', 'Bare, freshly worked clay ground between mature trees, with loose dirt piled in the foreground', '(max-width: 900px) 100vw, 640px'); ?>
        <figcaption>Bare, worked ground with mature trees left standing.</figcaption>
      </figure>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
    echo p1_google_reviews($slug, ['heading' => 'What property owners in Grayson County say on Google', 'heading_tag' => 'h3', 'limit' => 6]); ?>
    <div class="sp-proof__foot">
      <a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain slant-top sp-faq" id="faq" aria-labelledby="lc-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="lc-faq-title">What do property owners ask HARDROCK about land clearing?</h2>
      <p>Property owners around Sherman usually ask Hardrock Sand And Gravel the same two things about land clearing: whether their land is inside the area HARDROCK covers, and which material the cleared ground needs once the brush is gone.</p>
    </div>
    <div class="faq-grid">
      <?php foreach ($faqs as $faqIdx => $faq): ?>
      <details class="faq reveal-up reveal-delay-<?php echo $faqIdx + 1; ?>"<?php echo $faqIdx === 0 ? ' open' : ''; ?>>
        <summary><?php echo esc($faq['q']); ?></summary>
        <p><?php echo esc($faq['a']); ?></p>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</article>

<!-- ============ RELATED SERVICES ============ -->
<?php echo sp_related_section(['house-pads', 'driveways', 'ponds'],
    'What gets built on <span class="text-accent">cleared ground</span>?',
    'Cleared ground almost always turns into something else. Hardrock Sand And Gravel builds house pads with fill and base for new slabs, lays gravel driveways across rural lots, and digs ponds for stock water or runoff, so the company that opens the ground in Grayson County can finish the next job on it.'); ?>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Need a lot cleared before the build starts?',
    'Call Hardrock Sand And Gravel with the property location and what you plan to build, or send the form. HARDROCK opens at 6 AM Monday through Thursday and at 9 AM on Friday.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
