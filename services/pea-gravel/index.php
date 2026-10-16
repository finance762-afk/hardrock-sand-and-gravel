<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$svc             = sp_service('pea-gravel');
$pageTitle       = 'Pea Gravel in Sherman, TX | Hardrock Sand And Gravel';
$pageDescription = 'Small, rounded pea gravel for walkways, play areas, dog runs and drainage, delivered across Sherman, Denison and Grayson County. Call HARDROCK at ' . formatPhone($phone) . '.';
$canonicalUrl    = $siteUrl . '/services/pea-gravel/';
$ogImage         = '/assets/images/pea-gravel-closeup.jpg';
$currentPage     = 'services';
$pageType        = 'service';
$serviceSlug     = 'pea-gravel';
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = 'pea-gravel-closeup';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* FAQ: research-brief questions this page can answer truthfully (delivery area, quantity, pricing unit) */
$faqs = [
    ['q' => 'Does HARDROCK deliver pea gravel to Sherman and nearby towns?',
     'a' => 'Yes. Hardrock Sand And Gravel delivers pea gravel in Sherman, Denison and across Grayson County. Give the address and the size of the area when you call ' . $spCall . ', and the price and the delivery day get settled on that call.'],
    ['q' => 'How much pea gravel do I need for a garden walkway?',
     'a' => 'Multiply the walkway length by its width and by the depth, all in feet, then divide by 27 for cubic yards. A path 4 feet wide and 30 feet long at 3 inches deep works out to about 1.1 cubic yards. Round up slightly so low spots can be topped off later.'],
    ['q' => 'How is pea gravel priced?',
     'a' => 'Hardrock Sand And Gravel prices pea gravel by the ton and by the yard, and a full load is 20 yards or 20 tons. The delivered total depends on the amount and the drop-off address, so have your cubic-yard figure ready when you call ' . $spCall . '.'],
];

$pageSchemas = [
    ['@context' => 'https://schema.org', '@graph' => [
        array_diff_key(generateServiceSchema($svc), ['@context' => 1]) + ['image' => $siteUrl . '/assets/images/pea-gravel-closeup.jpg'],
        array_diff_key(sp_breadcrumb_schema($svc['name'], 'pea-gravel'), ['@context' => 1]),
        array_diff_key(generateFAQSchema($faqs), ['@context' => 1]),
    ]],
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style>
/* ==========================================================================
   /services/pea-gravel/ — page-specific composition
   Signature: the pebble-dot "underfoot" band with pebble-shaped numbered keys and a depth gauge.
   ========================================================================== */
.pg-hero .hero-bg img { object-position: 50% 55%; }

/* Pebble-dot band: three offset radial-gradient layers, faded out toward the bottom by a mask */
.pg-underfoot { position: relative; isolation: isolate; background: var(--color-paper-2); }
.pg-underfoot::before { content: ""; position: absolute; inset: 0; z-index: -1; pointer-events: none;
  background-image:
    radial-gradient(circle at 30% 35%, color-mix(in srgb, var(--color-secondary) 26%, transparent) 0 22%, transparent 24%),
    radial-gradient(circle at 70% 60%, color-mix(in srgb, var(--color-accent) 18%, transparent) 0 18%, transparent 20%),
    radial-gradient(circle at 55% 20%, color-mix(in srgb, var(--color-primary) 14%, transparent) 0 14%, transparent 16%);
  background-size: var(--space-xl) var(--space-xl), calc(var(--space-xl) * 1.4) calc(var(--space-xl) * 1.4), var(--space-lg) var(--space-lg);
  -webkit-mask-image: linear-gradient(to bottom, var(--color-dark) 0%, transparent 55%);
  mask-image: linear-gradient(to bottom, var(--color-dark) 0%, transparent 55%); }
.pg-underfoot__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.15fr); gap: var(--space-2xl); align-items: start; }
.pg-underfoot__copy { display: grid; gap: var(--space-md); }
.pg-underfoot__copy > p { margin: 0; color: var(--color-ink-2); max-width: var(--measure); }
.pg-keys { counter-reset: pgkey; display: grid; gap: var(--space-md); margin: 0; padding: 0; list-style: none; }
.pg-key { counter-increment: pgkey; position: relative; display: grid; grid-template-columns: auto 1fr; gap: var(--space-md); align-items: start;
  padding: var(--space-lg); background: var(--color-surface); border: 1px solid var(--color-line); border-radius: var(--radius-sm); box-shadow: var(--shadow-sm);
  transition: transform var(--transition), box-shadow var(--transition); }
