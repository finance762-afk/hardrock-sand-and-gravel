<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$svc             = sp_service('river-rock');
$pageTitle       = 'River Rock in Sherman, TX | HARDROCK Sand and Gravel';
$pageDescription = 'River rock for landscape beds, dry creek beds and downspout splash areas, delivered across Sherman, Denison and Grayson County. Call HARDROCK at ' . formatPhone($phone) . '.';
$canonicalUrl    = $siteUrl . '/services/river-rock/';
$ogImage         = '/assets/images/pea-gravel-closeup.jpg';
$currentPage     = 'services';
$pageType        = 'service';
$serviceSlug     = 'river-rock';
$headerDark      = true;
$bodyClass       = 'sp-page';

/* No river rock photo on file yet: the hero borrows the rounded-stone close-up and the alt describes only what it shows. */
$heroImage   = 'pea-gravel-closeup';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* FAQ: research-brief questions this page can answer truthfully (which material/size, delivery area, pricing unit) */
$faqs = [
    ['q' => 'Which size of river rock should I order?',
     'a' => 'For bed cover and narrow channels, smaller river rock under about 1½ inches looks neat and fills the gaps. For downspout pads and the floor of a dry creek bed, 1 to 3 inch stone is the usual pick, with bigger cobble along the edges. Tell HARDROCK the job when you call and ask which sizes are available.'],
    ['q' => 'Does HARDROCK bring river rock to Denison and other Grayson County towns?',
     'a' => 'HARDROCK Sand and Gravel delivers river rock in Sherman, Denison and the rest of Grayson County. Ring ' . $spCall . ' with the address and the rough size of the bed or creek, and HARDROCK confirms what it will cost and which day the rock arrives.'],
    ['q' => 'How does HARDROCK price river rock?',
     'a' => 'River rock prices from HARDROCK Sand and Gravel are given by phone, since the stone size, the amount and the address all move the total. Bring the cubic-yard estimate from the dry creek example on this page to the call, and ask whether the quote is by the ton or the yard.'],
];

