<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$svc             = sp_service('fill-dirt');
$pageTitle       = 'Fill Dirt in Sherman, TX | Hardrock Sand And Gravel';
$pageDescription = 'Fill dirt delivered for leveling, backfill and raising grade on homes, farms and building sites in Sherman and Grayson County. Call HARDROCK at ' . formatPhone($phone) . '.';
$canonicalUrl    = $siteUrl . '/services/fill-dirt/';
$ogImage         = '/assets/images/excavator-crushed-rock-pad.jpg';
$currentPage     = 'services';
$pageType        = 'service';
$serviceSlug     = 'fill-dirt';
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = 'excavator-crushed-rock-pad';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* FAQ: research-brief questions this page can answer truthfully (delivery area, which material, pricing unit) */
$faqs = [
    ['q' => 'Do you deliver fill dirt to Sherman and nearby?',
     'a' => 'Yes. Hardrock Sand And Gravel delivers fill dirt in Sherman, Denison and across Grayson County. Call ' . $spCall . ' with the address and the size of the area, and HARDROCK will confirm the delivery and a drop day.'],
    ['q' => 'Is fill dirt the same thing as topsoil?',
     'a' => 'No. Fill dirt is subsoil meant to be packed down to build height, while topsoil carries the organic matter grass needs. Build the height with fill dirt, then finish with a few inches of topsoil only where you want a lawn or garden bed.'],
    ['q' => 'Is fill dirt priced by the ton or the cubic yard?',
     'a' => 'Both. Hardrock Sand And Gravel prices fill dirt by the ton and by the yard, and a full load is 20 yards or 20 tons. Bring your cubic-yard figure from the low-spot math on this page when you call ' . $spCall . ', and HARDROCK will give you the current delivered price.'],
];

$pageSchemas = [
    ['@context' => 'https://schema.org', '@graph' => [
        array_diff_key(generateServiceSchema($svc), ['@context' => 1]) + ['image' => $siteUrl . '/assets/images/excavator-crushed-rock-pad.jpg'],
        array_diff_key(sp_breadcrumb_schema($svc['name'], 'fill-dirt'), ['@context' => 1]),
        array_diff_key(generateFAQSchema($faqs), ['@context' => 1]),
    ]],
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style>
/* ==========================================================================
   /services/fill-dirt/ — page-specific composition
   Signature: a soil cross-section built in CSS (topsoil, three compacted fill lifts,
   cracked native clay) beside the fill / topsoil / select fill explainer.
   ========================================================================== */
.fd-hero .hero-bg img { object-position: 45% 55%; }
.fd-know { background: var(--color-surface); }
.fd-know__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.05fr); gap: var(--space-2xl); align-items: center; margin-bottom: var(--space-2xl); }
.fd-know__copy { display: grid; gap: var(--space-md); }
.fd-know__copy > p { margin: 0; color: var(--color-ink-2); max-width: var(--measure); }
.fd-profile { margin: 0; display: grid; border-radius: var(--radius-sm); overflow: hidden; border: 2px solid var(--color-dark); box-shadow: var(--shadow-lg); }
.fd-layer { position: relative; display: flex; justify-content: space-between; align-items: center; gap: var(--space-md); padding: var(--space-sm) var(--space-md);
  font-family: var(--font-accent); font-weight: 700; text-transform: uppercase; letter-spacing: .1em; font-size: var(--fs-small); color: var(--color-white);
  transition: filter var(--transition); }
.fd-layer em { font-style: normal; font-weight: 400; color: color-mix(in srgb, var(--color-white) 78%, transparent); text-align: right; }
.fd-layer:hover { filter: brightness(1.15); }
.fd-layer--top { min-height: 3.25rem; padding-top: calc(var(--space-sm) + var(--space-xs));
  background: linear-gradient(to bottom, var(--color-success) 0 var(--space-xs), color-mix(in srgb, var(--color-dark) 80%, var(--color-accent)) var(--space-xs) 100%); }
.fd-layer--lift { min-height: 4rem; border-bottom: 2px dashed color-mix(in srgb, var(--color-white) 40%, transparent); }
.fd-layer--lift:nth-child(2) { background: color-mix(in srgb, var(--color-accent) 22%, var(--color-dark-alt)); }
.fd-layer--lift:nth-child(3) { background: color-mix(in srgb, var(--color-accent) 30%, var(--color-dark-alt)); }
.fd-layer--lift:nth-child(4) { background: color-mix(in srgb, var(--color-accent) 38%, var(--color-dark-alt)); }
.fd-layer--native { min-height: 5.5rem; align-items: end;
  background:
    repeating-linear-gradient(112deg, transparent 0 var(--space-xl), color-mix(in srgb, var(--color-dark) 70%, transparent) var(--space-xl) calc(var(--space-xl) + 2px)),
    linear-gradient(to bottom, color-mix(in srgb, var(--color-secondary) 70%, var(--color-dark)), color-mix(in srgb, var(--color-secondary) 40%, var(--color-dark))); }
