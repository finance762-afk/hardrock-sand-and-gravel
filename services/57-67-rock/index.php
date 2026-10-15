<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$svc             = sp_service('57-67-rock');
$pageTitle       = '57 and 67 Rock in Sherman, TX | HARDROCK';
$pageDescription = '#57 and #67 crushed rock delivered in Sherman, Denison and Grayson County for French drains, driveway top course and concrete. Call HARDROCK at ' . formatPhone($phone) . '.';
$canonicalUrl    = $siteUrl . '/services/57-67-rock/';
$ogImage         = '/assets/images/gravel-stockpiles-job-site.jpg';
$currentPage     = 'services';
$pageType        = 'service';
$serviceSlug     = '57-67-rock';
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = 'gravel-stockpiles-job-site';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* FAQ: research-brief questions this page can answer truthfully (which grade, delivery area, how it is quoted) */
$faqs = [
    ['q' => 'Should I order 57 rock or 67 rock?',
     'a' => 'Order 57 rock for French drains, culvert bedding and the finish layer on a gravel drive, where the larger stone keeps open gaps for water. Order 67 rock for a concrete mix, a finer drainage layer or anywhere a smoother, tighter surface matters. If the job could go either way, describe it to HARDROCK on the phone first.'],
    ['q' => 'Does HARDROCK bring 57 and 67 rock out to Denison and the rest of the county?',
     'a' => 'Yes. HARDROCK Sand and Gravel trucks crushed rock to homes, farms and job sites in Sherman, Denison and the other Grayson County towns. Call ' . $spCall . ' with the address and the size you want, and HARDROCK will quote the load and set a delivery day by phone.'],
    ['q' => 'What does a load of 57 or 67 rock cost?',
     'a' => 'HARDROCK Sand and Gravel gives crushed rock prices over the phone, because the figure depends on the size, the quantity and the distance to your site. Work out your cubic yards first, then call ' . $spCall . ' to hear the current price and the unit it is sold by.'],
];

$pageSchemas = [
    ['@context' => 'https://schema.org', '@graph' => [
        array_diff_key(generateServiceSchema($svc), ['@context' => 1]) + ['image' => $siteUrl . '/assets/images/gravel-stockpiles-job-site.jpg'],
        array_diff_key(sp_breadcrumb_schema($svc['name'], '57-67-rock'), ['@context' => 1]),
        array_diff_key(generateFAQSchema($faqs), ['@context' => 1]),
    ]],
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style>
/* ==========================================================================
   /services/57-67-rock/ — page-specific composition
   Signature: the side-by-side sieve-size gauge (0 to 1 1/2 in. scale) for #57 and #67.
   ========================================================================== */
.sr-hero .hero-bg img { object-position: 50% 55%; }
.sr-uses .sp-signs { grid-template-columns: repeat(2, minmax(0, 1fr)); }
.sr-uses .sp-sign:nth-child(odd) { border-top: var(--space-1) solid var(--color-accent); }
.sr-gauge__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.25fr); gap: var(--space-3xl); align-items: center; }
.sr-gauge__copy { display: grid; gap: var(--space-md); }
.sr-gauge__copy > p { margin: 0; max-width: var(--measure); }
.sr-gauge { display: grid; gap: var(--space-lg); padding: var(--space-xl); border-radius: var(--radius-sm); background: color-mix(in srgb, var(--color-white) 6%, transparent); border: 1px solid color-mix(in srgb, var(--color-white) 14%, transparent); box-shadow: var(--shadow-lg); }
.sr-gauge__scale { position: relative; height: var(--space-lg); margin-bottom: var(--space-md);
  background: repeating-linear-gradient(90deg, color-mix(in srgb, var(--color-white) 55%, transparent) 0 2px, transparent 2px 16.666%) 0 100% / 100% 60% no-repeat;
  border-bottom: 2px solid color-mix(in srgb, var(--color-white) 55%, transparent); }
