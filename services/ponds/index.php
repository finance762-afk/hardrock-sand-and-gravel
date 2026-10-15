<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$svc             = sp_service('ponds');
$pageTitle       = 'Pond Digging in Sherman, TX | HARDROCK Sand and Gravel';
$pageDescription = 'Pond digging and shaping for rural and residential land in Sherman, Denison and Grayson County, with rip rap for the banks. Call HARDROCK at ' . formatPhone($phone) . '.';
$canonicalUrl    = $siteUrl . '/services/ponds/';
$ogImage         = '/assets/images/pond-excavation-trees.jpg';
$currentPage     = 'services';
$pageType        = 'service';
$serviceSlug     = 'ponds';
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = 'pond-excavation-trees';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* FAQ: research-brief questions this page can answer truthfully (service area, pricing) */
$faqs = [
    ['q' => 'Does HARDROCK dig ponds outside Sherman?',
     'a' => 'HARDROCK Sand and Gravel takes pond work in Sherman, Denison and across Grayson County. Call ' . $spCall . ' with the property location and HARDROCK will confirm the job is in its area before anything is scheduled.'],
    ['q' => 'How is a pond job priced?',
     'a' => 'HARDROCK Sand and Gravel prices pond work over the phone once the rough size, the site and any clearing or rip rap are known. Have a length, width and average depth in mind; the volume math on this page gives a starting number to share.'],
];