.pg-key:hover { transform: translateX(var(--space-1)); box-shadow: var(--shadow); }
.pg-key::before { content: counter(pgkey); display: grid; place-items: center; width: 3rem; height: 2.6rem;
  border-radius: 52% 48% 55% 45% / 58% 50% 50% 42%; font-family: var(--font-accent); font-weight: 800; font-size: 1.3rem;
  color: var(--color-white); background: radial-gradient(circle at 35% 30%, color-mix(in srgb, var(--color-secondary) 70%, var(--color-white)), var(--color-primary)); box-shadow: var(--shadow-sm); }
.pg-key b { display: block; font-family: var(--font-heading); font-size: 1.1rem; text-transform: uppercase; letter-spacing: .02em; color: var(--color-ink); }
.pg-key span { font-size: .95rem; color: var(--color-ink-2); }
.pg-key:nth-child(2)::before { border-radius: 45% 55% 48% 52% / 50% 44% 56% 50%; background: radial-gradient(circle at 35% 30%, color-mix(in srgb, var(--color-accent) 60%, var(--color-white)), var(--color-accent-dark)); }
/* Depth gauge: one bar per use, length scaled to depth in inches (9 in. = full width) */
.pg-gauge { display: grid; gap: var(--space-sm); margin: var(--space-sm) 0 0; padding: var(--space-lg); list-style: none; border-radius: var(--radius-sm); background: var(--color-dark); box-shadow: var(--shadow); }
.pg-gauge li { display: grid; grid-template-columns: 9rem 1fr; gap: var(--space-sm); align-items: center; font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 80%, transparent); }
.pg-gauge i { display: block; height: var(--space-sm); border-radius: var(--radius-full); font-style: normal;
  background: radial-gradient(circle, color-mix(in srgb, var(--color-white) 55%, transparent) 0 30%, transparent 34%) 0 50% / var(--space-sm) var(--space-sm) repeat-x, var(--color-accent); }