.sr-gauge__scale span { position: absolute; bottom: calc(-1 * var(--space-lg)); transform: translateX(-50%); font-family: var(--font-accent); font-size: var(--fs-small); letter-spacing: .06em; color: color-mix(in srgb, var(--color-white) 70%, transparent); }
.sr-gauge__scale span:nth-child(1) { left: 0; transform: none; } .sr-gauge__scale span:nth-child(2) { left: 16.666%; } .sr-gauge__scale span:nth-child(3) { left: 33.333%; }
.sr-gauge__scale span:nth-child(4) { left: 50%; } .sr-gauge__scale span:nth-child(5) { left: 66.666%; } .sr-gauge__scale span:nth-child(6) { left: 83.333%; }
.sr-gauge__scale span:nth-child(7) { left: 100%; transform: translateX(-100%); }
.sr-gauge__rows { display: grid; gap: var(--space-md); margin: var(--space-sm) 0 0; padding: 0; list-style: none; }
.sr-gauge__rows li { display: grid; gap: var(--space-xs); }
.sr-gauge__rows b { font-family: var(--font-heading); text-transform: uppercase; letter-spacing: .03em; color: var(--color-white); }
.sr-gauge__rows small { font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 72%, transparent); }
.sr-track { position: relative; height: var(--space-lg); border-radius: var(--radius-sm); background: color-mix(in srgb, var(--color-white) 8%, transparent); overflow: hidden; }
.sr-bar { position: absolute; top: 0; bottom: 0; border-radius: var(--radius-sm); transform-origin: left; transition: transform .8s var(--ease);
  background: radial-gradient(circle, color-mix(in srgb, var(--color-white) 30%, transparent) 0 22%, transparent 26%) 0 0 / var(--space-md) var(--space-md), linear-gradient(90deg, var(--color-accent-dark), var(--color-accent)); }
