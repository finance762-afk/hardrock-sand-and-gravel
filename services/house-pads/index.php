<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$svc             = sp_service('house-pads');
$pageTitle       = 'House Pads in Sherman, TX | HARDROCK Sand and Gravel';
$pageDescription = 'House pads raised and leveled with fill and base for new slabs in Sherman, Denison and Grayson County. Call HARDROCK at ' . formatPhone($phone) . ' with your pad spec.';
$canonicalUrl    = $siteUrl . '/services/house-pads/';
$ogImage         = '/assets/images/excavator-crushed-rock-pad.jpg';
$currentPage     = 'services';
$pageType        = 'service';
$serviceSlug     = 'house-pads';
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = 'excavator-crushed-rock-pad';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* FAQ: research-brief questions this page can answer truthfully (service area, pricing unit) */
$faqs = [
    ['q' => 'Do you build house pads around Sherman and Denison?',
     'a' => 'Yes. HARDROCK Sand and Gravel builds house pads in Sherman, Denison and the rest of Grayson County. Call ' . $spCall . ' with the site address and the slab size, and have the pad spec close by if the builder or engineer has written one.'],
    ['q' => 'Do you price pad fill by the ton or the cubic yard?',
     'a' => 'HARDROCK Sand and Gravel quotes each house pad by phone, because the pad size, the height, the material in the spec and the haul all change the number. Bring the cubic-yard figure from the pad math on this page, and HARDROCK will give you the current price and how the fill is measured.'],
];