.pg-gauge .pg-d2 { width: 22%; } .pg-gauge .pg-d3 { width: 33%; } .pg-gauge .pg-d9 { width: 100%; }
.pg-gauge b { font-family: var(--font-accent); text-transform: uppercase; letter-spacing: .08em; color: var(--color-white); }
.pg-compare .sp-table td:nth-child(3) { font-weight: 600; }
@media (max-width: 900px) { .pg-underfoot__grid { grid-template-columns: 1fr; } }
@media (max-width: 480px) { .pg-gauge li { grid-template-columns: 1fr; } }
@media (prefers-reduced-motion: reduce) { .pg-key { transition: none; } .pg-key:hover { transform: none; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero pg-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Close-up of small, rounded grey and tan pea gravel', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo sp_breadcrumb($svc['name']); ?>
    <div class="hero-grid hero-grid--form">
      <div class="hero-text hero-copy">
        <span class="eyebrow">Pea gravel · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
        <h1 class="hero-title" id="sp-hero-title"><span class="text-accent">Pea Gravel</span> for Paths and Play Areas in Sherman, TX</h1>
        <p class="hero-answer">Hardrock Sand And Gravel delivers pea gravel to homes in Sherman, Denison and across Grayson County. The small, rounded stone suits garden walkways, backyard play areas, dog runs and drainage strips by downspouts, and it fits homeowners who want a surface that drains fast and rakes level in a few minutes.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('footprints', 16); ?>Paths, play areas, drainage</li>
          <li><?php echo icon('phone', 16); ?>Priced by phone</li>
          <li><?php echo icon('clock', 16); ?>Mon–Thu from 6 AM</li>
        </ul>
      </div>

      <aside class="hero-form-card" id="estimate-form">
        <h2>Want a price on pea gravel?</h2>
        <p class="hero-form-tagline">Send the area size and address. HARDROCK calls back with a price.</p>
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

<!-- ============ WHERE IT WORKS ============ -->
<section class="section sp-problem pg-uses" aria-labelledby="pg-uses-title">
  <div class="container">
    <div class="sp-problem__grid">
      <div class="sp-problem__lead reveal-left">
        <span class="eyebrow">Where it works</span>
        <h2 id="pg-uses-title">Where does <span class="text-accent">pea gravel</span> work around a Grayson County home?</h2>
        <p class="answer-block">Pea gravel works best on flat ground where people walk, kids play or rain needs a quick way out. Think garden paths, play areas, dog runs and the strip beside a foundation. Each stone is rounded, so the surface is easy on knees and paws, and water drops straight through it instead of sitting on top.</p>
        <p class="pull-quote">Flat ground, solid edging and the right depth. Get those three right and pea gravel stays where you spread it.</p>
      </div>
      <ul class="sp-signs">
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('footprints', 22); ?><b>Garden walkways</b><span>Two to three inches over packed soil gives a path that crunches underfoot and rakes smooth again after a spring downpour.</span></li>
        <li class="sp-sign reveal-up reveal-delay-2"><?php echo icon('users', 22); ?><b>Backyard play areas</b><span>Under swings and climbers, loose pea gravel cushions a fall when it is laid deep enough. The depth figures are further down this page.</span></li>
        <li class="sp-sign reveal-up reveal-delay-3"><?php echo icon('fence', 22); ?><b>Dog runs</b><span>Rain and urine drain through instead of pooling on the surface, the stone hoses clean, and there are no sharp edges for paws.</span></li>
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('droplets', 22); ?><b>Downspouts and drip lines</b><span>A band of pea gravel where roof water lands stops the splash from cutting a trench in bare clay right beside the slab.</span></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ COMPARISON ============ -->
<section class="section sp-compare pg-compare edge-curve-top" aria-labelledby="pg-compare-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Compare the surface</span>
      <h2 id="pg-compare-title">Pea gravel, decomposed granite or river rock: which surface suits your yard?</h2>
      <p class="answer-block">Pea gravel suits a loose surface that drains instantly and stays soft to walk and play on. Decomposed granite packs into a firmer floor that a wheelbarrow or stroller rolls across without sinking. River rock is bigger and heavier, so it covers beds and storm channels far better than it serves as somewhere to walk.</p>
    </div>
    <div class="sp-table-wrap reveal-up">
      <table class="sp-table">
        <caption>Every material in this table is on HARDROCK's list. Ask by phone what is available for your order.</caption>
        <thead>
          <tr><th scope="col">Material</th><th scope="col">Stone shape and size</th><th scope="col">Underfoot</th><th scope="col">Drainage</th><th scope="col">Typical project</th></tr>
        </thead>
        <tbody>
          <tr class="is-this"><th scope="row">Pea gravel</th><td>Rounded, about 3/8 inch</td><td>Loose; shifts and crunches</td><td>Fast: water runs straight through</td><td>Walkways, play areas, dog runs</td></tr>
          <tr><th scope="row">Decomposed granite</th><td>Granite chips mixed with fine grit</td><td>Firm once dampened and rolled</td><td>Slower: sheds much of the surface water</td><td>Patios, firm garden paths, xeriscape</td></tr>
          <tr><th scope="row">River rock</th><td>Smooth, rounded, larger size ranges</td><td>Uneven to walk across</td><td>Fast</td><td>Beds, dry creek beds, splash areas</td></tr>
          <tr><th scope="row">57 rock</th><td>Crushed and angular, about 1 inch down</td><td>Locks tighter than round stone</td><td>Fast</td><td>French drains, driveway top course</td></tr>
        </tbody>
      </table>
    </div>
    <p class="reveal-up">If a path has to carry a wheelbarrow every week, look at <a href="/services/decomposed-granite/">decomposed granite for firm paths and patios</a>. For a channel that carries roof runoff across the yard, <a href="/services/river-rock/">larger river rock for beds and dry creeks</a> holds its place better than pea gravel.</p>
  </div>
</section>

<!-- ============ SIGNATURE: UNDERFOOT ============ -->
<section class="section pg-underfoot edge-torn-top" aria-labelledby="pg-underfoot-title">
  <div class="container">
    <div class="pg-underfoot__grid">
      <div class="pg-underfoot__copy reveal-left">
        <span class="eyebrow">Keep it in place</span>
        <h2 id="pg-underfoot-title">Why does pea gravel shift underfoot, and how do you keep it in place?</h2>
        <p class="answer-block">Pea gravel shifts because round stones have no flat faces to lock against each other, so every step rolls them a little. Edging, a firm bed and a sensible depth keep it in place. Past about 3 inches on a walkway, each step sinks in and the path starts to feel like loose sand.</p>
        <p>Grayson County's heavy clay adds a local twist. It swells when it is wet and shrinks and cracks as it dries through a hot North Texas summer, so gravel laid straight onto soft clay slowly presses down into it. A packed, even bed underneath keeps the stone on top.</p>
        <ul class="pg-gauge" aria-label="Typical pea gravel depth by use">
          <li><b>Light path</b><i class="pg-d2"></i></li>
          <li><b>Busy walkway</b><i class="pg-d3"></i></li>
          <li><b>Play area (CPSC)</b><i class="pg-d9"></i></li>
        </ul>
        <p class="pg-gauge-note">Bars run from 2 inches for a light path to 3 inches for a busy walkway and 9 inches under play equipment.</p>
      </div>
      <ol class="pg-keys reveal-right">
        <li class="pg-key"><span><b>Edge it on every side</b>Steel, stone or timber edging set slightly above the gravel line stops stones drifting into the lawn, where the mower throws them.</span></li>
        <li class="pg-key"><span><b>Start on packed ground</b>Strip the grass and tamp the soil; landscape fabric on top slows weeds. Under a busy path, a thin layer of crushed base keeps the stone up when the clay goes soft after rain.</span></li>
        <li class="pg-key"><span><b>Keep it level</b>On anything more than a gentle grade, pea gravel walks downhill over a season. Steps, terraces or a material that packs suit a sloped path better.</span></li>
      </ol>
    </div>
  </div>
</section>

<!-- ============ ORDERING ============ -->
<section class="section on-dark texture-grain slant-top sp-breakdown" aria-labelledby="pg-order-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="sp-breakdown__grid">
      <div class="reveal-left">
        <span class="eyebrow">Ordering</span>
        <h2 id="pg-order-title">How does ordering pea gravel from HARDROCK work?</h2>
        <p class="answer-block">Ordering pea gravel from Hardrock Sand And Gravel takes one phone call or the form on this page. HARDROCK checks the quantity with you, gives the price and a delivery day over the phone, then drops the load where you point. Lines open at 6 AM Monday through Thursday.</p>
        <ul class="sp-included">
          <li><?php echo icon('map-pin', 18); ?><span>The delivery address in Sherman, Denison or elsewhere in Grayson County</span></li>
          <li><?php echo icon('ruler', 18); ?><span>Length and width of each area, in feet</span></li>
          <li><?php echo icon('layers', 18); ?><span>The depth you want, in inches</span></li>
          <li><?php echo icon('truck', 18); ?><span>The spot on the property where the pile should land</span></li>
          <li><?php echo icon('info', 18); ?><span>Anything to keep the truck off, such as a septic field or soft lawn</span></li>
        </ul>
        <p>Pea gravel is one of eight bulk materials on <a href="/services/delivery/">HARDROCK's delivery list for Sherman and Grayson County</a>, so sand or base for the same project can be priced on the same call.</p>
      </div>
      <ol class="sp-steps reveal-right">
        <li><b>Call or send the form</b><span>Phone <?php echo esc($spCall); ?> or use the form with the address and what the pea gravel is for.</span></li>
        <li><b>Check the amount</b><span>HARDROCK runs length × width × depth ÷ 27 with you so the order is not short.</span></li>
        <li><b>Price and a day</b><span>The price and the delivery day are given by phone.</span></li>
        <li><b>Load dropped</b><span>The pea gravel is dumped at the spot you picked, ready to spread.</span></li>
      </ol>
    </div>
  </div>
</section>

<!-- ============ QUANTITY ============ -->
<section class="section sp-math edge-wave-top" aria-labelledby="pg-math-title">
  <div class="container">
    <div class="sp-math__grid">
      <div class="reveal-left">
        <span class="eyebrow">Order the right amount</span>
        <h2 id="pg-math-title">How much pea gravel does a backyard play area need?</h2>
        <p class="answer-block">A backyard play area needs far more pea gravel than a path, because fall protection comes from depth. The U.S. Consumer Product Safety Commission's Public Playground Safety Handbook lists 9 inches of pea gravel for falls up to 5 feet, so a 20 by 20 foot play zone takes about 11 cubic yards.</p>
        <p>The handbook also notes that loose fill packs down with use and weather, so start a little deeper than the target and top it up as it settles. Walkways need much less: one cubic yard of pea gravel covers roughly 108 square feet at 3 inches deep, or about 162 square feet at 2 inches.</p>
      </div>
      <div class="sp-math__card reveal-right">
        <p class="sp-math__formula">Length × Width × Depth <em>÷ 27</em></p>
        <dl class="sp-math__rows">
          <div><dt>Play zone length</dt><dd>20 ft</dd></div>
          <div><dt>Play zone width</dt><dd>20 ft</dd></div>
          <div><dt>Pea gravel depth</dt><dd>0.75 ft (9 in)</dd></div>
          <div><dt>Pea gravel needed</dt><dd>≈ 11.1 yd³</dd></div>
        </dl>
        <p>20 × 20 × 0.75 = 300 cubic feet. 300 ÷ 27 = 11.1 cubic yards. A 4 × 30 foot walkway at 3 inches is 30 cubic feet, about 1.1 yards.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ PROOF ============ -->
<section class="section sp-proof" aria-labelledby="pg-proof-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Recent work</span>
      <h2 id="pg-proof-title">What do customers say after a HARDROCK gravel delivery?</h2>
      <p class="answer-block">Customers who order gravel from Hardrock Sand And Gravel post their reviews on Google, and the newest ones appear below. HARDROCK has hauled sand, gravel and rock around Sherman and Denison since 2016 under owner Dean Jones, for homes, farms and job sites.</p>
    </div>
    <div class="sp-proof__single">
      <figure class="reveal-left">
        <?php echo pictureTag('gravel-stockpiles-job-site', 'Rows of dumped gravel loads across a staked job site at sundown', '(max-width: 900px) 100vw, 640px'); ?>
        <figcaption>Gravel loads dumped in rows across a staked site, from HARDROCK's job photos.</figcaption>
      </figure>
      <div class="reveal-right">
        <p>A backyard pea gravel order starts the same way as a job like this one: a measured area, a phone call and a load dropped where the work happens. All eight materials and HARDROCK's site work are on <a href="/services/">the full HARDROCK services page</a>.</p>
      </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
    echo p1_google_reviews($slug, ['heading' => 'Google reviews from Sherman and Denison customers', 'heading_tag' => 'h3', 'limit' => 6]); ?>
    <div class="sp-proof__foot">
      <a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain slant-top sp-faq" id="faq" aria-labelledby="pg-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="pg-faq-title">What do people ask before ordering pea gravel?</h2>
      <p>Before a pea gravel order, Hardrock Sand And Gravel customers mostly want three answers: whether the load can reach their address, how many cubic yards a walkway or play area takes, and how the price is worked out.</p>
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
<?php echo sp_related_section(['river-rock', 'decomposed-granite', 'delivery'],
    'What else pairs with <span class="text-accent">pea gravel</span> in a backyard project?',
    'Pea gravel is often one of several materials in a yard project. Hardrock Sand And Gravel also supplies river rock for planting beds and dry creek channels, decomposed granite for firm paths that carry a wheelbarrow, and bulk delivery of sand, gravel, rock and dirt anywhere in Sherman and Grayson County.'); ?>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Need pea gravel for a path or play area?',
    'Call Hardrock Sand And Gravel with the area size and the address, or send the form. Saturday hours run 9 AM to 2 PM when a weekday call is hard to fit in.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
