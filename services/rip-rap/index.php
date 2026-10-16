<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$svc             = sp_service('rip-rap');
$pageTitle       = 'Rip Rap Delivery in Sherman, TX | Hardrock Sand And Gravel';
$pageDescription = 'Rip rap delivered and set over filter fabric on pond banks, creek slopes and culverts in Sherman, Denison and Grayson County. Call HARDROCK at ' . formatPhone($phone) . '.';
$canonicalUrl    = $siteUrl . '/services/rip-rap/';
$ogImage         = '/assets/images/rip-rap-crew-skid-steer.jpg';
$currentPage     = 'services';
$pageType        = 'service';
$serviceSlug     = 'rip-rap';
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = 'rip-rap-crew-skid-steer';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* FAQ: research-brief questions this page can answer truthfully (delivery area, pricing unit) */
$faqs = [
    ['q' => 'Do you deliver rip rap to Sherman and the surrounding area?',
     'a' => 'Yes. Hardrock Sand And Gravel delivers rip rap across Sherman, Denison and the rest of Grayson County. Call ' . $spCall . ' with the address and the length of bank you need to cover, and HARDROCK will confirm the delivery, the price and a day.'],
    ['q' => 'Do you sell rip rap by the ton or the cubic yard?',
     'a' => 'Hardrock Sand And Gravel quotes every rip rap order by phone, because the price depends on the rock size, the amount and how far the load travels. Work out the cubic yards with the bank math above, then call ' . $spCall . ' for the current price and how the load is measured.'],
];

