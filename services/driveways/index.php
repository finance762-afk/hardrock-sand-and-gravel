<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$svc             = sp_service('driveways');
$pageTitle       = 'Gravel Driveways in Sherman, TX | Hardrock Sand And Gravel';
$pageDescription = 'Gravel driveways built in layers of road base and crushed top rock for homes, farms and rural lots in Sherman and Grayson County. Call HARDROCK at ' . formatPhone($phone) . '.';
$canonicalUrl    = $siteUrl . '/services/driveways/';
$ogImage         = '/assets/images/gravel-driveway-rural.jpg';
$currentPage     = 'services';
$pageType        = 'service';
$serviceSlug     = 'driveways';
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = 'gravel-driveway-rural';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* FAQ: research-brief questions this page can answer truthfully (quantity, which material, pricing unit) */
$faqs = [
    ['q' => 'How much gravel do I need for my driveway?',
     'a' => 'Work out each layer on its own: length times width times depth in feet, divided by 27. A shorter drive, 100 feet long and 10 feet wide, takes about 18.5 cubic yards of road base at 6 inches and about 9.3 cubic yards of top rock at 3 inches. Hardrock Sand And Gravel will check the figures with you at ' . $spCall . '.'],
    ['q' => 'Which type of gravel should I use for a driveway?',
     'a' => 'A common build is compacted road base underneath with an angular crushed rock such as 57 or 67 on top. Leave pea gravel and river rock off the drive, because round stones roll under tires. Tell Hardrock Sand And Gravel what will use the drive, from a family car to a loaded stock trailer, and HARDROCK will suggest a mix.'],
    ['q' => 'Do you sell driveway gravel by the ton or the cubic yard?',
     'a' => 'Hardrock Sand And Gravel quotes every driveway by phone, because the length, the layers and the material all change the price. Bring your cubic-yard figures for the base and the top rock to the call, and HARDROCK will give you the current price and how the material is measured.'],
];