.sr-bar--57 { left: 12.5%; width: 54.2%; }
.sr-bar--67 { left: 6.25%; width: 43.75%; background-size: var(--space-sm) var(--space-sm), auto; transition-delay: .15s; }
html.js-anim .sr-gauge.reveal-up:not(.in) .sr-bar { transform: scaleX(0); }
.sr-gauge__note { margin: 0; font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 68%, transparent); }
.sr-compare .sp-table tr.is-this + tr.is-this th { box-shadow: inset var(--space-1) 0 0 var(--color-accent-dark); }
.sr-proof .sp-proof__single figure picture { display: block; aspect-ratio: 16 / 10; overflow: hidden; }
.sr-proof .sp-proof__single figure img { width: 100%; height: 100%; object-fit: cover; }
.sr-proof__copy { display: grid; gap: var(--space-md); }
.sr-proof__copy p { margin: 0; color: var(--color-ink-2); }
@media (max-width: 900px) { .sr-gauge__grid { grid-template-columns: 1fr; gap: var(--space-2xl); } }
@media (max-width: 560px) { .sr-uses .sp-signs { grid-template-columns: 1fr; } .sr-gauge { padding: var(--space-lg); } }
@media (prefers-reduced-motion: reduce) { .sr-bar { transition: none; } html.js-anim .sr-gauge.reveal-up:not(.in) .sr-bar { transform: none; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero sr-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Rows of grey gravel piles dumped across a large staked and graded site at sunset', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo sp_breadcrumb($svc['name']); ?>
    <div class="hero-grid hero-grid--form">
      <div class="hero-text hero-copy">
        <span class="eyebrow">Crushed rock · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
        <h1 class="hero-title" id="sp-hero-title"><span class="text-accent">57 and 67 Rock</span> in Sherman, TX</h1>
        <p class="hero-answer">HARDROCK Sand and Gravel delivers #57 and #67 crushed rock to Sherman, Denison and Grayson County. Builders and homeowners pick 57 rock for French drains, culvert bedding and the top layer of a gravel drive, and the smaller 67 rock for concrete mixes, finer drainage beds and smoother walking surfaces.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('layers', 16); ?>#57 and #67 sizes</li>
          <li><?php echo icon('map-pin', 16); ?>Sherman, Denison, Grayson Co.</li>
          <li><?php echo icon('phone', 16); ?>Priced over the phone</li>
        </ul>
      </div>

      <aside class="hero-form-card" id="estimate-form">
        <h2>Want a price on 57 or 67 rock?</h2>
        <p class="hero-form-tagline">Say which size and roughly how much. HARDROCK phones back with the price.</p>
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
<section class="section sp-problem sr-uses" aria-labelledby="sr-uses-title">
  <div class="container">
    <div class="sp-problem__grid">
      <div class="sp-problem__lead reveal-left">
        <span class="eyebrow">Where it goes</span>
        <h2 id="sr-uses-title">Where do 57 and 67 <span class="text-accent">crushed rock</span> get used around Sherman?</h2>
        <p class="answer-block">Around Sherman, 57 and 67 crushed rock goes wherever water must pass through stone instead of pooling on clay. Typical spots are drain trenches, foundation drain backfill, pipe bedding and the finish layer of a drive. 67 rock is also a standard coarse aggregate in concrete.</p>
        <p class="pull-quote">Black clay holds water like a bowl. Open-graded rock gives it somewhere to go.</p>
      </div>
      <ul class="sp-signs">
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('droplets', 22); ?><b>French drains</b><span>A trench wrapped in fabric, a perforated pipe and 57 rock pull standing water away from a house or a soggy corner of the yard.</span></li>
        <li class="sp-sign reveal-up reveal-delay-2"><?php echo icon('route', 22); ?><b>Driveway finish layer</b><span>A few inches of 57 over compacted base gives a drive a clean, rocky surface that drains instead of turning to slippery mud.</span></li>
        <li class="sp-sign reveal-up reveal-delay-3"><?php echo icon('building', 22); ?><b>Concrete and slab work</b><span>67 rock's smaller top size suits poured concrete and the stone layer sometimes placed under a slab.</span></li>
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('waypoints', 22); ?><b>Pipe and culvert bedding</b><span>Angular stone around a pipe settles firm and lets seep water run along the line instead of softening the trench.</span></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ SIGNATURE: SIEVE GAUGE ============ -->
<section class="section on-dark texture-grain edge-wave-top sr-sizes" aria-labelledby="sr-sizes-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="sr-gauge__grid">
      <div class="sr-gauge__copy reveal-left">
        <span class="eyebrow">Size by the sieve</span>
        <h2 id="sr-sizes-title">How big is <span class="text-accent">57 rock</span> compared with 67 rock?</h2>
        <p class="answer-block">57 rock runs from about 1 inch down to roughly 3/16 inch, while 67 rock runs from about 3/4 inch down to roughly 3/32 inch. The numbers come from the AASHTO M 43 size chart, which defines each grade by the sieves the stone passes through and stops on.</p>
        <p>The two ranges overlap a lot, so the real difference is the top size. 57 has more stones near an inch, which leaves bigger voids for water and grips under tires. 67 tops out smaller and fills a concrete form or a narrow trench more evenly. Either number names a range of stone, not one exact size.</p>
      </div>
      <div class="sr-gauge reveal-up" role="group" aria-labelledby="sr-gauge-cap">
        <p class="sr-gauge__note" id="sr-gauge-cap">Nominal size range on a 0 to 1&frac12; inch scale</p>
        <div class="sr-gauge__scale" aria-hidden="true">
          <span>0</span><span>&frac14;</span><span>&frac12;</span><span>&frac34;</span><span>1</span><span>1&frac14;</span><span>1&frac12; in.</span>
        </div>
        <ul class="sr-gauge__rows">
          <li><b>#57 rock</b><div class="sr-track"><span class="sr-bar sr-bar--57"></span></div><small>About 1 in. down to the #4 sieve (≈ 3/16 in.)</small></li>
          <li><b>#67 rock</b><div class="sr-track"><span class="sr-bar sr-bar--67"></span></div><small>About 3/4 in. down to the #8 sieve (≈ 3/32 in.)</small></li>
        </ul>
        <p class="sr-gauge__note">Ranges are the nominal AASHTO M 43 sizes. A load can carry a small share of stone just outside them.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ COMPARISON ============ -->
<section class="section sp-compare sr-compare" aria-labelledby="sr-compare-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Match rock to the job</span>
      <h2 id="sr-compare-title">Which crushed rock belongs in a French drain, a drive or a concrete pour?</h2>
      <p class="answer-block">A French drain takes 57 rock, a concrete pour usually takes 67 rock, and a drive takes road base underneath with either size as the finish. River rock drains just as well but its round stones roll, so it suits landscape drainage more than anything that carries a vehicle.</p>
    </div>
    <div class="sp-table-wrap reveal-up">
      <table class="sp-table">
        <caption>HARDROCK carries all four. The phone call is the place to confirm sizes on hand.</caption>
        <thead>
          <tr><th scope="col">Material</th><th scope="col">Stone</th><th scope="col">Drainage</th><th scope="col">Under tires</th><th scope="col">Usual job</th></tr>
        </thead>
        <tbody>
          <tr class="is-this"><th scope="row">57 rock</th><td>Angular, about 1 in. down</td><td>High, large voids</td><td>Grips, shifts a little</td><td>French drains, drive finish, pipe bedding</td></tr>
          <tr class="is-this"><th scope="row">67 rock</th><td>Angular, about 3/4 in. down</td><td>Good, smaller voids</td><td>Smoother, tighter</td><td>Concrete aggregate, finer drain layers</td></tr>
          <tr><th scope="row">Road base</th><td>Crushed stone with fines</td><td>Low, sheds water</td><td>Packs hard</td><td>Base course under drives and pads</td></tr>
          <tr><th scope="row">River rock</th><td>Smooth and rounded</td><td>High</td><td>Rolls and ruts</td><td>Dry creek beds, landscape drainage</td></tr>
        </tbody>
      </table>
    </div>
    <p class="reveal-up">For the layer under a drive, see <a href="/services/road-base/">road base that compacts under drives and pads</a>. For a decorative dry creek bed, <a href="/services/river-rock/">river rock for beds and drainage</a> looks more natural than crushed stone.</p>
  </div>
</section>

<!-- ============ QUANTITY ============ -->
<section class="section sp-math edge-curve-top" aria-labelledby="sr-math-title">
  <div class="container">
    <div class="sp-math__grid">
      <div class="reveal-left">
        <span class="eyebrow">Trench math</span>
        <h2 id="sr-math-title">How much <span class="text-accent">57 rock</span> fills a French drain trench?</h2>
        <p class="answer-block">A French drain trench 60 feet long, 1 foot wide and 18 inches deep holds about 3.3 cubic yards of 57 rock. Multiply length, width and depth in feet, then divide by 27. The pipe takes up so little room that most people ignore it and round up.</p>
        <p>For a driveway finish layer, use the same formula with the depth of the top course. A 100-foot by 12-foot drive with 3 inches of 57 on top comes to about 11 cubic yards. Open-graded rock like 57 settles only slightly, unlike road base, so the measured volume is close to what you order.</p>
      </div>
      <div class="sp-math__card reveal-right">
        <p class="sp-math__formula">Length × Width × Depth <em>÷ 27</em></p>
        <dl class="sp-math__rows">
          <div><dt>Trench length</dt><dd>60 ft</dd></div>
          <div><dt>Trench width</dt><dd>1 ft</dd></div>
          <div><dt>Trench depth</dt><dd>1.5 ft (18 in)</dd></div>
          <div><dt>57 rock needed</dt><dd>≈ 3.3 yd³</dd></div>
        </dl>
        <p>60 × 1 × 1.5 = 90 cubic feet. 90 ÷ 27 = 3.3 cubic yards.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ PROCESS ============ -->
<section class="section on-dark texture-grain slant-top sp-breakdown" aria-labelledby="sr-steps-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="sp-breakdown__grid">
      <div class="reveal-left">
        <span class="eyebrow">Ordering</span>
        <h2 id="sr-steps-title">What happens after you call HARDROCK about crushed rock?</h2>
        <p class="answer-block">After you call HARDROCK about crushed rock, the order is settled in one conversation: which size, how many cubic yards, where the load goes, the price and the day. Having a few details ready keeps that call short and gets the rock on the schedule sooner.</p>
        <ul class="sp-included">
          <li><?php echo icon('check', 18); ?><span>The delivery address and the town</span></li>
          <li><?php echo icon('check', 18); ?><span>The job: drain, drive, concrete or bedding</span></li>
          <li><?php echo icon('check', 18); ?><span>Length, width and depth of the area</span></li>
          <li><?php echo icon('check', 18); ?><span>Where the truck should dump the load</span></li>
        </ul>
      </div>
      <ol class="sp-steps reveal-right">
        <li><b>Call or send the form</b><span>Phone lines open at 6 AM Monday through Thursday, 9 AM on Friday and Saturday.</span></li>
        <li><b>Check the quantity</b><span>HARDROCK runs the cubic-yard math with you so the order is not short.</span></li>
        <li><b>Price and a day</b><span>The price and the delivery day are given on the phone.</span></li>
        <li><b>Rock on the ground</b><span>The load is dumped where you asked, ready to spread.</span></li>
      </ol>
    </div>
  </div>
</section>

<!-- ============ PROOF ============ -->
<section class="section sp-proof sr-proof" aria-labelledby="sr-proof-title">
  <div class="container">
    <div class="sp-proof__single">
      <figure class="reveal-left">
        <?php echo pictureTag('gravel-stockpiles-job-site', 'Grey gravel piles dumped in rows across a graded site, with survey stakes in the foreground at sunset', '(max-width: 900px) 100vw, 640px'); ?>
        <figcaption>Gravel loads dropped in rows across a staked, graded site.</figcaption>
      </figure>
      <div class="sr-proof__copy reveal-right">
        <span class="eyebrow">On the job</span>
        <h2 id="sr-proof-title">What does a HARDROCK gravel drop look like on a big site?</h2>
        <p class="answer-block">A HARDROCK gravel drop on a big site can be a whole set of piles dumped in rows rather than one heap. In this photo the grey piles run across a graded lot with survey stakes in front, so the stone sits spread out across the area instead of all at the entrance.</p>
        <p>On a large lot anywhere in Grayson County, from Gunter to Pottsboro, it pays to plan where each load is dumped on the first call. The <a href="/services/">complete list of HARDROCK materials and services</a> covers everything else a site like this might need.</p>
      </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
    echo p1_google_reviews($slug, ['heading' => 'Google reviews from HARDROCK customers', 'heading_tag' => 'h3', 'limit' => 6]); ?>
    <div class="sp-proof__foot">
      <a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain edge-torn-top sp-faq" id="faq" aria-labelledby="sr-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="sr-faq-title">What do buyers ask about 57 and 67 rock?</h2>
      <p>Buyers of 57 and 67 rock tend to ask HARDROCK Sand and Gravel the same three things: which of the two sizes fits their project, whether the truck reaches their part of the county, and what a load will cost.</p>
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
<?php echo sp_related_section(['road-base', 'driveways', 'river-rock'],
    'What goes with <span class="text-accent">57 and 67 rock</span> on a drive or drainage job?',
    'Crushed rock rarely goes down alone. HARDROCK Sand and Gravel also hauls road base for the layer beneath a drive, builds complete gravel driveways for rural lots and homes, and carries river rock for dry creek beds, so a drainage fix or a new drive near Sherman can be planned on one call.'); ?>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Need 57 or 67 rock for a drain or a drive?',
    'Call HARDROCK Sand and Gravel with the size, the measurements and the address, or send the form. The price and a delivery day come back on the phone.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