$pageSchemas = [
    ['@context' => 'https://schema.org', '@graph' => [
        array_diff_key(generateServiceSchema($svc), ['@context' => 1]) + ['image' => $siteUrl . '/assets/images/rip-rap-crew-skid-steer.jpg'],
        array_diff_key(sp_breadcrumb_schema($svc['name'], 'rip-rap'), ['@context' => 1]),
        array_diff_key(generateFAQSchema($faqs), ['@context' => 1]),
    ]],
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style>
/* ==========================================================================
   /services/rip-rap/ — page-specific composition
   Signature: the waterline band on the problem section and the tall-first gallery.
   ========================================================================== */
.rr-hero .hero-bg img { object-position: 50% 40%; }
.rr-problem { background:
  linear-gradient(to bottom, var(--color-paper) 0 86%, color-mix(in srgb, var(--color-primary) 6%, var(--color-paper)) 86% 100%); }
.rr-problem::after { content: ""; position: absolute; inset: auto 0 14% 0; height: 2px; pointer-events: none;
  background: repeating-linear-gradient(90deg, color-mix(in srgb, var(--color-accent) 55%, transparent) 0 var(--space-lg), transparent var(--space-lg) var(--space-xl)); }
.rr-problem .sp-sign:first-child { grid-row: span 3; align-content: end; min-height: 16rem;
  background: linear-gradient(160deg, var(--color-card-tint-1) 0%, color-mix(in srgb, var(--color-accent) 12%, var(--color-surface)) 100%); }
.rr-expert .sp-photo picture { aspect-ratio: 4 / 3.6; }
.rr-proof .sp-gallery-grid { grid-template-columns: 1.5fr 1fr; }
.rr-proof .sp-gallery-item:first-child { box-shadow: var(--shadow-lg); outline: 2px solid var(--color-accent); outline-offset: var(--space-xs); }
@media (max-width: 560px) { .rr-problem .sp-sign:first-child { grid-row: auto; min-height: 0; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero rr-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Two workers hand-setting rip rap on black filter fabric while a skid steer carries in more rock', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo sp_breadcrumb($svc['name']); ?>
    <div class="hero-grid hero-grid--form">
      <div class="hero-text hero-copy">
        <span class="eyebrow">Rip rap · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
        <h1 class="hero-title" id="sp-hero-title"><span class="text-accent">Rip Rap</span> for Banks and Culverts in Sherman, TX</h1>
        <p class="hero-answer">Hardrock Sand And Gravel delivers rip rap to Sherman, Denison and the rest of Grayson County, and sets it on pond banks, creek slopes and culvert outlets. On HARDROCK's rip rap jobs, filter fabric goes down the bank first and the rock goes over it, so the clay underneath cannot wash out.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('waves', 16); ?>Banks, ponds, culverts</li>
          <li><?php echo icon('layers', 16); ?>Set over filter fabric</li>
          <li><?php echo icon('truck', 16); ?>Delivered or installed</li>
        </ul>
      </div>

      <aside class="hero-form-card" id="estimate-form">
        <h2>Want a price on rip rap?</h2>
        <p class="hero-form-tagline">Tell us the bank and the address. We call back with a price.</p>
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
<section class="section sp-problem rr-problem" aria-labelledby="rr-problem-title">
  <div class="container">
    <div class="sp-problem__grid">
      <div class="sp-problem__lead reveal-left">
        <span class="eyebrow">Erosion control</span>
        <h2 id="rr-problem-title">Where does <span class="text-accent">rip rap</span> stop erosion on Grayson County land?</h2>
        <p class="answer-block">Rip rap stops erosion wherever moving water meets bare soil: pond banks hit by waves, creek bends, culvert outlets and ditches. Grayson County's heavy clay holds a shape when it is dry, but it slumps and washes away once water works at it, so an unprotected bank loses a little more ground with every storm.</p>
        <p class="pull-quote">If fresh clay shows at the waterline after every rain, the bank is already moving.</p>
      </div>
      <ul class="sp-signs">
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('droplets', 22); ?><b>An undercut waterline</b><span>A lip of grass hangs over a bare notch at pond level. Waves cut the notch, the lip falls in, and the bank creeps back toward the yard.</span></li>
        <li class="sp-sign reveal-up reveal-delay-2"><?php echo icon('route', 22); ?><b>Scour at a culvert</b><span>A hole opens where a pipe under a drive or road empties out. Left alone, it works back under the pipe and the drive above it.</span></li>
        <li class="sp-sign reveal-up reveal-delay-3"><?php echo icon('waves', 22); ?><b>A slumping dam face</b><span>The water side of a pond dam takes the most wave action. Slumps and cracks there are worth armoring before they grow.</span></li>
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('wind', 22); ?><b>A creek bend cutting back</b><span>The outside of a bend carries the fastest water. Fence posts and trees along it start to lean as the bank goes.</span></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ EXPERT POSITIONING ============ -->
<section class="section sp-expert rr-expert" aria-labelledby="rr-expert-title">
  <div class="container-wide">
    <div class="sp-expert__grid">
      <div class="sp-expert__copy reveal-left">
        <span class="eyebrow">How it goes in</span>
        <h2 id="rr-expert-title">How does HARDROCK set <span class="text-accent">rip rap</span> so it stays put?</h2>
        <p class="answer-block">HARDROCK sets rip rap over filter fabric. The bank is cleared, fabric is rolled down the slope, then a skid steer feeds rock to the bank and workers hand-set the stones so they lock together. The fabric lets water drain out while holding the soil behind the rock in place.</p>
        <div class="sp-figure"><b>Fabric first</b><span>under the rock on every HARDROCK rip rap job pictured here</span></div>
        <ul class="sp-points">
          <li><?php echo icon('layers', 20); ?><span><b>Fabric under the rock.</b> Without it, waves pull fine clay out through the gaps between stones and the rock slowly sinks into the bank.</span></li>
          <li><?php echo icon('hard-hat', 20); ?><span><b>Hand-set, not just dumped.</b> Stones set by hand sit tight against each other, with fewer open pockets for water to work into.</span></li>
          <li><?php echo icon('truck', 20); ?><span><b>Rock and labor from one company.</b> The company hauling the rip rap is the one placing it, so nobody waits on a separate supplier.</span></li>
        </ul>
        <p>If the bank belongs to a new pond, the digging and the armor can happen as one job; see <a href="/services/ponds/">how HARDROCK digs and shapes ponds</a>.</p>
      </div>
      <figure class="sp-photo reveal-right">
        <?php echo pictureTag('rip-rap-stockpile-closeup', 'Grey rip rap stones with a golf ball resting on top for scale', '(max-width: 900px) 100vw, 520px'); ?>
        <figcaption>Rip rap up close. The golf ball shows the size of the stone.</figcaption>
      </figure>
    </div>
  </div>
</section>

<!-- ============ SERVICE BREAKDOWN ============ -->
<section class="section on-dark texture-grain slant-top sp-breakdown" aria-labelledby="rr-breakdown-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="sp-breakdown__grid">
      <div class="reveal-left">
        <span class="eyebrow">What's included</span>
        <h2 id="rr-breakdown-title">What does a rip rap job with HARDROCK include?</h2>
        <p class="answer-block">A HARDROCK rip rap job covers the rock, the filter fabric and the placing. The bank is cleared and shaped, fabric goes down, and the rock is set over it. If your own crew is doing the work, HARDROCK can deliver the rip rap and leave the installation to you.</p>
        <ul class="sp-included">
          <li><?php echo icon('check', 18); ?><span>Brush and loose soil cleared off the bank</span></li>
          <li><?php echo icon('check', 18); ?><span>Slope shaped so the rock has a firm bed</span></li>
          <li><?php echo icon('check', 18); ?><span>Filter fabric rolled down the slope</span></li>
          <li><?php echo icon('check', 18); ?><span>Rip rap hauled in and placed by skid steer</span></li>
          <li><?php echo icon('check', 18); ?><span>Stones hand-set to close the gaps</span></li>
        </ul>
      </div>
      <ol class="sp-steps reveal-right">
        <li><b>Describe the bank</b><span>Call or send the form with the address, roughly how long the bank is, and whether it is a pond, creek, culvert or ditch.</span></li>
        <li><b>Get the price and a day</b><span>HARDROCK quotes the rock and the work by phone and sets a date.</span></li>
        <li><b>Bank prepped, fabric down</b><span>The slope is cleared and shaped, then filter fabric is rolled down it.</span></li>
        <li><b>Rock set</b><span>Rip rap goes over the fabric and the stones are set by hand until the bank is covered.</span></li>
      </ol>
    </div>
  </div>
</section>

<!-- ============ QUANTITY ============ -->
<section class="section sp-math edge-curve-top" aria-labelledby="rr-math-title">
  <div class="container">
    <div class="sp-math__grid">
      <div class="reveal-left">
        <span class="eyebrow">Order the right amount</span>
        <h2 id="rr-math-title">How much rip rap does a bank need?</h2>
        <p class="answer-block">Multiply the bank length by the slope length by the rock layer thickness, all in feet, then divide by 27 for cubic yards. A 40-foot pond bank with 8 feet of slope covered 12 inches deep needs about 12 cubic yards of rip rap.</p>
        <p>Measure the slope length along the ground, from the toe at the water up to where the erosion stops, not straight across. Many erosion-control guides call for a rock layer about one and a half times as thick as the largest stones, so bigger rock means a deeper layer. HARDROCK can check your numbers before the load is ordered.</p>
      </div>
      <div class="sp-math__card reveal-right">
        <p class="sp-math__formula">Length × Slope × Depth <em>÷ 27</em></p>
        <dl class="sp-math__rows">
          <div><dt>Bank length</dt><dd>40 ft</dd></div>
          <div><dt>Slope length</dt><dd>8 ft</dd></div>
          <div><dt>Rock layer</dt><dd>1 ft (12 in)</dd></div>
          <div><dt>Rip rap needed</dt><dd>≈ 11.9 yd³</dd></div>
        </dl>
        <p>40 × 8 × 1 = 320 cubic feet. 320 ÷ 27 = 11.9 cubic yards.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ COMPARISON ============ -->
<section class="section sp-compare" aria-labelledby="rr-compare-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Pick the right rock</span>
      <h2 id="rr-compare-title">Rip rap, river rock or 57 rock: which belongs on an eroding slope?</h2>
      <p class="answer-block">Rip rap belongs on any slope that moving water reaches, because its weight and sharp edges keep it from rolling. River rock is smooth and rounded, so it suits dry creek beds and landscape beds. 57 rock is too small to hold against waves but drains well in trenches and under drives.</p>
    </div>
    <div class="sp-table-wrap reveal-up">
      <table class="sp-table">
        <caption>HARDROCK carries all three. Call for the sizes on hand.</caption>
        <thead>
          <tr><th scope="col">Material</th><th scope="col">Shape and size</th><th scope="col">On a slope in moving water</th><th scope="col">Best job</th></tr>
        </thead>
        <tbody>
          <tr class="is-this"><th scope="row">Rip rap</th><td>Large, angular stone</td><td>Holds: weight and edges lock the stones together</td><td>Pond banks, dam faces, creek bends, culvert outlets</td></tr>
          <tr><th scope="row">River rock</th><td>Smooth, rounded stone</td><td>Rolls and shifts once water pushes on it</td><td>Dry creek beds, landscape beds, downspout splash areas</td></tr>
          <tr><th scope="row">57 rock</th><td>Crushed stone, about 1 inch and smaller</td><td>Washes out under wave or channel flow</td><td>French drains, driveway top course, behind walls</td></tr>
        </tbody>
      </table>
    </div>
    <p class="reveal-up">For a decorative dry creek bed that only runs after storms, <a href="/services/river-rock/">river rock for landscape and drainage</a> is usually the better fit. For a drain trench behind the bank, ask about <a href="/services/57-67-rock/">57 and 67 crushed rock</a>.</p>
  </div>
</section>

<!-- ============ PROOF / RECENT WORK ============ -->
<section class="section sp-gallery sp-proof rr-proof" aria-labelledby="rr-proof-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Recent Work</span>
      <h2 id="rr-proof-title">What rip rap jobs has HARDROCK set recently?</h2>
      <p>These HARDROCK rip rap photos show the same job in order: filter fabric rolled down a cleared bank, a skid steer bringing rock to the slope while two workers hand-set it, and the rip rap stone itself up close.</p>
    </div>
    <div class="sp-gallery-grid" data-p1-dynamic>
      <figure class="sp-gallery-item reveal-scale">
        <?php echo pictureTag('rip-rap-crew-skid-steer', 'Two workers placing rip rap by hand on filter fabric as a skid steer unloads more rock', '(max-width: 700px) 100vw, 640px'); ?>
        <figcaption>Rock is fed in by skid steer and set by hand over the fabric.</figcaption>
      </figure>
      <figure class="sp-gallery-item reveal-up reveal-delay-1">
        <?php echo pictureTag('rip-rap-slope-filter-fabric', 'Workers rolling black filter fabric down a cleared bank beside piles of rip rap', '(max-width: 700px) 100vw, 420px'); ?>
        <figcaption>Filter fabric goes down the cleared bank before any rock.</figcaption>
      </figure>
      <figure class="sp-gallery-item reveal-up reveal-delay-2">
        <?php echo pictureTag('rip-rap-stockpile-closeup', 'Pile of grey rip rap stones with a golf ball on top for scale', '(max-width: 700px) 100vw, 420px'); ?>
        <figcaption>The rip rap stone, with a golf ball for scale.</figcaption>
      </figure>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
    echo p1_google_reviews($slug, ['heading' => 'What Grayson County customers say on Google', 'heading_tag' => 'h3', 'limit' => 6]); ?>
    <div class="sp-proof__foot">
      <a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a>
      <p>Every material and service HARDROCK offers is on <a href="/services/">the full list of HARDROCK services</a>.</p>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain slant-top sp-faq" id="faq" aria-labelledby="rr-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="rr-faq-title">What do customers ask before ordering rip rap?</h2>
      <p>Customers ordering rip rap from Hardrock Sand And Gravel usually ask two things before anything else: whether HARDROCK delivers rip rap to their property, and how a rip rap load is measured and priced.</p>
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
<?php echo sp_related_section(['ponds', 'river-rock', '57-67-rock'],
    'What else goes with <span class="text-accent">rip rap</span> on a pond or creek job?',
    'Rip rap is usually one part of a bigger water job. Hardrock Sand And Gravel also digs and shapes ponds, hauls river rock for dry creek beds and splash areas, and delivers 57 and 67 crushed rock for drain trenches, so the whole job can come from one company in Sherman.'); ?>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Need a bank armored before the next big rain?',
    'Call Hardrock Sand And Gravel with the address and the length of bank, or send the form. HARDROCK opens at 6 AM Monday through Thursday, so an early call gets rip rap on the schedule sooner.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
