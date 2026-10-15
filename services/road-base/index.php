<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$svc             = sp_service('road-base');
$pageTitle       = 'Road Base in Sherman, TX | HARDROCK Sand and Gravel';
$pageDescription = 'Road base delivered to Sherman, Denison and Grayson County for gravel drives, house pads and parking areas on clay ground. Call HARDROCK at ' . formatPhone($phone) . '.';
$canonicalUrl    = $siteUrl . '/services/road-base/';
$ogImage         = '/assets/images/gravel-driveway-rural.jpg';
$currentPage     = 'services';
$pageType        = 'service';
$serviceSlug     = 'road-base';
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = 'gravel-driveway-rural';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* FAQ: research-brief questions this page can answer truthfully (delivery area, quantity, how it is quoted) */
$faqs = [
    ['q' => 'Can HARDROCK deliver road base to my property near Sherman?',
     'a' => 'HARDROCK Sand and Gravel hauls road base to addresses in Sherman, Denison and across Grayson County. Give the address and where on the lot the load should be dumped when you call ' . $spCall . ', and the delivery day is set on the same call.'],
    ['q' => 'How many cubic yards of road base does a driveway take?',
     'a' => 'Multiply the drive length by its width by the finished base depth, all in feet, then divide by 27. A 150-foot drive that is 12 feet wide with 6 inches of base works out to about 33 cubic yards before any allowance for compaction, which HARDROCK can help you add.'],
    ['q' => 'How is a road base order priced?',
     'a' => 'Every road base order from HARDROCK Sand and Gravel is priced on a phone call, since the total turns on the amount and the haul to your address. Have your measurements ready and call ' . $spCall . ' to get the current figure and how the load is measured.'],
];

$pageSchemas = [
    ['@context' => 'https://schema.org', '@graph' => [
        array_diff_key(generateServiceSchema($svc), ['@context' => 1]) + ['image' => $siteUrl . '/assets/images/gravel-driveway-rural.jpg'],
        array_diff_key(sp_breadcrumb_schema($svc['name'], 'road-base'), ['@context' => 1]),
        array_diff_key(generateFAQSchema($faqs), ['@context' => 1]),
    ]],
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style>
/* ==========================================================================
   /services/road-base/ — page-specific composition
   Signature: the compaction-lift cross-section of a gravel drive on clay, built in CSS.
   ========================================================================== */
.rb-hero .hero-bg img { object-position: 50% 62%; }
.rb-problem .sp-sign:last-child { grid-column: 1 / -1; background: linear-gradient(120deg, var(--color-card-tint-2) 0%, color-mix(in srgb, var(--color-accent) 10%, var(--color-surface)) 100%); }
.rb-lifts__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.15fr); gap: var(--space-3xl); align-items: center; }
.rb-lifts__copy { display: grid; gap: var(--space-md); }
.rb-lifts__copy > p { margin: 0; max-width: var(--measure); }
.rb-section { position: relative; display: grid; margin: 0; padding: 0; list-style: none; border-radius: var(--radius-sm); overflow: hidden; box-shadow: var(--shadow-lg); border: 2px solid color-mix(in srgb, var(--color-white) 16%, transparent); }
.rb-section li { position: relative; display: flex; align-items: center; justify-content: space-between; gap: var(--space-md); padding: var(--space-md) var(--space-lg); color: var(--color-white); }
.rb-section li b { font-family: var(--font-heading); text-transform: uppercase; letter-spacing: .03em; font-size: 1.05rem; }
.rb-section li span { font-family: var(--font-accent); text-transform: uppercase; letter-spacing: .1em; font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 78%, transparent); text-align: right; }
.rb-layer--top { min-height: 3.5rem; background:
  radial-gradient(circle at 30% 40%, color-mix(in srgb, var(--color-white) 30%, transparent) 0 18%, transparent 20%) 0 0 / var(--space-lg) var(--space-lg),
  color-mix(in srgb, var(--color-secondary) 70%, var(--color-dark)); }
.rb-layer--base { min-height: 5rem; background:
  radial-gradient(circle, color-mix(in srgb, var(--color-white) 22%, transparent) 0 12%, transparent 14%) 0 0 / var(--space-sm) var(--space-sm),
  color-mix(in srgb, var(--color-accent) 34%, var(--color-dark-alt)); }
.rb-layer--base + .rb-layer--base { border-top: 2px dashed color-mix(in srgb, var(--color-white) 35%, transparent); }
.rb-layer--clay { min-height: 6rem; background:
  repeating-linear-gradient(-12deg, color-mix(in srgb, var(--color-dark) 40%, transparent) 0 2px, transparent 2px var(--space-md)),
  color-mix(in srgb, var(--color-accent-dark) 55%, var(--color-dark)); }