.fd-profile figcaption { padding: var(--space-sm) var(--space-md); background: var(--color-paper); color: var(--color-ink-2); font-size: var(--fs-small); }
.fd-signs .sp-sign--wide { background: linear-gradient(120deg, var(--color-card-tint-3) 0%, color-mix(in srgb, var(--color-accent) 10%, var(--color-surface)) 100%); }
.fd-proof .sp-proof__single figure picture { display: block; aspect-ratio: 4 / 3.3; overflow: hidden; }
.fd-proof .sp-proof__single figure img { width: 100%; height: 100%; object-fit: cover; }
.fd-proof__copy { display: grid; gap: var(--space-md); }
.fd-proof__copy > p { margin: 0; color: var(--color-ink-2); max-width: var(--measure); }
@media (max-width: 900px) { .fd-know__grid { grid-template-columns: 1fr; } }
@media (prefers-reduced-motion: reduce) { .fd-layer { transition: none; } .fd-layer:hover { filter: none; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero fd-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Yellow excavator on a graded, light-coloured pad beside a long pile of crushed rock, with power lines overhead', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo sp_breadcrumb($svc['name']); ?>
    <div class="hero-grid hero-grid--form">
      <div class="hero-text hero-copy">
        <span class="eyebrow">Fill dirt · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
        <h1 class="hero-title" id="sp-hero-title"><span class="text-accent">Fill Dirt</span> Delivered in Sherman, TX</h1>
        <p class="hero-answer">Hardrock Sand And Gravel delivers fill dirt to homes, farms and building sites in Sherman, Denison and across Grayson County. Fill dirt raises low spots, backfills trenches and walls, and builds up grade where water sits, and HARDROCK checks the quantity with you by phone before the load is scheduled.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('layers', 16); ?>Leveling and backfill</li>
          <li><?php echo icon('ruler', 16); ?>Quantity checked by phone</li>
          <li><?php echo icon('truck', 16); ?>Delivered in Grayson County</li>
        </ul>
      </div>

      <aside class="hero-form-card" id="estimate-form">
        <h2>Want a price on fill dirt?</h2>
        <p class="hero-form-tagline">Send the address and the size of the area to fill. We call back with a price.</p>
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

<!-- ============ WHERE FILL HELPS ============ -->
<section class="section sp-problem fd-signs" aria-labelledby="fd-problem-title">
  <div class="container">
    <div class="sp-problem__grid">
      <div class="sp-problem__lead reveal-left">
        <span class="eyebrow">Where it helps</span>
        <h2 id="fd-problem-title">Where does <span class="text-accent">fill dirt</span> fix a problem on a Sherman property?</h2>
        <p class="answer-block">Fill dirt fixes ground that sits too low or slopes the wrong way on a Sherman property. Typical jobs are puddles that last for days, soil sloping toward the house, trench and wall backfill, and areas raised for a shed or slab. On Grayson County clay, low spots rarely drain on their own.</p>
        <p class="pull-quote">If water still stands in the same spot two days after a rain, that ground needs raising, not more grass seed.</p>
      </div>
      <ul class="sp-signs">
        <li class="sp-sign sp-sign--wide reveal-up reveal-delay-1"><?php echo icon('house', 22); ?><b>Water running at the foundation</b><span>Residential building codes call for the ground to fall at least 6 inches within the first 10 feet away from a house. Fill rebuilds that slope where the soil has settled or washed.</span></li>
        <li class="sp-sign reveal-up reveal-delay-2"><?php echo icon('droplets', 22); ?><b>A yard that holds puddles</b><span>Low pockets in a lawn catch runoff and stay soft for days. Raising them a few inches sends the water on its way.</span></li>
        <li class="sp-sign reveal-up reveal-delay-3"><?php echo icon('pencil-ruler', 22); ?><b>Open trenches and new walls</b><span>Utility trenches, foundation edges and the space behind retaining walls all need backfilling once the work inside is finished.</span></li>
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('layers', 22); ?><b>Ground built up for something new</b><span>A shed, carport or work yard sits drier on ground raised above the grade around it.</span></li>
        <li class="sp-sign reveal-up reveal-delay-2"><?php echo icon('tractor', 22); ?><b>Ruts and washouts</b><span>Gullies cut by runoff across a pasture lane or yard can be filled and packed back to grade.</span></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ QUANTITY ============ -->
<section class="section sp-math fd-math edge-wave-top" aria-labelledby="fd-math-title">
  <div class="container">
    <div class="sp-math__grid">
      <div class="reveal-left">
        <span class="eyebrow">Order the right amount</span>
        <h2 id="fd-math-title">How much fill dirt does a low spot need?</h2>
        <p class="answer-block">A low spot needs length times width times depth in feet, divided by 27, plus extra for compaction. A 30-by-20-foot area raised 8 inches takes about 14.8 cubic yards before it is packed, so plan on roughly 16 to 18 cubic yards once the lifts are compacted.</p>
        <p>Turn inches into feet by dividing by 12, so 8 inches becomes 0.67 feet. Fill dirt loses volume as it is packed down, and wet clay loses more, so ordering a little over the raw figure saves coming up short with one corner unfinished. HARDROCK runs these numbers with you before anything is ordered.</p>
      </div>
      <div class="sp-math__card reveal-right">
        <p class="sp-math__formula">L × W × D <em>÷ 27 + packing</em></p>
        <dl class="sp-math__rows">
          <div><dt>Length</dt><dd>30 ft</dd></div>
          <div><dt>Width</dt><dd>20 ft</dd></div>
          <div><dt>Depth</dt><dd>8 in (0.67 ft)</dd></div>
          <div><dt>Loose volume</dt><dd>≈ 14.8 yd³</dd></div>
          <div><dt>Plus 10–20% for packing</dt><dd>≈ 16–18 yd³</dd></div>
        </dl>
        <p>30 × 20 × 0.67 = 400 cubic feet. 400 ÷ 27 = 14.8 cubic yards.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ HOW AN ORDER WORKS ============ -->
<section class="section on-dark texture-grain edge-torn-top sp-breakdown" aria-labelledby="fd-breakdown-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="sp-breakdown__grid">
      <div class="reveal-left">
        <span class="eyebrow">How it works</span>
        <h2 id="fd-breakdown-title">How does a fill dirt order with HARDROCK work?</h2>
        <p class="answer-block">A fill dirt order with Hardrock Sand And Gravel starts with a call or the form and ends with the load dropped on your property. In between, HARDROCK checks the quantity against your measurements and gives the price and a delivery day over the phone.</p>
        <ul class="sp-included">
          <li><?php echo icon('check', 18); ?><span>Length, width and depth of the area to fill</span></li>
          <li><?php echo icon('check', 18); ?><span>What the fill is for: low spot, backfill or raised grade</span></li>
          <li><?php echo icon('check', 18); ?><span>Where on the property the load should land</span></li>
          <li><?php echo icon('check', 18); ?><span>A firm, open drop spot clear of septic lines and soft ground</span></li>
        </ul>
      </div>
      <ol class="sp-steps reveal-right">
        <li><b>Call or send the form</b><span>Give the address and what the fill is for. The checklist beside this list covers what to have ready.</span></li>
        <li><b>Quantity check</b><span>Your measurements go through the cubic-yard math, with room added for packing.</span></li>
        <li><b>Price and a drop day</b><span>HARDROCK quotes the load and sets the day by phone.</span></li>
        <li><b>Load dropped</b><span>The fill dirt is dumped at the spot you picked, ready to be spread and compacted in lifts.</span></li>
      </ol>
    </div>
  </div>
</section>

<!-- ============ FILL vs TOPSOIL vs SELECT (signature: soil cross-section) ============ -->
<section class="section sp-compare fd-know edge-curve-top" aria-labelledby="fd-know-title">
  <div class="container">
    <div class="fd-know__grid">
      <div class="fd-know__copy reveal-left">
        <span class="eyebrow">Know the dirt</span>
        <h2 id="fd-know-title">What is the difference between fill dirt, topsoil and select fill?</h2>
        <p class="answer-block">The difference between fill dirt, topsoil and select fill is where each one belongs in the ground. Fill dirt is subsoil that builds up grade, topsoil is the organic top layer that grows grass, and select fill is a low-shrink sandy clay that engineers often call for under slabs.</p>
        <p>Fill goes down in lifts rather than one deep dump. Each layer, commonly 6 to 8 inches loose, is spread and compacted before the next one goes on, and topsoil returns on top only where something needs to grow. For a slab, see how <a href="/services/house-pads/">house pads are built up with fill and base</a>.</p>
      </div>
      <figure class="fd-profile reveal-right" aria-label="Cross-section of filled ground, top to bottom">
        <div class="fd-layer fd-layer--top">Topsoil <em>a few inches, grows grass</em></div>
        <div class="fd-layer fd-layer--lift">Fill lift 3 <em>spread, then compacted</em></div>
        <div class="fd-layer fd-layer--lift">Fill lift 2 <em>spread, then compacted</em></div>
        <div class="fd-layer fd-layer--lift">Fill lift 1 <em>spread, then compacted</em></div>
        <div class="fd-layer fd-layer--native">Native clay <em>Blackland Prairie subgrade</em></div>
        <figcaption>How filled ground is layered: fill packed in lifts over the native clay, topsoil only at the surface.</figcaption>
      </figure>
    </div>
    <div class="sp-table-wrap reveal-up">
      <table class="sp-table">
        <caption>General guide. HARDROCK sells fill dirt; call about any soil a set of plans specifies.</caption>
        <thead>
          <tr><th scope="col">Material</th><th scope="col">What it is</th><th scope="col">Packs down firm?</th><th scope="col">Grows grass?</th><th scope="col">Best use</th></tr>
        </thead>
        <tbody>
          <tr class="is-this"><th scope="row">Fill dirt</th><td>Subsoil, often clay-heavy, with few roots or organics</td><td>Yes, in lifts</td><td>Poorly without topsoil over it</td><td>Raising grade, low spots, trench and wall backfill</td></tr>
          <tr><th scope="row">Topsoil</th><td>The upper layer, rich in organic matter</td><td>No; settles as the organics break down</td><td>Yes</td><td>The last few inches under lawns and beds</td></tr>
          <tr><th scope="row">Select fill</th><td>Sandy clay with a low shrink-swell rating</td><td>Yes, to an engineered density</td><td>Poorly</td><td>Under slabs and foundations where plans call for it</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- ============ PROOF + LOCAL CLAY ============ -->
<section class="section sp-proof fd-proof" aria-labelledby="fd-proof-title">
  <div class="container">
    <div class="sp-proof__single">
      <figure class="reveal-left">
        <?php echo pictureTag('excavator-crushed-rock-pad', 'Yellow excavator working beside a long pile of light grey crushed rock on a graded pad under transmission lines', '(max-width: 900px) 100vw, 640px'); ?>
        <figcaption>An excavator on a graded pad, crushed rock piled alongside, power lines overhead.</figcaption>
      </figure>
      <div class="fd-proof__copy reveal-right">
        <span class="eyebrow">Recent work and local ground</span>
        <h2 id="fd-proof-title">Why does fill on Grayson County clay need careful grading?</h2>
        <p class="answer-block">Fill on Grayson County clay needs careful grading because the native ground swells when wet and shrinks when dry. The graded pad in this HARDROCK photo shows the goal: a flat, even surface graded so water runs off instead of soaking in under whatever gets built there.</p>
        <ul class="sp-points">
          <li><?php echo icon('droplets', 20); ?><span><b>Slope it away.</b> Finished fill should shed water away from slabs and walls, never toward them.</span></li>
          <li><?php echo icon('layers', 20); ?><span><b>Pack every lift.</b> Loose fill dumped deep settles for months and leaves a dip where it was meant to be level.</span></li>
          <li><?php echo icon('house', 20); ?><span><b>Keep it below the siding.</b> Soil heaped against brick weep holes or wood trim holds moisture where it does damage.</span></li>
        </ul>
        <p>Need several materials on one site? <a href="/services/delivery/">Bulk delivery across Grayson County</a> covers sand, gravel, rock and dirt, and every service is listed on <a href="/services/">the HARDROCK services page</a>.</p>
      </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
    echo p1_google_reviews($slug, ['heading' => 'What Sherman and Denison customers say on Google', 'heading_tag' => 'h3', 'limit' => 6]); ?>
    <div class="sp-proof__foot">
      <a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain slant-top sp-faq" id="faq" aria-labelledby="fd-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="fd-faq-title">What do customers ask HARDROCK before ordering fill dirt?</h2>
      <p>Customers ordering fill dirt from Hardrock Sand And Gravel tend to ask three things first: whether HARDROCK delivers to their address, whether fill dirt can stand in for topsoil, and how a fill dirt load gets priced.</p>
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
<?php echo sp_related_section(['house-pads', 'ponds', 'delivery'],
    'What other jobs use <span class="text-accent">fill dirt</span>?',
    'Fill dirt turns up inside bigger jobs too. Hardrock Sand And Gravel builds house pads with fill and base ahead of new slabs, digs ponds that move a lot of dirt from one place to another, and delivers bulk sand, gravel, rock and fill across Sherman and Grayson County for owners doing the spreading themselves.'); ?>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Need fill dirt for a low spot or a backfill?',
    'Send the measurements through the form or call Hardrock Sand And Gravel. HARDROCK is open Saturday from 9 AM to 2 PM, so a weekend project can still get a price lined up.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