$pageSchemas = [
    ['@context' => 'https://schema.org', '@graph' => [
        array_diff_key(generateServiceSchema($svc), ['@context' => 1]) + ['image' => $siteUrl . '/assets/images/pea-gravel-closeup.jpg'],
        array_diff_key(sp_breadcrumb_schema($svc['name'], 'river-rock'), ['@context' => 1]),
        array_diff_key(generateFAQSchema($faqs), ['@context' => 1]),
    ]],
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style>
/* ==========================================================================
   /services/river-rock/ — page-specific composition
   Signature: the size guide on a dark band with a meandering dry-creek stripe (two offset radial-gradient
   arcs, no SVG) and stone swatches that grow with each size range.
   ========================================================================== */
.rv-hero .hero-bg img { object-position: 50% 45%; }

.rv-sizes .section-title { max-width: 64ch; }
.rv-sizes .answer-block { background: color-mix(in srgb, var(--color-white) 7%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.rv-creek { position: relative; height: 3rem; margin: var(--space-xl) 0 var(--space-lg); pointer-events: none;
  background:
    radial-gradient(circle 1.5rem at 1.5rem 100%, transparent calc(1.5rem - 4px), color-mix(in srgb, var(--color-accent-bright) 75%, transparent) calc(1.5rem - 4px) 1.5rem, transparent 1.5rem) 0 0 / 6rem 1.5rem repeat-x,
    radial-gradient(circle 1.5rem at 4.5rem 0, transparent calc(1.5rem - 4px), color-mix(in srgb, var(--color-accent-bright) 75%, transparent) calc(1.5rem - 4px) 1.5rem, transparent 1.5rem) 0 1.5rem / 6rem 1.5rem repeat-x; }
.rv-creek::after { content: ""; position: absolute; inset: 35% 0; opacity: .45;
  background: radial-gradient(circle, color-mix(in srgb, var(--color-white) 60%, transparent) 0 22%, transparent 26%) 0 50% / var(--space-lg) var(--space-md) repeat-x; }
.rv-size-list { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: var(--space-md); margin: 0; padding: 0; list-style: none; }
.rv-size { position: relative; display: grid; gap: var(--space-xs); align-content: start; padding: var(--space-lg); border-radius: var(--radius-sm);
  background: color-mix(in srgb, var(--color-white) 6%, transparent); border: 1px solid color-mix(in srgb, var(--color-white) 12%, transparent);
  transition: transform var(--transition), border-color var(--transition); }
.rv-size:hover { transform: translateY(calc(-1 * var(--space-1))); border-color: color-mix(in srgb, var(--color-accent-bright) 60%, transparent); }
.rv-size:nth-child(even) { margin-top: var(--space-xl); }
.rv-stone { display: block; height: auto; aspect-ratio: 5 / 4; border-radius: 52% 48% 46% 54% / 56% 50% 50% 44%; margin-bottom: var(--space-xs);
  background: radial-gradient(circle at 35% 30%, color-mix(in srgb, var(--color-white) 55%, var(--color-secondary)), color-mix(in srgb, var(--color-secondary) 60%, var(--color-dark))); box-shadow: var(--shadow); }
.rv-size:nth-child(1) .rv-stone { width: 1.25rem; } .rv-size:nth-child(2) .rv-stone { width: 2.25rem; }
.rv-size:nth-child(3) .rv-stone { width: 3.5rem; } .rv-size:nth-child(4) .rv-stone { width: 5rem; }
.rv-size b { font-family: var(--font-accent); font-size: 1.35rem; text-transform: uppercase; letter-spacing: .04em; color: var(--color-white); }
.rv-size em { font-style: normal; font-family: var(--font-accent); text-transform: uppercase; letter-spacing: .12em; font-size: var(--fs-small); color: var(--color-accent-bright); }
.rv-size span { font-size: .95rem; color: color-mix(in srgb, var(--color-white) 78%, transparent); }
.rv-sizes__note { margin-top: var(--space-xl); max-width: 62ch; }
.rv-creekbed .sp-math__card { align-self: center; }
.rv-compare { background: var(--color-paper-2); }
@media (max-width: 900px) { .rv-size-list { grid-template-columns: repeat(2, minmax(0, 1fr)); } .rv-size:nth-child(even) { margin-top: 0; } }
@media (max-width: 480px) { .rv-size-list { grid-template-columns: 1fr; } }
@media (prefers-reduced-motion: reduce) { .rv-size { transition: none; } .rv-size:hover { transform: none; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero rv-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Close-up of small, smooth rounded stones', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo sp_breadcrumb($svc['name']); ?>
    <div class="hero-grid hero-grid--form">
      <div class="hero-text hero-copy">
        <span class="eyebrow">River rock · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
        <h1 class="hero-title" id="sp-hero-title"><span class="text-accent">River Rock</span> for Beds and Creeks in Sherman, TX</h1>
        <p class="hero-answer">HARDROCK Sand and Gravel delivers river rock to Sherman, Denison and the rest of Grayson County for landscape beds, dry creek beds and downspout splash areas. River rock is stone worn smooth by water and sold in size ranges, so the right pick depends on whether it will cover a bed or line a channel.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('sprout', 16); ?>Beds, creeks, splash areas</li>
          <li><?php echo icon('phone', 16); ?>Price and day by phone</li>
          <li><?php echo icon('map-pin', 16); ?>Sherman &amp; Denison</li>
        </ul>
      </div>

      <aside class="hero-form-card" id="estimate-form">
        <h2>Want a price on river rock?</h2>
        <p class="hero-form-tagline">Tell HARDROCK the bed size and the address for a call-back price.</p>
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

<!-- ============ AROUND THE HOUSE ============ -->
<section class="section sp-problem rv-uses" aria-labelledby="rv-uses-title">
  <div class="container">
    <div class="sp-problem__grid">
      <div class="sp-problem__lead reveal-left">
        <span class="eyebrow">Around the house</span>
        <h2 id="rv-uses-title">Where does <span class="text-accent">river rock</span> do the most good around a house?</h2>
        <p class="answer-block">River rock does the most good where water lands or runs: under downspouts, along gutterless rooflines, in storm swales and across planting beds. Its weight keeps it in place when rain hits, so the bare clay underneath stays put instead of splashing onto siding or washing out into the lawn.</p>
        <p class="pull-quote">Choose the stone size for the job first. The color is the easy part.</p>
      </div>
      <ul class="sp-signs">
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('droplets', 22); ?><b>Downspout splash pads</b><span>A shallow pad of 1 to 3 inch stone where a downspout empties spreads the flow out before it can dig a hole beside the slab.</span></li>
        <li class="sp-sign reveal-up reveal-delay-2"><?php echo icon('home', 22); ?><b>Gutterless drip lines</b><span>Where roof water sheets off the eave, a strip of river rock takes the hit and keeps mud off the brick and the windows.</span></li>
        <li class="sp-sign reveal-up reveal-delay-3"><?php echo icon('sprout', 22); ?><b>Planting beds</b><span>Among native and drought-tolerant plants, smaller river rock covers the soil for years and does not blow off in a North Texas wind the way light mulch can.</span></li>
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('waves', 22); ?><b>Dry creek beds</b><span>A rock-lined channel moves storm water across the yard and reads as a creek between rains. The build is laid out below.</span></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ SIGNATURE: SIZE GUIDE ============ -->
<section class="section on-dark texture-grain edge-wave-top rv-sizes" aria-labelledby="rv-sizes-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Stone sizes</span>
      <h2 id="rv-sizes-title">Which river rock size fits which job?</h2>
      <p class="answer-block">River rock size should match the job: small stone for bed cover, mid-size for channels and splash pads, and cobble for creek banks and edges. Suppliers sell river rock in size ranges rather than one exact size, so the ranges below are a guide to the conversation, not a stock list.</p>
    </div>
    <div class="rv-creek" aria-hidden="true"></div>
    <ul class="rv-size-list">
      <li class="rv-size reveal-up reveal-delay-1"><span class="rv-stone" aria-hidden="true"></span><em>Small</em><b>Under 1½ in.</b><span>Bed cover, the gaps between stepping stones and the floor of a narrow channel.</span></li>
      <li class="rv-size reveal-up reveal-delay-2"><span class="rv-stone" aria-hidden="true"></span><em>Medium</em><b>1 to 3 in.</b><span>Downspout pads, dry creek bed bottoms and drip-line strips along the house.</span></li>
      <li class="rv-size reveal-up reveal-delay-3"><span class="rv-stone" aria-hidden="true"></span><em>Large</em><b>3 to 5 in.</b><span>The sides of a creek bed, a border along a planting bed and wider splash areas.</span></li>
      <li class="rv-size reveal-up reveal-delay-4"><span class="rv-stone" aria-hidden="true"></span><em>Cobble</em><b>6 in. and up</b><span>Banks and bends of a dry creek, where they hold the smaller rock in the channel.</span></li>
    </ul>
    <p class="rv-sizes__note reveal-up">A good rule for any size: lay the stone at least as deep as the biggest pieces, so no fabric or soil shows through. Ask HARDROCK on the phone which ranges are on hand for your order.</p>
  </div>
</section>

<!-- ============ DRY CREEK BED ============ -->
<section class="section sp-expert rv-creekbed edge-curve-top" aria-labelledby="rv-creekbed-title">
  <div class="container-wide">
    <div class="sp-expert__grid">
      <div class="sp-expert__copy reveal-left">
        <span class="eyebrow">Dry creek beds</span>
        <h2 id="rv-creekbed-title">How do you build a dry creek bed with river rock on clay soil?</h2>
        <p class="answer-block">A dry creek bed is a shallow swale lined with fabric and river rock that carries storm runoff across a yard. Grayson County clay sheds heavy spring rain rather than soaking it up, so the channel should follow the natural low line and end where water can spread out, such as a ditch or a planted rain garden.</p>
        <div class="sp-figure"><b>1.5 yd³</b><span>of river rock lines a 30-foot creek bed 4 feet wide</span></div>
        <ul class="sp-points">
          <li><?php echo icon('route', 20); ?><span><b>Dig a shallow, curving channel.</b> Follow the path water already takes. A gentle wander looks more like a real creek than a straight ditch does.</span></li>
          <li><?php echo icon('layers', 20); ?><span><b>Line it with landscape fabric.</b> Fabric stops clay from working up between the stones and holds back weeds.</span></li>
          <li><?php echo icon('mountain', 20); ?><span><b>Big stone on the banks, smaller in the bed.</b> Cobble goes along the edges and at bends where water pushes hardest; 1 to 3 inch rock fills the bottom.</span></li>
          <li><?php echo icon('map-pin', 20); ?><span><b>Plan where it empties.</b> End the creek at a ditch, a culvert or a wide stone pad, never against a fence line or a neighbor's lot.</span></li>
        </ul>
        <p>Where a channel carries steady flow or cuts into a pond bank, river rock will roll; <a href="/services/rip-rap/">rip rap set over filter fabric</a> is the stronger choice for that stretch.</p>
      </div>
      <div class="sp-math__card reveal-right">
        <p class="sp-math__formula">Length × Width × Depth <em>÷ 27</em></p>
        <dl class="sp-math__rows">
          <div><dt>Creek length</dt><dd>30 ft</dd></div>
          <div><dt>Channel width</dt><dd>4 ft</dd></div>
          <div><dt>Rock depth</dt><dd>0.33 ft (4 in)</dd></div>
          <div><dt>River rock needed</dt><dd>≈ 1.5 yd³</dd></div>
        </dl>
        <p>30 × 4 × 0.33 = 40 cubic feet. 40 ÷ 27 = 1.48 cubic yards, plus the larger cobble for the banks, which is counted separately.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ COMPARISON ============ -->
<section class="section sp-compare rv-compare edge-torn-top" aria-labelledby="rv-compare-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Compare the stone</span>
      <h2 id="rv-compare-title">River rock or pea gravel: which handles beds and drainage better?</h2>
      <p class="answer-block">River rock handles beds, swales and splash areas better than pea gravel, because its larger, heavier stones resist being pushed by running water. Pea gravel is the better pick for a surface you walk on every day. Decomposed granite and rip rap sit at opposite ends: one packs into a path, the other armors banks.</p>
    </div>
    <div class="sp-table-wrap reveal-up">
      <table class="sp-table">
        <caption>HARDROCK delivers every material listed. Sizes vary, so ask when you call.</caption>
        <thead>
          <tr><th scope="col">Material</th><th scope="col">Stone size and shape</th><th scope="col">In storm runoff</th><th scope="col">Can you walk on it?</th><th scope="col">Typical spot</th></tr>
        </thead>
        <tbody>
          <tr class="is-this"><th scope="row">River rock</th><td>Smooth and rounded, from under an inch to cobble</td><td>Larger sizes stay put</td><td>Uneven; better to look at than to walk on</td><td>Beds, dry creeks, downspout pads</td></tr>
          <tr><th scope="row">Pea gravel</th><td>Rounded, about 3/8 inch</td><td>Small stones move in fast water</td><td>Yes, loose and comfortable</td><td>Walkways, play areas, dog runs</td></tr>
          <tr><th scope="row">Decomposed granite</th><td>Fine granite grit and chips</td><td>Fines wash where water crosses</td><td>Yes, packs firm</td><td>Paths, patios, xeriscape floors</td></tr>
          <tr><th scope="row">Rip rap</th><td>Large, angular rock</td><td>Holds against waves and channel flow</td><td>No</td><td>Pond banks, culverts, creek bends</td></tr>
        </tbody>
      </table>
    </div>
    <p class="reveal-up">For the path that crosses a river rock bed, <a href="/services/pea-gravel/">pea gravel for walkways and play areas</a> is the easier surface underfoot, and the two rounded stones sit well side by side.</p>
  </div>
</section>

<!-- ============ PROOF ============ -->
<section class="section sp-proof" aria-labelledby="rv-proof-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Recent work</span>
      <h2 id="rv-proof-title">What do customers say about ordering rock from HARDROCK?</h2>
      <p class="answer-block">Customers who order rock and gravel from HARDROCK Sand and Gravel leave their reviews on Google, and the latest are below. HARDROCK has served Sherman, Denison and Grayson County since 2019, with Dean Jones as owner. The photo beside the reviews shows rip rap from one of its jobs, for a sense of stone scale.</p>
    </div>
    <div class="sp-proof__single">
      <figure class="reveal-left">
        <?php echo pictureTag('rip-rap-stockpile-closeup', 'Pile of grey rip rap stones with a golf ball on top for scale', '(max-width: 900px) 100vw, 640px'); ?>
        <figcaption>Rip rap from a HARDROCK job, with a golf ball for scale. Creek-edge cobble is smaller and rounder than this.</figcaption>
      </figure>
      <div class="reveal-right">
        <p>River rock is one of eight bulk materials HARDROCK hauls, alongside site work such as ponds, driveways and land clearing. See <a href="/services/">every HARDROCK material and service</a> to plan the rest of the yard around the rock.</p>
      </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
    echo p1_google_reviews($slug, ['heading' => 'Recent Google reviews of HARDROCK', 'heading_tag' => 'h3', 'limit' => 6]); ?>
    <div class="sp-proof__foot">
      <a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain slant-top sp-faq" id="faq" aria-labelledby="rv-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="rv-faq-title">What do people ask before buying river rock?</h2>
      <p>River rock buyers who call HARDROCK Sand and Gravel usually start with the stone size, then ask whether the load reaches Denison or another Grayson County town, and finally how the river rock price is worked out.</p>
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
<?php echo sp_related_section(['pea-gravel', 'rip-rap', 'decomposed-granite'],
    'What pairs well with <span class="text-accent">river rock</span> in a landscape?',
    'River rock rarely works alone in a finished yard. HARDROCK Sand and Gravel also carries pea gravel for the walkway that crosses the bed, rip rap for any bank where water runs hard, and decomposed granite for a firm path or seating area beside the rock, all delivered around Sherman.'); ?>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Need river rock before the spring storms?',
    'Call HARDROCK Sand and Gravel or send the form with the address and the size of the bed or channel. HARDROCK takes calls until 5 PM on weekdays and until 2 PM on Saturdays.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