$pageSchemas = [
    ['@context' => 'https://schema.org', '@graph' => [
        array_diff_key(generateServiceSchema($svc), ['@context' => 1]) + ['image' => $siteUrl . '/assets/images/gravel-driveway-rural.jpg'],
        array_diff_key(sp_breadcrumb_schema($svc['name'], 'driveways'), ['@context' => 1]),
        array_diff_key(generateFAQSchema($faqs), ['@context' => 1]),
    ]],
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style>
/* ==========================================================================
   /services/driveways/ — page-specific composition
   Signature: a CSS cross-section of a crowned gravel drive (top rock, road base, fabric, clay).
   ========================================================================== */
.dw-hero .hero-bg img { object-position: 50% 58%; }
.dw-problem .sp-sign:nth-child(2), .dw-problem .sp-sign:nth-child(4) { margin-top: var(--space-lg); margin-bottom: calc(-1 * var(--space-lg)); }

.dw-layers__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.1fr); gap: var(--space-3xl); align-items: center; }
.dw-layers__copy { display: grid; gap: var(--space-md); }
.dw-layers__copy > p { margin: 0; }
.dw-layers .answer-block { background: color-mix(in srgb, var(--color-white) 7%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.dw-stack { display: grid; margin: 0; padding: 0; list-style: none; border-radius: var(--radius-sm); overflow: hidden; box-shadow: var(--shadow-lg);
  clip-path: polygon(0 var(--space-lg), 50% 0, 100% var(--space-lg), 100% 100%, 0 100%); }
.dw-layer { display: grid; grid-template-columns: 6.5rem minmax(0, 1fr); gap: var(--space-md); align-items: center; padding: var(--space-md) var(--space-lg); color: var(--color-ink); }
.dw-layer .dw-layer__depth { font-family: var(--font-accent); font-weight: 800; font-size: 1.35rem; text-transform: uppercase; letter-spacing: .04em; line-height: 1; }
.dw-layer b { display: block; font-family: var(--font-heading); text-transform: uppercase; letter-spacing: .03em; font-size: 1.1rem; }
.dw-layer > span:last-child { font-size: var(--fs-small); }
.dw-layer--top { min-height: 6.5rem; padding-top: var(--space-xl); background-color: color-mix(in srgb, var(--color-secondary) 38%, var(--color-paper));
  background-image: radial-gradient(circle, color-mix(in srgb, var(--color-dark) 30%, transparent) 0 22%, transparent 26%), radial-gradient(circle, color-mix(in srgb, var(--color-white) 45%, transparent) 0 18%, transparent 22%);
  background-size: var(--space-md) var(--space-md), var(--space-lg) var(--space-lg); background-position: 0 0, var(--space-xs) var(--space-xs); }
.dw-layer--base { min-height: 8.5rem; background-color: color-mix(in srgb, var(--color-accent) 16%, var(--color-paper));
  background-image: radial-gradient(circle, color-mix(in srgb, var(--color-dark) 18%, transparent) 0 14%, transparent 18%);
  background-size: var(--space-xs) var(--space-xs); }
.dw-layer--top > span:last-child, .dw-layer--base > span:last-child { justify-self: start; padding: var(--space-1) var(--space-sm); border-radius: var(--radius-sm); background: color-mix(in srgb, var(--color-paper) 86%, transparent); }
.dw-layer--fabric { padding-block: var(--space-xs); background: repeating-linear-gradient(90deg, var(--color-dark) 0 var(--space-xs), color-mix(in srgb, var(--color-dark) 80%, var(--color-white)) var(--space-xs) var(--space-sm)); color: var(--color-white); }
.dw-layer--clay { min-height: 7rem; color: var(--color-white); background-color: color-mix(in srgb, var(--color-dark) 72%, var(--color-accent));
  background-image: linear-gradient(100deg, transparent 0 46%, color-mix(in srgb, var(--color-dark) 70%, transparent) 46% 47%, transparent 47%), linear-gradient(80deg, transparent 0 72%, color-mix(in srgb, var(--color-dark) 70%, transparent) 72% 73%, transparent 73%); }
.dw-stack__note { margin: var(--space-sm) 0 0; font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 72%, transparent); }
.dw-proof .sp-proof__single { grid-template-columns: minmax(0, .8fr) minmax(0, 1.2fr); }
.dw-proof .sp-proof__single figure picture { display: block; aspect-ratio: 4 / 5; }
.dw-proof .sp-proof__single figure img { width: 100%; height: 100%; object-fit: cover; }
.dw-proof .sp-proof__single { margin-bottom: var(--space-2xl); }
@media (max-width: 900px) {
  .dw-layers__grid { grid-template-columns: 1fr; gap: var(--space-2xl); }
  .dw-proof .sp-proof__single { grid-template-columns: 1fr; }
  .dw-problem .sp-sign:nth-child(2), .dw-problem .sp-sign:nth-child(4) { margin: 0; }
}
@media (max-width: 560px) { .dw-layer { grid-template-columns: 1fr; gap: var(--space-xs); } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero dw-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Long, freshly spread tan crushed-gravel drive running straight across green pasture, with a green tractor on the left and fence posts', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo sp_breadcrumb($svc['name']); ?>
    <div class="hero-grid hero-grid--form">
      <div class="hero-text hero-copy">
        <span class="eyebrow">Gravel driveways · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
        <h1 class="hero-title" id="sp-hero-title">Gravel <span class="text-accent">Driveways</span> in Sherman, TX</h1>
        <p class="hero-answer">Hardrock Sand And Gravel builds gravel driveways for homes, farms and rural lots in Sherman, Denison and Grayson County, and delivers the road base and top rock to owners who would rather lay their own. A drive built in compacted layers holds up on Blackland Prairie clay far better than rock dumped on bare dirt.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('layers', 16); ?>Road base + top rock</li>
          <li><?php echo icon('tractor', 16); ?>Farms and rural lots</li>
          <li><?php echo icon('phone', 16); ?>Priced by phone</li>
        </ul>
      </div>

      <aside class="hero-form-card" id="estimate-form">
        <h2>Want a price on a gravel driveway?</h2>
        <p class="hero-form-tagline">Give us the length, the width and the address. HARDROCK calls with a number.</p>
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

<!-- ============ PROBLEM ============ -->
<section class="section sp-problem dw-problem" aria-labelledby="dw-problem-title">
  <div class="container">
    <div class="sp-problem__grid">
      <div class="sp-problem__lead reveal-left">
        <span class="eyebrow">Ruts, potholes, mud</span>
        <h2 id="dw-problem-title">Why do gravel driveways on Grayson County clay rut and wash out?</h2>
        <p class="answer-block">Gravel driveways rut on Grayson County clay because the clay underneath turns soft when wet and the rock gets pushed down into it. Much of the county sits on Blackland Prairie soil that swells after rain and cracks open in summer, so a drive with no firm base keeps losing rock into the mud.</p>
        <p class="pull-quote">Rock that vanishes every spring is not a gravel problem. It is a base problem.</p>
      </div>
      <ul class="sp-signs">
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('route', 22); ?><b>Ruts in the wheel tracks</b><span>Two grooves form where the tires run. Water sits in them after every storm, and each wet spell cuts them deeper.</span></li>
        <li class="sp-sign reveal-up reveal-delay-2"><?php echo icon('droplets', 22); ?><b>Potholes that hold water</b><span>Standing water softens the clay below, and every car that drops into the hole widens it a little more.</span></li>
        <li class="sp-sign reveal-up reveal-delay-3"><?php echo icon('waves', 22); ?><b>Gravel sinking out of sight</b><span>Rock spread one year is gone by the next, pressed into wet clay with nothing firm underneath to hold it up.</span></li>
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('sprout', 22); ?><b>A green strip down the middle</b><span>Grass and weeds between the tracks mean the rock layer has thinned enough for roots to reach the soil.</span></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ SIGNATURE: CROSS-SECTION ============ -->
<section class="section on-dark texture-grain slant-top dw-layers" aria-labelledby="dw-layers-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="dw-layers__grid">
      <div class="dw-layers__copy reveal-left">
        <span class="eyebrow">Cross-section</span>
        <h2 id="dw-layers-title">What layers go into a gravel driveway that lasts?</h2>
        <p class="answer-block">A gravel driveway that lasts is built in layers: a shaped, crowned subgrade, 4 to 6 inches of compacted road base, then 2 to 3 inches of top rock. On soft clay, many builders roll out geotextile fabric between the dirt and the base so the base cannot work down into the mud.</p>
        <p>The crown matters as much as the rock. A drive that sheds rain toward both edges dries out sooner, and a ditch or culvert at the low points keeps runoff from cutting across it. Where a new drive crosses a roadside ditch, check with the county or city about a culvert and any permit before work starts.</p>
      </div>
      <div class="reveal-right">
        <ol class="dw-stack" aria-label="Cross-section of a gravel driveway, top to bottom">
          <li class="dw-layer dw-layer--top"><span class="dw-layer__depth">2–3 in.</span><span><b>Top course</b>57 or 67 crushed rock. Angular stone locks together and lets water through.</span></li>
          <li class="dw-layer dw-layer--base"><span class="dw-layer__depth">4–6 in.</span><span><b>Road base</b>Crushed stone with fines, compacted into a hard, load-bearing layer.</span></li>
          <li class="dw-layer dw-layer--fabric"><span class="dw-layer__depth">Optional</span><span><b>Geotextile fabric</b>Keeps clay and base apart on soft ground.</span></li>
          <li class="dw-layer dw-layer--clay"><span class="dw-layer__depth">Subgrade</span><span><b>Native clay</b>Stripped of topsoil and roots, then shaped with a crown so rain runs off.</span></li>
        </ol>
        <p class="dw-stack__note">Typical thicknesses for a home or farm drive. Heavy trucks, loaded trailers or a long low stretch call for more base.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ COMPARISON ============ -->
<section class="section sp-compare" aria-labelledby="dw-compare-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Pick the top rock</span>
      <h2 id="dw-compare-title">Which gravel makes the best top layer for a driveway?</h2>
      <p class="answer-block">For the top layer of a driveway, crushed angular rock such as 57 or 67 stone works best, because the sharp faces lock together under tires. Rounded pea gravel and river rock roll and shift like ball bearings, and road base on its own packs firm but can turn dusty in dry spells and slick after heavy rain.</p>
    </div>
    <div class="sp-table-wrap reveal-up">
      <table class="sp-table">
        <caption>Sizes are typical industry gradations. HARDROCK carries all four materials; call for what is on hand.</caption>
        <thead>
          <tr><th scope="col">Material</th><th scope="col">Size and shape</th><th scope="col">Under tires</th><th scope="col">Drainage</th><th scope="col">Driveway role</th></tr>
        </thead>
        <tbody>
          <tr class="is-this"><th scope="row">57 or 67 rock</th><td>Crushed and angular; #57 runs about 1 in. down, #67 about 3/4 in. down</td><td>Locks together and stays put</td><td>Drains freely through open gaps</td><td>Top course over the base</td></tr>
          <tr><th scope="row">Road base</th><td>Crushed rock blended with fines</td><td>Packs hard and smooth</td><td>Sheds water off the surface</td><td>The base layer; a top surface on light-use drives</td></tr>
          <tr><th scope="row">Pea gravel</th><td>Small and rounded, often about 3/8 in.</td><td>Rolls and ruts; tires sink in</td><td>Drains freely</td><td>Walkways and beds, not drives</td></tr>
          <tr><th scope="row">River rock</th><td>Smooth, rounded and larger</td><td>Shifts and scatters</td><td>Drains freely</td><td>Edging and dry creek beds beside the drive</td></tr>
        </tbody>
      </table>
    </div>
    <p class="reveal-up">The two layers have their own pages: <a href="/services/57-67-rock/">57 and 67 rock for a driveway top course</a>, and <a href="/services/road-base/">road base that packs firm under the top rock</a>.</p>
  </div>
</section>

<!-- ============ QUANTITY ============ -->
<section class="section sp-math edge-curve-top" aria-labelledby="dw-math-title">
  <div class="container">
    <div class="sp-math__grid">
      <div class="reveal-left">
        <span class="eyebrow">Order the right amount</span>
        <h2 id="dw-math-title">How much road base and rock does a gravel driveway need?</h2>
        <p class="answer-block">A 300-foot drive 12 feet wide needs about 67 cubic yards of road base at 6 inches and about 33 cubic yards of top rock at 3 inches. Each layer is worked out on its own: length times width times depth in feet, divided by 27. Add 5 to 10 percent for the base, which packs down under compaction.</p>
        <p>Rural drives can run several hundred feet from the road to the house on acreage around Collinsville, Gunter or Bells, so measure with a wheel or a truck's trip odometer rather than pacing it off. Work out a turnaround or a parking apron as its own rectangle and add it to the total.</p>
      </div>
      <div class="sp-math__card reveal-right">
        <p class="sp-math__formula">L × W × D <em>÷ 27</em>, per layer</p>
        <dl class="sp-math__rows">
          <div><dt>Drive</dt><dd>300 ft × 12 ft</dd></div>
          <div><dt>Road base, 6 in</dt><dd>≈ 66.7 yd³</dd></div>
          <div><dt>Top rock, 3 in</dt><dd>≈ 33.3 yd³</dd></div>
          <div><dt>Both layers</dt><dd>≈ 100 yd³</dd></div>
        </dl>
        <p>300 × 12 × 0.5 = 1,800 ft³ ÷ 27 = 66.7. 300 × 12 × 0.25 = 900 ft³ ÷ 27 = 33.3.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ SERVICE BREAKDOWN ============ -->
<section class="section on-dark texture-grain edge-torn-top sp-breakdown" aria-labelledby="dw-breakdown-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="sp-breakdown__grid">
      <div class="reveal-left">
        <span class="eyebrow">Ordering a drive</span>
        <h2 id="dw-breakdown-title">How does a driveway job with HARDROCK get started?</h2>
        <p class="answer-block">A HARDROCK driveway job starts with a phone call or the form: the length, the width, the address and what the route looks like now. HARDROCK checks the quantities for each layer, then gives you a price and a day by phone, for the materials alone or for the finished drive.</p>
        <ul class="sp-included">
          <li><?php echo icon('ruler', 18); ?><span>Length and width of the drive, plus any turnaround</span></li>
          <li><?php echo icon('map', 18); ?><span>What is there now: pasture, a dirt track or worn gravel</span></li>
          <li><?php echo icon('route', 18); ?><span>Where it meets the road, and any ditch or culvert</span></li>
          <li><?php echo icon('truck', 18); ?><span>What will use it, from cars to stock trailers</span></li>
          <li><?php echo icon('clipboard-list', 18); ?><span>Material only, or the finished drive</span></li>
        </ul>
        <p>If brush or small trees stand where the drive will run, <a href="/services/land-clearing/">clearing the route before the base goes down</a> can be part of the same conversation.</p>
      </div>
      <ol class="sp-steps reveal-right">
        <li><b>Measure the route</b><span>Length, width, and a note on any soft or low spots along the way.</span></li>
        <li><b>Quantities per layer</b><span>Base and top rock are figured separately, in cubic yards.</span></li>
        <li><b>Price and a day</b><span>HARDROCK quotes by phone and books the work or the delivery.</span></li>
        <li><b>Drive built or loads dropped</b><span>The drive is finished, or the material lands along the route, depending on the job you chose.</span></li>
      </ol>
    </div>
  </div>
</section>

<!-- ============ PROOF ============ -->
<section class="section sp-proof dw-proof" aria-labelledby="dw-proof-title">
  <div class="container">
    <div class="sp-proof__single">
      <figure class="reveal-scale">
        <?php echo pictureTag('gravel-driveway-rural', 'Freshly spread tan crushed-gravel drive running straight across green pasture beside fence posts, with a green tractor at the left', '(max-width: 900px) 100vw, 440px'); ?>
        <figcaption>A new crushed-gravel drive across pasture, tractor parked at the edge.</figcaption>
      </figure>
      <div class="section-title reveal-up">
        <span class="eyebrow">Recent Work</span>
        <h2 id="dw-proof-title">What does a new HARDROCK gravel drive look like across pasture?</h2>
        <p class="answer-block">A new HARDROCK gravel drive looks like the one in this photo: tan crushed gravel freshly spread in a long, straight line across green pasture, with fence posts along one side and a green tractor parked at the left. The tall frame shows how far the drive stretches across the field.</p>
      </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
    echo p1_google_reviews($slug, ['heading' => 'What Sherman-area customers say on Google', 'heading_tag' => 'h3', 'limit' => 6]); ?>
    <div class="sp-proof__foot">
      <a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a>
      <p>For the arithmetic behind a driveway order, see <a href="/blog/how-much-gravel-for-a-driveway-sherman-tx/">how much gravel a Sherman driveway takes</a>, and if an existing drive washed out, read <a href="/blog/fix-gravel-driveway-after-heavy-rain-grayson-county/">how to fix a gravel driveway after heavy rain</a>.</p>
      <p>Driveways are one of 13 materials and services on <a href="/services/">HARDROCK's services page</a>.</p>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain slant-top sp-faq" id="faq" aria-labelledby="dw-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="dw-faq-title">What do customers ask HARDROCK before building a gravel drive?</h2>
      <p>Customers planning a gravel drive with HARDROCK usually ask three things first: how much material the drive will take, which rock belongs on top, and how the order is measured and priced. Here are the short answers.</p>
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
<?php echo sp_related_section(['road-base', '57-67-rock', 'land-clearing'],
    'What else goes into <span class="text-accent">a new gravel drive</span>?',
    'A new drive usually draws on three HARDROCK services at once. Road base forms the compacted layer that carries the weight, 57 and 67 rock make the top course that drains and grips, and land clearing opens the route through brush and trees before any material goes down.'); ?>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Need a drive that stops rutting?',
    'Send Hardrock Sand And Gravel the length, the width and the address, or call. Have the route measured before you pick up the phone and the base and top-rock numbers come together quickly.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