$pageSchemas = [
    ['@context' => 'https://schema.org', '@graph' => [
        array_diff_key(generateServiceSchema($svc), ['@context' => 1]) + ['image' => $siteUrl . '/assets/images/pond-excavation-trees.jpg'],
        array_diff_key(sp_breadcrumb_schema($svc['name'], 'ponds'), ['@context' => 1]),
        array_diff_key(generateFAQSchema($faqs), ['@context' => 1]),
    ]],
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style>
/* ==========================================================================
   /services/ponds/ — page-specific composition
   Signature: topographic contour lines ringing a "basin" behind the site-picking section,
   and a depth gauge down the side of the volume card.
   ========================================================================== */
.pd-hero .hero-bg img { object-position: 50% 62%; }
.pd-contour { position: relative; isolation: isolate; overflow: clip; background: var(--color-paper); }
.pd-contour::before { content: ""; position: absolute; inset: 0; z-index: -1; pointer-events: none;
  background-image:
    radial-gradient(ellipse 18% 13% at 80% 36%, color-mix(in srgb, var(--color-accent) 12%, transparent) 0 55%, transparent 100%),
    repeating-radial-gradient(ellipse 60% 44% at 80% 36%, transparent 0 calc(var(--space-xl) - 2px), color-mix(in srgb, var(--color-primary) 13%, transparent) calc(var(--space-xl) - 2px) var(--space-xl));
  -webkit-mask-image: linear-gradient(100deg, transparent 26%, var(--color-dark) 72%);
  mask-image: linear-gradient(100deg, transparent 26%, var(--color-dark) 72%); }
.pd-contour .sp-sign { border-left: var(--space-1) solid color-mix(in srgb, var(--color-primary) 55%, var(--color-accent)); backdrop-filter: blur(2px); }
.pd-contour .sp-sign:nth-child(2) { transform: translateY(var(--space-lg)); }
.pd-contour .sp-sign:nth-child(4) { transform: translateY(var(--space-lg)); }
.pd-contour .sp-sign:nth-child(2):hover, .pd-contour .sp-sign:nth-child(4):hover { transform: translateY(calc(var(--space-lg) - var(--space-1))); }
.pd-math .sp-math__card { padding-right: calc(var(--space-xl) + var(--space-2xl)); }
.pd-math .sp-math__card::after { content: ""; position: absolute; right: var(--space-lg); top: var(--space-2xl); bottom: var(--space-xl); width: var(--space-md);
  border-radius: var(--radius-full); border: 2px solid color-mix(in srgb, var(--color-white) 30%, transparent);
  background:
    repeating-linear-gradient(to bottom, transparent 0 calc(var(--space-lg) - 2px), color-mix(in srgb, var(--color-white) 45%, transparent) calc(var(--space-lg) - 2px) var(--space-lg)),
    linear-gradient(to bottom, transparent 0 18%, color-mix(in srgb, var(--color-accent-bright) 30%, var(--color-dark-alt)) 18% 100%); }
.pd-proof .sp-proof__single figure picture { display: block; aspect-ratio: 16 / 10; overflow: hidden; }
.pd-proof .sp-proof__single figure img { width: 100%; height: 100%; object-fit: cover; object-position: 50% 60%; }
.pd-proof__copy { display: grid; gap: var(--space-md); }
.pd-proof__copy > p { margin: 0; color: var(--color-ink-2); max-width: var(--measure); }
@media (max-width: 900px) { .pd-contour::before { -webkit-mask-image: linear-gradient(to bottom, transparent 30%, var(--color-dark) 80%); mask-image: linear-gradient(to bottom, transparent 30%, var(--color-dark) 80%); } }
@media (max-width: 560px) { .pd-contour .sp-sign:nth-child(2), .pd-contour .sp-sign:nth-child(4) { transform: none; } .pd-math .sp-math__card { padding-right: var(--space-xl); } .pd-math .sp-math__card::after { display: none; } }
@media (prefers-reduced-motion: reduce) { .pd-contour .sp-sign:nth-child(2):hover, .pd-contour .sp-sign:nth-child(4):hover { transform: translateY(var(--space-lg)); } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero pd-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Freshly dug pond basin of pale grey clay among mature trees, with loose spoil in the foreground', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo sp_breadcrumb($svc['name']); ?>
    <div class="hero-grid hero-grid--form">
      <div class="hero-text hero-copy">
        <span class="eyebrow">Ponds · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
        <h1 class="hero-title" id="sp-hero-title"><span class="text-accent">Pond Digging</span> in Sherman, TX</h1>
        <p class="hero-answer">HARDROCK Sand and Gravel digs and shapes ponds for rural and residential property in Sherman, Denison and across Grayson County. The same company can clear the spot first and haul rip rap for the banks afterward, so a landowner planning a stock pond or a pond near the house makes one call instead of three.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('droplets', 16); ?>Ponds dug and shaped</li>
          <li><?php echo icon('waves', 16); ?>Rip rap for the banks</li>
          <li><?php echo icon('map-pin', 16); ?>Sherman, Denison, Grayson Co.</li>
        </ul>
      </div>

      <aside class="hero-form-card" id="estimate-form">
        <h2>Want a price on a new pond?</h2>
        <p class="hero-form-tagline">Give us the property and the rough size. We call back with a price.</p>
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

<!-- ============ WHERE A POND FITS (signature: contour lines) ============ -->
<section class="section sp-problem pd-contour" aria-labelledby="pd-site-title">
  <div class="container">
    <div class="sp-problem__grid">
      <div class="sp-problem__lead reveal-left">
        <span class="eyebrow">Before you dig</span>
        <h2 id="pd-site-title">Where does a new <span class="text-accent">pond</span> make sense on Grayson County land?</h2>
        <p class="answer-block">A new pond makes sense where runoff already collects: a low draw, the foot of a gentle slope, or a swale that stays wet after storms. Grayson County's Blackland Prairie clay helps a basin hold water, so the bigger question is usually where the water will come from and what the pond is for.</p>
        <p class="pull-quote">Pick the spot by where the water runs, not by where the pond would look best from the porch.</p>
      </div>
      <ul class="sp-signs">
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('droplets', 22); ?><b>Stock water</b><span>A pasture pond means cattle and horses drink where they graze, instead of someone filling a trough through a dry August.</span></li>
        <li class="sp-sign reveal-up reveal-delay-2"><?php echo icon('waves', 22); ?><b>Runoff with nowhere to go</b><span>A draw that floods the lane after every storm can be dug out to hold that water rather than send it across the drive.</span></li>
        <li class="sp-sign reveal-up reveal-delay-3"><?php echo icon('sun', 22); ?><b>A pond near the house</b><span>Smaller basins close to the house are often built for fishing, wildlife or the view as much as for the water itself.</span></li>
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('layers', 22); ?><b>A plan for the spoil</b><span>Digging a basin turns up a lot of dirt. Decide before the first bucket where it goes: the dam, a low corner or a future building site.</span></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ VOLUME MATH ============ -->
<section class="section sp-math pd-math edge-wave-top" aria-labelledby="pd-math-title">
  <div class="container">
    <div class="sp-math__grid">
      <div class="reveal-left">
        <span class="eyebrow">Size it on paper</span>
        <h2 id="pd-math-title">How big is a pond, and how much dirt comes out of it?</h2>
        <p class="answer-block">Pond size in cubic yards is length times width times average depth, all in feet, divided by 27. A basin 100 feet long, 60 feet wide and 6 feet deep on average holds about 1,333 cubic yards, which is roughly 269,000 gallons of water and the same volume of dirt to place.</p>
        <p>Use the average depth, not the deepest point. A basin with sloped sides that reaches 10 feet in the middle may average only 5 or 6 feet across its whole footprint. The same numbers show that a pond this size is under one acre-foot (43,560 cubic feet), far below the 200 acre-foot line in the Texas Water Code covered further down this page.</p>
      </div>
      <div class="sp-math__card reveal-right">
        <p class="sp-math__formula">Length × Width × Avg depth <em>÷ 27</em></p>
        <dl class="sp-math__rows">
          <div><dt>Length</dt><dd>100 ft</dd></div>
          <div><dt>Width</dt><dd>60 ft</dd></div>
          <div><dt>Average depth</dt><dd>6 ft</dd></div>
          <div><dt>Basin volume</dt><dd>≈ 1,333 yd³</dd></div>
          <div><dt>Water held</dt><dd>≈ 269,000 gal</dd></div>
        </dl>
        <p>100 × 60 × 6 = 36,000 cubic feet. 36,000 ÷ 27 = 1,333 cubic yards. Each cubic foot holds about 7.48 gallons.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ LOCAL GROUND / EXPERT ============ -->
<section class="section sp-expert pd-expert edge-curve-top" aria-labelledby="pd-ground-title">
  <div class="container-wide">
    <div class="sp-expert__grid">
      <div class="sp-expert__copy reveal-left">
        <span class="eyebrow">Local ground</span>
        <h2 id="pd-ground-title">How does Grayson County clay affect a new <span class="text-accent">pond</span>?</h2>
        <p class="answer-block">Grayson County clay affects a pond in two ways: it holds water well while it stays wet, and it shrinks and cracks when a drought pulls the level down. Those cracks can open seepage paths and crumble the bank face, so the waterline is the part of a Sherman-area pond that needs the most protection.</p>
        <div class="sp-figure"><b>200 ac-ft</b><span>Texas Water Code §11.142 limit for a permit-exempt pond</span></div>
        <ul class="sp-points">
          <li><?php echo icon('landmark', 20); ?><span><b>Exempt, within limits.</b> Section 11.142 lets a landowner build a dam or reservoir holding up to 200 acre-feet on their own property for domestic and livestock use without a state water permit. For irrigation, business use or anything larger, check with TCEQ before digging.</span></li>
          <li><?php echo icon('phone', 20); ?><span><b>Call 811 first.</b> Buried gas, water, power and fiber lines get marked at no charge before any excavation starts. Texas law expects that call before digging.</span></li>
          <li><?php echo icon('sun', 20); ?><span><b>Plan for the dry years.</b> North Texas summers pull a lot of water out of a pond through evaporation. A deeper section somewhere in the basin keeps water there through a long dry stretch.</span></li>
        </ul>
        <p>Starting from a wooded or overgrown spot? <a href="/services/land-clearing/">Land clearing ahead of the dig</a> opens the site first. If a low corner elsewhere on the property needs raising, <a href="/services/fill-dirt/">fill dirt for leveling and backfill</a> comes from the same phone call.</p>
      </div>
      <figure class="sp-photo reveal-right">
        <?php echo pictureTag('rip-rap-slope-filter-fabric', 'Workers rolling black filter fabric down a cleared bank beside piles of rip rap', '(max-width: 900px) 100vw, 520px'); ?>
        <figcaption>Filter fabric going down a cleared bank, with rip rap piled alongside.</figcaption>
      </figure>
    </div>
  </div>
</section>

<!-- ============ WHAT'S INCLUDED ============ -->
<section class="section on-dark texture-grain slant-top sp-breakdown" aria-labelledby="pd-breakdown-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="sp-breakdown__grid">
      <div class="reveal-left">
        <span class="eyebrow">What's included</span>
        <h2 id="pd-breakdown-title">What does pond work with HARDROCK Sand and Gravel cover?</h2>
        <p class="answer-block">HARDROCK Sand and Gravel covers pond work from an overgrown spot to a finished basin. That can mean clearing brush where the pond will sit, digging and shaping the basin around standing trees, and armoring banks with rip rap where waves hit. Every piece is priced together on one phone call.</p>
        <ul class="sp-included">
          <li><?php echo icon('check', 18); ?><span>Brush cleared off the pond site</span></li>
          <li><?php echo icon('check', 18); ?><span>Basin dug out and shaped</span></li>
          <li><?php echo icon('check', 18); ?><span>Mature trees worked around, as in the job pictured below</span></li>
          <li><?php echo icon('check', 18); ?><span>Rip rap set over filter fabric on exposed banks</span></li>
          <li><?php echo icon('check', 18); ?><span>Rock and dirt for the job hauled by the same company</span></li>
        </ul>
      </div>
      <ol class="sp-steps reveal-right">
        <li><b>Tell HARDROCK the plan</b><span>Call or send the form with the property location, the size you have in mind and what the pond is for: stock water, runoff or looks.</span></li>
        <li><b>Check the size</b><span>HARDROCK works through the length, width and depth with you, the same volume math shown above.</span></li>
        <li><b>Price and a start day</b><span>Both come back by phone, along with any clearing or rip rap the site needs.</span></li>
        <li><b>Dig, shape, armor</b><span>The basin is dug and shaped, and rip rap goes on the banks that need it.</span></li>
      </ol>
    </div>
  </div>
</section>

<!-- ============ BANK FINISH COMPARISON ============ -->
<section class="section sp-compare" aria-labelledby="pd-compare-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Finish the edge</span>
      <h2 id="pd-compare-title">Should a pond bank be left as clay, grassed, or covered in rip rap?</h2>
      <p class="answer-block">A pond bank that takes regular wave action should get rip rap over filter fabric, while a sheltered bank on a small pond can usually be seeded. Bare clay costs nothing extra on day one, but on Grayson County ground it is the finish most likely to slump and wash.</p>
    </div>
    <div class="sp-table-wrap reveal-up">
      <table class="sp-table">
        <caption>General guide. Grass protects nothing until its roots are established.</caption>
        <thead>
          <tr><th scope="col">Bank finish</th><th scope="col">Against waves and runoff</th><th scope="col">Upkeep</th><th scope="col">Where it fits</th></tr>
        </thead>
        <tbody>
          <tr><th scope="row">Bare clay, as dug</th><td>Notches at the waterline and slumps when soaked</td><td>Reshaping after wet seasons</td><td>Short term, until grass or rock goes on</td></tr>
          <tr><th scope="row">Grass seeded</th><td>Holds once rooted; weak for the first months</td><td>Mowing, reseeding bare patches</td><td>Sheltered banks and the dry side of a dam</td></tr>
          <tr class="is-this"><th scope="row">Rip rap on fabric</th><td>Holds: the rock takes the wave energy and the fabric keeps clay in place</td><td>An occasional check for shifted stones</td><td>The wind-facing bank, the water side of a dam, inflow points</td></tr>
        </tbody>
      </table>
    </div>
    <p class="reveal-up">In North Texas the prevailing south wind usually drives waves into the north bank, so that side is the first candidate for rock. The details of fabric, stone size and hand-setting are on the page about <a href="/services/rip-rap/">rip rap for pond banks and culverts</a>.</p>
  </div>
</section>

<!-- ============ PROOF ============ -->
<section class="section sp-proof pd-proof" aria-labelledby="pd-proof-title">
  <div class="container">
    <div class="sp-proof__single">
      <figure class="reveal-left">
        <?php echo pictureTag('pond-excavation-trees', 'Freshly dug, dry pond basin of pale grey clay with mature trees standing in and around it and spoil piled in the foreground', '(max-width: 900px) 100vw, 640px'); ?>
        <figcaption>A freshly dug basin among mature trees, spoil still piled in front.</figcaption>
      </figure>
      <div class="pd-proof__copy reveal-right">
        <span class="eyebrow">Recent work</span>
        <h2 id="pd-proof-title">What does a pond basin dug by HARDROCK look like?</h2>
        <p class="answer-block">This pond basin dug by HARDROCK was cut into pale grey clay in a stand of mature trees. Several trunks were left standing in and around the basin, and the dug spoil is still piled in the foreground. Nothing has been seeded or armored with rock yet.</p>
        <p>The basin in the photo is still dry. Ponds in this part of Texas fill from rain and runoff, so a new basin can sit low for weeks or months depending on the season it was dug in. Every other job and material HARDROCK handles is on <a href="/services/">the full list of HARDROCK services</a>.</p>
      </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
    echo p1_google_reviews($slug, ['heading' => 'What landowners around Sherman say on Google', 'heading_tag' => 'h3', 'limit' => 6]); ?>
    <div class="sp-proof__foot">
      <a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain edge-torn-top sp-faq" id="faq" aria-labelledby="pd-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="pd-faq-title">What do landowners ask HARDROCK before a pond is dug?</h2>
      <p>Landowners planning a pond with HARDROCK Sand and Gravel usually want to know two things first: whether HARDROCK works on their side of Grayson County, and how a pond job gets priced before any equipment shows up.</p>
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
<?php echo sp_related_section(['rip-rap', 'land-clearing', 'fill-dirt'],
    'What other work goes with a new <span class="text-accent">pond</span>?',
    'A new pond usually touches three other jobs. HARDROCK Sand and Gravel clears brush and trees off the site before digging, sets rip rap on banks that catch waves, and delivers fill dirt for low spots elsewhere on the property, so one Sherman company can carry the project from overgrown ground to a finished bank.'); ?>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Need a pond dug before the next wet season?',
    'Call HARDROCK Sand and Gravel with the property location and the size you have in mind, or send the form. HARDROCK is open from 6 AM Monday through Thursday and until 2 PM on Saturday.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