.rb-layer--clay::after { content: ""; position: absolute; inset: var(--space-sm) auto var(--space-sm) 40%; width: 2px; background: color-mix(in srgb, var(--color-dark) 70%, transparent); transform: skewX(-14deg); box-shadow: calc(var(--space-2xl) * 2) var(--space-xs) 0 color-mix(in srgb, var(--color-dark) 60%, transparent); }
.rb-section__note { margin: var(--space-sm) 0 0; font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 70%, transparent); }
html.js-anim .rb-lifts__diagram:not(.in) .rb-section li { transform: translateY(calc(-1 * var(--space-md))); opacity: 0; }
.rb-section li { transition: transform .5s var(--ease), opacity .5s var(--ease); }
.rb-section li:nth-child(2) { transition-delay: .12s; } .rb-section li:nth-child(3) { transition-delay: .24s; } .rb-section li:nth-child(4) { transition-delay: .36s; }
.rb-compare .sp-table td:nth-child(3) { font-weight: 600; }
.rb-proof .sp-proof__single figure picture { display: block; aspect-ratio: 4 / 4.6; overflow: hidden; }
.rb-proof .sp-proof__single figure img { width: 100%; height: 100%; object-fit: cover; object-position: 50% 55%; }
.rb-proof__copy { display: grid; gap: var(--space-md); }
.rb-proof__copy p { margin: 0; color: var(--color-ink-2); }
@media (max-width: 900px) { .rb-lifts__grid { grid-template-columns: 1fr; gap: var(--space-2xl); } }
@media (max-width: 560px) { .rb-section li { flex-direction: column; align-items: flex-start; } .rb-section li span { text-align: left; } }
@media (prefers-reduced-motion: reduce) { .rb-section li { transition: none; } html.js-anim .rb-lifts__diagram:not(.in) .rb-section li { transform: none; opacity: 1; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero rb-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Long tan gravel drive running across open pasture beside a green tractor', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo sp_breadcrumb($svc['name']); ?>
    <div class="hero-grid hero-grid--form">
      <div class="hero-text hero-copy">
        <span class="eyebrow">Road base · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
        <h1 class="hero-title" id="sp-hero-title"><span class="text-accent">Road Base</span> for Drives and Pads in Sherman, TX</h1>
        <p class="hero-answer">HARDROCK Sand and Gravel delivers road base to Sherman, Denison and the rest of Grayson County for homeowners, farms and builders who need a firm layer under a gravel drive, a house pad or a parking area. Compacted road base carries the weight, so the surface above it stops rutting when the clay gets wet.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('milestone', 16); ?>Drives, pads, parking</li>
          <li><?php echo icon('house', 16); ?>Driveways and pads built too</li>
          <li><?php echo icon('clock', 16); ?>Open 6 AM Mon–Thu</li>
        </ul>
      </div>

      <aside class="hero-form-card" id="estimate-form">
        <h2>Want a price on road base?</h2>
        <p class="hero-form-tagline">Send the address and the size of the area. HARDROCK calls with a number.</p>
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
<section class="section sp-problem rb-problem" aria-labelledby="rb-problem-title">
  <div class="container">
    <div class="sp-problem__grid">
      <div class="sp-problem__lead reveal-left">
        <span class="eyebrow">Clay country</span>
        <h2 id="rb-problem-title">Why does a gravel drive without <span class="text-accent">road base</span> turn to mud in Grayson County?</h2>
        <p class="answer-block">A gravel drive without road base turns to mud because loose rock sits straight on Grayson County clay, and that clay goes soft when it soaks up water. Every wet spring the tires push the stone down into the mud, and by summer the same ground has shrunk and cracked.</p>
        <p class="pull-quote">Rock dumped on bare clay does not stay on top of the clay for long.</p>
      </div>
      <ul class="sp-signs">
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('route', 22); ?><b>Ruts in the tire tracks</b><span>Two deep grooves form where the truck always drives, with a ridge of loose stone left between them.</span></li>
        <li class="sp-sign reveal-up reveal-delay-2"><?php echo icon('droplets', 22); ?><b>Puddles that never drain</b><span>Low spots hold rainwater for days. Each pass with a vehicle makes the hole wider and softer.</span></li>
        <li class="sp-sign reveal-up reveal-delay-3"><?php echo icon('layers', 22); ?><b>Rock vanishing into the clay</b><span>A load spread two summers ago is hard to find now. It sank into the subgrade instead of staying on it.</span></li>
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('sun', 22); ?><b>Cracks after a dry August</b><span>Heavy clay shrinks as it dries out and swells again with the fall rains. A thin gravel cover moves right along with it, opening cracks and humps across the drive.</span></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ SIGNATURE: COMPACTION LIFTS ============ -->
<section class="section on-dark texture-grain slant-top rb-lifts" aria-labelledby="rb-lifts-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="rb-lifts__grid">
      <div class="rb-lifts__copy reveal-left">
        <span class="eyebrow">Built in layers</span>
        <h2 id="rb-lifts-title">How is <span class="text-accent">road base</span> built up so it holds weight?</h2>
        <p class="answer-block">Road base holds weight when it goes down in thin lifts, each one wetted and compacted before the next is spread. In Texas the same material is often called flex base: crushed stone mixed with fine particles that lock together under a roller or plate compactor into one dense layer.</p>
        <p>Lifts of roughly 4 to 6 inches are common, because a single thick dump only gets packed at the surface and stays loose underneath. Moisture matters too. Base that is bone dry will not bind, and base that is soaked turns to paste. Many residential drives on clay end up with 6 inches or more of compacted base, and heavy trucks or equipment call for more.</p>
      </div>
      <div class="rb-lifts__diagram reveal-up">
        <ol class="rb-section" aria-label="Cross-section of a gravel drive, top to bottom">
          <li class="rb-layer--top"><b>Top course</b><span>Optional crushed rock finish</span></li>
          <li class="rb-layer--base"><b>Road base, lift 2</b><span>Wetted and compacted</span></li>
          <li class="rb-layer--base"><b>Road base, lift 1</b><span>Wetted and compacted</span></li>
          <li class="rb-layer--clay"><b>Native clay</b><span>Topsoil and roots stripped</span></li>
        </ol>
        <p class="rb-section__note">Cross-section, not to scale. Topsoil and roots come off first so the base sits on firm clay.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ EXPERT POSITIONING ============ -->
<section class="section sp-expert rb-expert" aria-labelledby="rb-expert-title">
  <div class="container-wide">
    <div class="sp-expert__grid">
      <div class="sp-expert__copy reveal-left">
        <span class="eyebrow">Material or the whole job</span>
        <h2 id="rb-expert-title">Should you order <span class="text-accent">road base</span> or have HARDROCK build the drive?</h2>
        <p class="answer-block">HARDROCK Sand and Gravel handles road base either way: as a delivered load for your own crew, or as part of a gravel driveway or house pad HARDROCK builds. Owners with a tractor and a compactor often take the load. Everyone else usually hands HARDROCK the job.</p>
        <div class="sp-figure"><b>2019</b><span>the year HARDROCK opened for business in Grayson County</span></div>
        <ul class="sp-points">
          <li><?php echo icon('tractor', 20); ?><span><b>Doing it yourself.</b> Have the area cleared and roughly graded before the truck comes, and keep the dump spot close to where the base will be spread.</span></li>
          <li><?php echo icon('route', 20); ?><span><b>A new or rebuilt drive.</b> HARDROCK builds <a href="/services/driveways/">gravel driveways for homes and rural lots</a>, with the base and the surface rock handled together.</span></li>
          <li><?php echo icon('house', 20); ?><span><b>A pad for a slab.</b> A building site needs a flat, firm platform before forms go up. See how HARDROCK prepares <a href="/services/house-pads/">house pads for new slabs</a>.</span></li>
        </ul>
      </div>
      <figure class="sp-photo reveal-right">
        <?php echo pictureTag('excavator-crushed-rock-pad', 'Yellow excavator beside a long pile of light grey crushed rock on a graded pad under power lines', '(max-width: 900px) 100vw, 520px'); ?>
        <figcaption>Crushed rock spread on a graded pad, with the excavator still on site.</figcaption>
      </figure>
    </div>
  </div>
</section>

<!-- ============ QUANTITY ============ -->
<section class="section sp-math edge-wave-top" aria-labelledby="rb-math-title">
  <div class="container">
    <div class="sp-math__grid">
      <div class="reveal-left">
        <span class="eyebrow">Size the order</span>
        <h2 id="rb-math-title">How much <span class="text-accent">road base</span> does a 150-foot driveway need?</h2>
        <p class="answer-block">A 150-foot driveway 12 feet wide needs about 33 cubic yards of road base for a finished depth of 6 inches. The formula is length times width times depth in feet, divided by 27, and it works the same for a pad, a turnaround or a parking area.</p>
        <p>That figure is the finished, compacted volume. Road base shrinks as it is packed, so the loose amount delivered has to be larger than the number on paper. Give HARDROCK your measurements before ordering and the compaction allowance can be added on the same call, which saves a second trip for a short load.</p>
      </div>
      <div class="sp-math__card reveal-right">
        <p class="sp-math__formula">Length × Width × Depth <em>÷ 27</em></p>
        <dl class="sp-math__rows">
          <div><dt>Drive length</dt><dd>150 ft</dd></div>
          <div><dt>Drive width</dt><dd>12 ft</dd></div>
          <div><dt>Compacted depth</dt><dd>0.5 ft (6 in)</dd></div>
          <div><dt>Road base, compacted</dt><dd>≈ 33.3 yd³</dd></div>
        </dl>
        <p>150 × 12 × 0.5 = 900 cubic feet. 900 ÷ 27 = 33.3 cubic yards, before the compaction allowance.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ COMPARISON ============ -->
<section class="section sp-compare rb-compare" aria-labelledby="rb-compare-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Know the layers</span>
      <h2 id="rb-compare-title">Road base, 57 rock, pea gravel or fill dirt: which one goes under a drive?</h2>
      <p class="answer-block">Road base is the one that goes under a drive, because its fines pack into a hard, tight layer. 57 rock drains and makes a good top course, but it stays loose on its own. Pea gravel rolls under tires, and fill dirt raises low ground but softens when wet.</p>
    </div>
    <div class="sp-table-wrap reveal-up">
      <table class="sp-table">
        <caption>HARDROCK sells all four. Call to talk through which layer your job needs.</caption>
        <thead>
          <tr><th scope="col">Material</th><th scope="col">What it is</th><th scope="col">Packs hard?</th><th scope="col">Water</th><th scope="col">Where it belongs</th></tr>
        </thead>
        <tbody>
          <tr class="is-this"><th scope="row">Road base</th><td>Crushed stone with fines</td><td>Yes, when compacted in lifts</td><td>Sheds most of it</td><td>Base course under drives, pads and parking</td></tr>
          <tr><th scope="row">57 rock</th><td>Crushed stone, about 1 in. down, few fines</td><td>Interlocks, stays loose</td><td>Drains through freely</td><td>Top course on a drive, French drains</td></tr>
          <tr><th scope="row">Pea gravel</th><td>Small, rounded stone</td><td>No, rolls underfoot</td><td>Drains through</td><td>Walkways, beds, play areas</td></tr>
          <tr><th scope="row">Fill dirt</th><td>Soil for raising grade</td><td>Firm when dry</td><td>Softens when wet</td><td>Filling low ground below the base</td></tr>
        </tbody>
      </table>
    </div>
    <p class="reveal-up">A common pairing is road base underneath with a thin finish of <a href="/services/57-67-rock/">57 or 67 crushed rock</a> on top, which gives a cleaner surface that drains. If the lot sits low, <a href="/services/fill-dirt/">fill dirt to raise the grade</a> goes in first.</p>
  </div>
</section>

<!-- ============ PROOF ============ -->
<section class="section sp-proof rb-proof edge-curve-top" aria-labelledby="rb-proof-title">
  <div class="container">
    <div class="sp-proof__single">
      <figure class="reveal-left">
        <?php echo pictureTag('gravel-driveway-rural', 'Freshly spread tan gravel drive running straight across green pasture, with a tractor and fence posts beside it', '(max-width: 900px) 100vw, 640px'); ?>
        <figcaption>A long gravel drive across open pasture, freshly spread.</figcaption>
      </figure>
      <div class="rb-proof__copy reveal-right">
        <span class="eyebrow">Recent work</span>
        <h2 id="rb-proof-title">What does a finished HARDROCK gravel drive look like?</h2>
        <p class="answer-block">A finished HARDROCK gravel drive is a straight, even run of fresh crushed gravel from the road to where it is needed. The drive in this photo crosses open pasture, the kind of long rural approach around Sherman that carries a tractor as often as a car.</p>
        <p>Long country drives off the farm roads around Howe, Tom Bean and Bells take a beating from trucks and trailers, which is why the layer under the surface matters as much as the rock on top. Every material and job HARDROCK handles is listed on <a href="/services/">the full HARDROCK services page</a>.</p>
      </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
    echo p1_google_reviews($slug, ['heading' => 'What customers around Sherman say on Google', 'heading_tag' => 'h3', 'limit' => 6]); ?>
    <div class="sp-proof__foot">
      <a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain edge-torn-top sp-faq" id="faq" aria-labelledby="rb-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="rb-faq-title">What do people ask HARDROCK before ordering road base?</h2>
      <p>Before a road base load is scheduled, HARDROCK Sand and Gravel usually hears three questions: whether the truck can reach the property, how many cubic yards the drive or pad will take, and how the order is priced.</p>
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
<?php echo sp_related_section(['driveways', 'house-pads', '57-67-rock'],
    'What gets built on top of <span class="text-accent">road base</span>?',
    'Road base is the bottom half of most jobs, so it pairs with the work that sits on it. HARDROCK Sand and Gravel builds gravel driveways and house pads around Sherman and also hauls 57 and 67 crushed rock for the finish layer, so the base, the top and the labor can come from one call.'); ?>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Need road base down before the spring rains?',
    'Call HARDROCK Sand and Gravel with the address and the length and width of the drive or pad, or send the form. The number and a delivery day come back on the same phone call.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