$pageSchemas = [
    ['@context' => 'https://schema.org', '@graph' => [
        array_diff_key(generateServiceSchema($svc), ['@context' => 1]) + ['image' => $siteUrl . '/assets/images/excavator-crushed-rock-pad.jpg'],
        array_diff_key(sp_breadcrumb_schema($svc['name'], 'house-pads'), ['@context' => 1]),
        array_diff_key(generateFAQSchema($faqs), ['@context' => 1]),
    ]],
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style>
/* ==========================================================================
   /services/house-pads/ — page-specific composition
   Signature: the site-plan sheet — a gridded blueprint band with the worked pad drawn in plan view.
   ========================================================================== */
.hp-hero .hero-bg img { object-position: 50% 55%; }
.hp-problem .sp-signs { grid-template-columns: repeat(2, minmax(0, 1fr)); }
.hp-problem .sp-sign:first-child { grid-column: 1 / -1; }
.hp-problem .sp-problem__lead > p:not(.answer-block):not(.pull-quote) { margin: 0; color: var(--color-ink-2); }

.hp-plan::before { content: ""; position: absolute; inset: 0; z-index: -1; pointer-events: none;
  background-image: linear-gradient(color-mix(in srgb, var(--color-white) 7%, transparent) 1px, transparent 1px),
                    linear-gradient(90deg, color-mix(in srgb, var(--color-white) 7%, transparent) 1px, transparent 1px);
  background-size: var(--space-xl) var(--space-xl); }
.hp-plan__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); gap: var(--space-3xl); align-items: start; }
.hp-plan__copy { display: grid; gap: var(--space-md); }
.hp-plan .answer-block { background: color-mix(in srgb, var(--color-white) 7%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.hp-spec { display: grid; gap: 0; margin: 0; }
.hp-spec div { display: grid; grid-template-columns: 10rem minmax(0, 1fr); gap: var(--space-md); padding: var(--space-sm) 0; border-bottom: 1px dashed color-mix(in srgb, var(--color-white) 22%, transparent); }
.hp-spec dt { font-family: var(--font-accent); font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: var(--color-accent-bright); }
.hp-spec dd { margin: 0; color: color-mix(in srgb, var(--color-white) 80%, transparent); font-size: .95rem; }
.hp-sheet { margin: 0; padding: var(--space-xl); border: 2px solid color-mix(in srgb, var(--color-white) 30%, transparent); border-radius: var(--radius-sm); background: color-mix(in srgb, var(--color-primary) 55%, transparent); box-shadow: var(--shadow-lg); }
.hp-sheet__pad { position: relative; aspect-ratio: 70 / 50; margin: var(--space-xl) var(--space-lg) var(--space-md) var(--space-xl); border: 2px dashed var(--color-accent-bright); background: color-mix(in srgb, var(--color-accent) 14%, transparent); }
.hp-sheet__slab { position: absolute; inset: 10% 7.14%; display: grid; place-content: center; text-align: center; gap: var(--space-1); border: 2px solid var(--color-white); background: color-mix(in srgb, var(--color-white) 10%, transparent); }
.hp-sheet__slab b { font-family: var(--font-heading); text-transform: uppercase; letter-spacing: .04em; color: var(--color-white); font-size: 1.2rem; }
.hp-sheet__slab span { font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 75%, transparent); }
.hp-dim { position: absolute; font-family: var(--font-accent); font-weight: 700; font-size: var(--fs-small); letter-spacing: .08em; text-transform: uppercase; color: var(--color-accent-bright); }
.hp-dim--w { left: 0; right: 0; bottom: 100%; padding-bottom: var(--space-1); text-align: center; border-bottom: 1px solid currentColor; }
.hp-dim--h { top: 0; bottom: 0; right: 100%; padding-right: var(--space-1); writing-mode: vertical-rl; transform: rotate(180deg); text-align: center; border-left: 1px solid currentColor; }
.hp-stake { position: absolute; width: var(--space-sm); height: var(--space-sm); background: var(--color-accent); border: 2px solid var(--color-white); transform: translate(-50%, -50%) rotate(45deg); }
.hp-stake:nth-of-type(1) { top: 0; left: 0; } .hp-stake:nth-of-type(2) { top: 0; left: 100%; }
.hp-stake:nth-of-type(3) { top: 100%; left: 0; } .hp-stake:nth-of-type(4) { top: 100%; left: 100%; }
.hp-sheet figcaption { margin-top: var(--space-sm); font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 72%, transparent); }
.hp-proof .sp-proof__single { margin-bottom: var(--space-2xl); }
@media (max-width: 900px) { .hp-plan__grid { grid-template-columns: 1fr; gap: var(--space-2xl); } }
@media (max-width: 560px) { .hp-spec div { grid-template-columns: 1fr; gap: var(--space-1); } .hp-problem .sp-signs { grid-template-columns: 1fr; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero hp-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Yellow excavator beside a long pile of light grey crushed rock on a graded, light-coloured pad, with power transmission lines overhead', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo sp_breadcrumb($svc['name']); ?>
    <div class="hero-grid hero-grid--form">
      <div class="hero-text hero-copy">
        <span class="eyebrow">House pads · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
        <h1 class="hero-title" id="sp-hero-title"><span class="text-accent">House Pads</span> for New Slabs in Sherman, TX</h1>
        <p class="hero-answer">HARDROCK Sand and Gravel builds house pads across Sherman, Denison and Grayson County, raising and leveling the building site with fill and base material so the new slab goes down on flat, firm ground. Send the builder's or engineer's pad spec, and HARDROCK prices the material and the work by phone.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('house', 16); ?>Pads for new slabs</li>
          <li><?php echo icon('layers', 16); ?>Fill and base material</li>
          <li><?php echo icon('phone', 16); ?>Priced by phone</li>
        </ul>
      </div>

      <aside class="hero-form-card" id="estimate-form">
        <h2>Want a price on a house pad?</h2>
        <p class="hero-form-tagline">Send the slab size and the site address. HARDROCK calls back with a price.</p>
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
<section class="section sp-problem hp-problem" aria-labelledby="hp-problem-title">
  <div class="container">
    <div class="sp-problem__grid">
      <div class="sp-problem__lead reveal-left">
        <span class="eyebrow">Building on clay</span>
        <h2 id="hp-problem-title">Why does a new slab in Grayson County need a raised house pad?</h2>
        <p class="answer-block">A new slab needs a raised house pad in Grayson County because the native clay moves. Blackland Prairie soils such as Houston Black clay swell when wet and shrink as they dry, and a pad of controlled fill lifts the slab clear of standing water and gives it even, compacted support.</p>
        <p class="pull-quote">A slab is only as level as the pad it was poured on.</p>
        <p>Lot still wooded? HARDROCK also handles <a href="/services/land-clearing/">clearing brush and trees off a building site</a> before the first load of fill arrives.</p>
      </div>
      <ul class="sp-signs">
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('clipboard-list', 22); ?><b>The plans call for select fill</b><span>Engineers' reports for slabs on expansive clay often specify a set depth of select fill under the foundation. When there is a report, that spec drives the order, not a rule of thumb.</span></li>
        <li class="sp-sign reveal-up reveal-delay-2"><?php echo icon('droplets', 22); ?><b>Water stands on the lot</b><span>Flat Blackland ground can hold rain for days. A pad lifts the finished floor above it.</span></li>
        <li class="sp-sign reveal-up reveal-delay-3"><?php echo icon('ruler', 22); ?><b>The footprint slopes</b><span>One corner sits well below another, so fill has to make up the difference before forms go up.</span></li>
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('trees', 22); ?><b>Roots and topsoil remain</b><span>Organic soil rots and settles under a slab, so it comes out before any fill goes in.</span></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ QUANTITY ============ -->
<section class="section sp-math edge-curve-top" aria-labelledby="hp-math-title">
  <div class="container">
    <div class="sp-math__grid">
      <div class="reveal-left">
        <span class="eyebrow">Size the pad</span>
        <h2 id="hp-math-title">How much fill does a house pad take?</h2>
        <p class="answer-block">A house pad takes its length times width times height in feet, divided by 27, in cubic yards of compacted fill. A 40 by 60 foot slab with 5 feet of pad around it, raised 12 inches, comes to about 130 cubic yards before allowing for compaction.</p>
        <p>Pads are normally built wider than the slab so the form boards and the slab edge rest on fill instead of the shoulder of the pad; the builder sets the exact margin. Loose fill packs down as each lift is compacted, so the delivered volume runs higher than the finished pad. How much higher depends on the material and how hard it is compacted, which is why HARDROCK checks the numbers with you first.</p>
      </div>
      <div class="sp-math__card reveal-right">
        <p class="sp-math__formula">Pad L × W × Height <em>÷ 27</em></p>
        <dl class="sp-math__rows">
          <div><dt>Slab</dt><dd>40 × 60 ft</dd></div>
          <div><dt>Pad, 5 ft margin</dt><dd>50 × 70 ft</dd></div>
          <div><dt>Height</dt><dd>12 in (1 ft)</dd></div>
          <div><dt>Compacted fill</dt><dd>≈ 129.6 yd³</dd></div>
        </dl>
        <p>50 × 70 × 1 = 3,500 cubic feet. 3,500 ÷ 27 = 129.6 cubic yards.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ SIGNATURE: SITE-PLAN SHEET ============ -->
<section class="section on-dark texture-grain edge-torn-top hp-plan" aria-labelledby="hp-plan-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="hp-plan__grid">
      <div class="hp-plan__copy reveal-left">
        <span class="eyebrow">Read the spec</span>
        <h2 id="hp-plan-title">What should a house pad spec tell HARDROCK before pricing?</h2>
        <p class="answer-block">A house pad spec should tell HARDROCK five things: the pad size, the finished height, the fill material, the lift thickness and compaction, and how the pad drains. With those in hand, HARDROCK can price the pad the builder and the slab crew actually expect to find.</p>
        <dl class="hp-spec">
          <div><dt>Pad size</dt><dd>The slab footprint plus the margin the builder wants on each side.</dd></div>
          <div><dt>Finished height</dt><dd>Tied to the finished floor elevation or a benchmark on the plans.</dd></div>
          <div><dt>Fill material</dt><dd>Select fill, fill dirt or a road-base cap, as the report names it. Select fill is usually held to a plasticity index (PI) range.</dd></div>
          <div><dt>Lifts</dt><dd>Fill placed in thin layers, each compacted, often to a set percentage of standard Proctor density.</dd></div>
          <div><dt>Drainage</dt><dd>A pad that sheds water away from the slab on every side.</dd></div>
        </dl>
      </div>
      <figure class="hp-sheet reveal-right">
        <div class="hp-sheet__pad">
          <span class="hp-dim hp-dim--w">Pad 70 ft</span>
          <span class="hp-dim hp-dim--h">50 ft</span>
          <i class="hp-stake" aria-hidden="true"></i><i class="hp-stake" aria-hidden="true"></i><i class="hp-stake" aria-hidden="true"></i><i class="hp-stake" aria-hidden="true"></i>
          <div class="hp-sheet__slab"><b>Slab 40 × 60</b><span>5 ft of pad on every side</span></div>
        </div>
        <figcaption>Plan view of the worked example above: a 40 × 60 ft slab centred on a 50 × 70 ft pad, staked at the corners.</figcaption>
      </figure>
    </div>
  </div>
</section>

<!-- ============ COMPARISON ============ -->
<section class="section sp-compare" aria-labelledby="hp-compare-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Choose the fill</span>
      <h2 id="hp-compare-title">Fill dirt, select fill or road base: which belongs in a house pad?</h2>
      <p class="answer-block">Which material belongs in a house pad depends on the engineer's spec, but each has a usual job. Fill dirt builds up general grade, select fill forms the controlled layer under the slab on expansive clay, and road base caps the pad or carries trucks onto it.</p>
    </div>
    <div class="sp-table-wrap reveal-up">
      <table class="sp-table">
        <caption>Where an engineer's report exists, follow it; it overrides any rule of thumb in this table.</caption>
        <thead>
          <tr><th scope="col">Material</th><th scope="col">What it is</th><th scope="col">Where it goes in a pad</th><th scope="col">On expansive clay</th><th scope="col">From HARDROCK</th></tr>
        </thead>
        <tbody>
          <tr><th scope="row">Native clay, leveled</th><td>The lot's own soil, cut and shaped</td><td>Rarely enough alone; the slab sits on ground that moves</td><td>Shrinks and swells with moisture</td><td>Nothing to order</td></tr>
          <tr class="is-this"><th scope="row">Fill dirt</th><td>Soil hauled in to raise grade</td><td>Builds up low or sloping lots where the spec allows</td><td>Depends on the soil; clay-rich fill can move like the native clay</td><td>Sold and delivered</td></tr>
          <tr><th scope="row">Select fill</th><td>Sandy clay held to a plasticity index range</td><td>The layer under the slab when the engineer calls for it</td><td>Moves far less than native clay</td><td>Ask with the spec in hand</td></tr>
          <tr><th scope="row">Road base</th><td>Crushed rock blended with fines</td><td>A cap on the pad, the drive in and equipment aprons</td><td>Compacts hard and does not swell</td><td>Sold and delivered</td></tr>
        </tbody>
      </table>
    </div>
    <p class="reveal-up">Both stocked pad materials have their own pages: <a href="/services/fill-dirt/">fill dirt for raising and leveling a lot</a>, and <a href="/services/road-base/">road base for the pad cap and the drive in</a>.</p>
  </div>
</section>

<!-- ============ SERVICE BREAKDOWN ============ -->
<section class="section on-dark texture-grain edge-wave-top sp-breakdown" aria-labelledby="hp-breakdown-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="sp-breakdown__grid">
      <div class="reveal-left">
        <span class="eyebrow">From plans to pad</span>
        <h2 id="hp-breakdown-title">How does a house pad job with HARDROCK move from plans to a finished pad?</h2>
        <p class="answer-block">A HARDROCK house pad job runs from plans to pad in four steps, all set up by phone. You send the slab size, the site address and the spec; HARDROCK works out the yards of fill and base; you get a price and a day; then the pad is built for the slab crew.</p>
        <ul class="sp-included">
          <li><?php echo icon('map-pin', 18); ?><span>Site address, or the lot and subdivision name</span></li>
          <li><?php echo icon('ruler', 18); ?><span>Slab dimensions from the plans</span></li>
          <li><?php echo icon('clipboard-list', 18); ?><span>The engineer's report or builder's pad spec, if one exists</span></li>
          <li><?php echo icon('layers', 18); ?><span>Finished floor height, or how far the pad must rise</span></li>
          <li><?php echo icon('trees', 18); ?><span>Whether trees or brush stand on the footprint</span></li>
        </ul>
        <p>Builders working to a schedule can reach HARDROCK from 6 AM Monday through Thursday, 9 to 5 on Friday and 9 to 2 on Saturday.</p>
      </div>
      <ol class="sp-steps reveal-right">
        <li><b>Send the plans</b><span>Slab size, address and any pad spec, by phone or through the form.</span></li>
        <li><b>Yards worked out</b><span>Fill and base quantities are figured from the finished pad dimensions.</span></li>
        <li><b>Price and a start day</b><span>HARDROCK gives the number and a day to begin over the phone.</span></li>
        <li><b>Pad built</b><span>Fill and base go in, leaving a level pad ready for the forms.</span></li>
      </ol>
    </div>
  </div>
</section>

<!-- ============ PROOF ============ -->
<section class="section sp-proof hp-proof" aria-labelledby="hp-proof-title">
  <div class="container">
    <div class="sp-proof__single">
      <figure class="reveal-scale">
        <?php echo pictureTag('gravel-stockpiles-job-site', 'Rows of grey gravel piles dumped across a large staked, graded site at sunset, with survey stakes and flags in front', '(max-width: 900px) 100vw, 620px'); ?>
        <figcaption>Loads dropped in rows across a staked, graded site.</figcaption>
      </figure>
      <div class="section-title reveal-up">
        <span class="eyebrow">Recent Work</span>
        <h2 id="hp-proof-title">What does a staked building site look like with HARDROCK loads on it?</h2>
        <p class="answer-block">A staked building site with HARDROCK loads on it looks like this photo: rows of grey gravel piles dumped across graded ground at sunset, with survey stakes and flags marking the layout in front. Dropping the loads in rows across the site keeps the material close to where it will be spread.</p>
      </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
    echo p1_google_reviews($slug, ['heading' => 'What Grayson County builders and owners say on Google', 'heading_tag' => 'h3', 'limit' => 6]); ?>
    <div class="sp-proof__foot">
      <a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a>
      <p>House pads sit alongside driveways, ponds, clearing and eight bulk materials on <a href="/services/">the HARDROCK services overview</a>.</p>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain slant-top sp-faq" id="faq" aria-labelledby="hp-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="hp-faq-title">What do builders ask HARDROCK before ordering a house pad?</h2>
      <p>Builders and owners lining up a house pad with HARDROCK tend to start with two questions: whether HARDROCK works in their part of the county, and how the fill for the pad is measured and priced.</p>
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
<?php echo sp_related_section(['fill-dirt', 'road-base', 'land-clearing'],
    'What other work comes before <span class="text-accent">the slab is poured</span>?',
    'Before a slab goes down, many lots need more than the pad itself. HARDROCK Sand and Gravel clears brush and trees off the footprint, delivers fill dirt to raise and level the ground, and supplies road base for the pad cap and the drive the concrete trucks will use.'); ?>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Need a pad ready before the slab crew arrives?',
    'Call HARDROCK Sand and Gravel or send the form with the slab size and the site address. The sooner the pad is on the calendar, the sooner the forms can go up.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
