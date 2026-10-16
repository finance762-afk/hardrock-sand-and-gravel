<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$svc             = sp_service('mason-sand');
$pageTitle       = 'Mason Sand in Sherman, TX | Hardrock Sand And Gravel';
$pageDescription = 'Mason sand delivered in Sherman, Denison and Grayson County, TX for mortar, flagstone and paver bedding, and sandboxes. Call HARDROCK at ' . formatPhone($phone) . '.';
$canonicalUrl    = $siteUrl . '/services/mason-sand/';
$ogImage         = '/assets/images/flagstone-patio-fire-pit.jpg';
$currentPage     = 'services';
$pageType        = 'service';
$serviceSlug     = 'mason-sand';
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = 'flagstone-patio-fire-pit';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* FAQ: research-brief questions this page can answer truthfully (which sand, delivery area, how it is quoted) */
$faqs = [
    ['q' => 'Which type of sand should I use for my project?',
     'a' => 'Pick by grain size and job. Mason sand is the finest of the common bulk sands, which makes it the choice for mortar, setting flagstone and filling a sandbox. Concrete sand is coarser and is used in concrete mixes and under heavier paver work. Fill sand is for leveling and backfill. Tell HARDROCK what you are building and the call will sort out the right sand.'],
    ['q' => 'Will HARDROCK haul mason sand to a home in Denison or out by the lake?',
     'a' => 'Hardrock Sand And Gravel delivers mason sand to homes in Sherman, Denison and the rest of Grayson County. Call ' . $spCall . ' with the address and the spot where the pile should go, such as the side yard or the end of the drive, and the delivery day is set on that call.'],
    ['q' => 'Is mason sand priced per ton or per cubic yard?',
     'a' => 'Both. Hardrock Sand And Gravel prices mason sand by the ton and by the yard, and a full load is 20 yards or 20 tons. The delivered price still moves with the amount and the trip to your address, so measure the patio, sandbox or mortar job first, then call ' . $spCall . ' for the current price.'],
];

$pageSchemas = [
    ['@context' => 'https://schema.org', '@graph' => [
        array_diff_key(generateServiceSchema($svc), ['@context' => 1]) + ['image' => $siteUrl . '/assets/images/flagstone-patio-fire-pit.jpg'],
        array_diff_key(sp_breadcrumb_schema($svc['name'], 'mason-sand'), ['@context' => 1]),
        array_diff_key(generateFAQSchema($faqs), ['@context' => 1]),
    ]],
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style>
/* ==========================================================================
   /services/mason-sand/ — page-specific composition
   Signature: the mortar-mix ratio bar (3 parts sand : 1 part binder) on the dark band.
   ========================================================================== */
.ms-hero .hero-bg img { object-position: 50% 58%; }
.ms-uses .sp-sign:first-child { grid-column: 1 / -1; grid-template-columns: auto 1fr; align-items: start; column-gap: var(--space-md); }
.ms-uses .sp-sign:first-child svg { grid-row: span 2; }
.ms-ratio__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.1fr); gap: var(--space-3xl); align-items: center; }
.ms-ratio__copy { display: grid; gap: var(--space-md); }
.ms-ratio__copy > p { margin: 0; max-width: var(--measure); }
.ms-mix { display: grid; gap: var(--space-lg); padding: var(--space-xl); border-radius: var(--radius-sm); background: color-mix(in srgb, var(--color-white) 6%, transparent); border: 1px solid color-mix(in srgb, var(--color-white) 14%, transparent); box-shadow: var(--shadow-lg); }
.ms-mix__label { margin: 0; font-family: var(--font-accent); text-transform: uppercase; letter-spacing: .12em; font-size: var(--fs-small); color: var(--color-accent-bright); }
.ms-mix__bar { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: var(--space-1); margin: 0; padding: 0; list-style: none; border-radius: var(--radius-sm); overflow: hidden; }
.ms-mix__bar li { display: grid; place-items: end start; min-height: 7rem; padding: var(--space-sm); font-family: var(--font-heading); text-transform: uppercase; letter-spacing: .03em; font-size: .95rem; transform-origin: bottom; transition: transform .6s var(--ease); }
.ms-part--sand { color: var(--color-ink); background:
  radial-gradient(circle, color-mix(in srgb, var(--color-accent-dark) 30%, transparent) 0 10%, transparent 12%) 0 0 / var(--space-xs) var(--space-xs),
  color-mix(in srgb, var(--color-accent) 22%, var(--color-paper)); }
.ms-part--binder { color: var(--color-white); background:
  repeating-linear-gradient(45deg, color-mix(in srgb, var(--color-white) 10%, transparent) 0 2px, transparent 2px var(--space-sm)),
  var(--color-secondary); }
.ms-mix__bar li:nth-child(2) { transition-delay: .1s; } .ms-mix__bar li:nth-child(3) { transition-delay: .2s; } .ms-mix__bar li:nth-child(4) { transition-delay: .3s; }
html.js-anim .ms-mix.reveal-up:not(.in) .ms-mix__bar li { transform: scaleY(.2); }
.ms-mix__legend { display: flex; flex-wrap: wrap; gap: var(--space-sm) var(--space-lg); margin: 0; font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 75%, transparent); }
.ms-mix__legend b { color: var(--color-white); }
.ms-mix__batch { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-sm); margin: 0; }
.ms-mix__batch div { padding: var(--space-sm); border-top: 2px solid var(--color-accent); background: color-mix(in srgb, var(--color-white) 5%, transparent); }
.ms-mix__batch dt { font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 70%, transparent); }
.ms-mix__batch dd { margin: 0; font-family: var(--font-accent); font-weight: 700; font-size: 1.2rem; color: var(--color-white); }
.ms-compare .sp-table td:first-of-type { font-style: italic; }
.ms-proof .sp-proof__single figure picture { display: block; aspect-ratio: 4 / 3; overflow: hidden; }
.ms-proof .sp-proof__single figure img { width: 100%; height: 100%; object-fit: cover; }
.ms-proof__copy { display: grid; gap: var(--space-md); }
.ms-proof__copy p { margin: 0; color: var(--color-ink-2); }
@media (max-width: 900px) { .ms-ratio__grid { grid-template-columns: 1fr; gap: var(--space-2xl); } }
@media (max-width: 560px) { .ms-mix { padding: var(--space-lg); } .ms-mix__batch { grid-template-columns: 1fr; } .ms-mix__bar li { min-height: 5rem; font-size: .8rem; } .ms-uses .sp-sign:first-child { grid-template-columns: 1fr; } }
@media (prefers-reduced-motion: reduce) { .ms-mix__bar li { transition: none; } html.js-anim .ms-mix.reveal-up:not(.in) .ms-mix__bar li { transform: none; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero ms-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Flagstone patio around a square stone fire pit in a rural yard with a fence behind', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo sp_breadcrumb($svc['name']); ?>
    <div class="hero-grid hero-grid--form">
      <div class="hero-text hero-copy">
        <span class="eyebrow">Mason sand · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
        <h1 class="hero-title" id="sp-hero-title"><span class="text-accent">Mason Sand</span> in Sherman, TX</h1>
        <p class="hero-answer">Hardrock Sand And Gravel delivers mason sand to Sherman, Denison and Grayson County for masons, patio builders and homeowners. Mason sand is a fine, clean sand that mixes into smooth mortar for brick and stone, beds flagstone and pavers level, and fills a backyard sandbox with something soft enough for kids.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('hammer', 16); ?>Mortar, bedding, sandboxes</li>
          <li><?php echo icon('truck', 16); ?>Grayson County delivery</li>
          <li><?php echo icon('calendar', 16); ?>Open Saturdays 9–2</li>
        </ul>
      </div>

      <aside class="hero-form-card" id="estimate-form">
        <h2>Want a price on mason sand?</h2>
        <p class="hero-form-tagline">List the job and the address. HARDROCK rings back with a figure.</p>
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
<section class="section sp-problem ms-uses" aria-labelledby="ms-uses-title">
  <div class="container">
    <div class="sp-problem__grid">
      <div class="sp-problem__lead reveal-left">
        <span class="eyebrow">Fine grain, finish work</span>
        <h2 id="ms-uses-title">What jobs is <span class="text-accent">mason sand</span> the right sand for?</h2>
        <p class="answer-block">Mason sand is the right sand for finish work that needs a fine, even grain. That means mortar joints in brick and stone, a level bed under flagstone or light-duty pavers, and play sand in a sandbox. On structural concrete or under a driveway, a coarser material does the job better.</p>
        <p class="pull-quote">The finer the sand, the thinner and smoother the mortar joint it can make.</p>
      </div>
      <ul class="sp-signs">
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('hammer', 22); ?><b>Mortar for brick and stone</b><span>Fire pit walls, mailbox columns, brick borders and stone veneer all go up with mortar mixed from fine sand. Small grains spread smoothly off the trowel and fill narrow joints without gaps.</span></li>
        <li class="sp-sign reveal-up reveal-delay-2"><?php echo icon('layers', 22); ?><b>Flagstone bedding</b><span>An inch or so of sand under each stone lets it be tapped down level and keeps it from rocking.</span></li>
        <li class="sp-sign reveal-up reveal-delay-3"><?php echo icon('footprints', 22); ?><b>Walkway pavers</b><span>Patios and paths that only carry foot traffic can sit on a smooth screeded sand bed.</span></li>
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('sun', 22); ?><b>Sandboxes</b><span>Fine sand is soft on hands and knees and dries out quickly after a North Texas storm.</span></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ COMPARISON ============ -->
<section class="section sp-compare ms-compare edge-curve-top" aria-labelledby="ms-compare-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Sand is not all the same</span>
      <h2 id="ms-compare-title">Mason sand, concrete sand or decomposed granite: which <span class="text-accent">sand</span> fits the job?</h2>
      <p class="answer-block">Mason sand fits mortar, sandboxes and bedding under flagstone because its grains are the finest and most even. Concrete sand is coarser and stronger in a concrete mix or under pavers that carry cars. Decomposed granite packs into a firm walking surface, and fill dirt only raises the grade.</p>
    </div>
    <div class="sp-table-wrap reveal-up">
      <table class="sp-table">
        <caption>Mason sand, decomposed granite and fill dirt are all on HARDROCK's list. Ask on the phone about any other sand.</caption>
        <thead>
          <tr><th scope="col">Material</th><th scope="col">Grain</th><th scope="col">Packs firm?</th><th scope="col">Typical use</th><th scope="col">Poor fit for</th></tr>
        </thead>
        <tbody>
          <tr class="is-this"><th scope="row">Mason sand</th><td>Fine and even</td><td>Settles, stays workable</td><td>Mortar, flagstone bed, sandboxes</td><td>Driveway base, structural concrete</td></tr>
          <tr><th scope="row">Concrete sand</th><td>Coarse, mixed sizes</td><td>Firmer bed</td><td>Concrete mixes, paver bedding under vehicles</td><td>Thin mortar joints, sandboxes</td></tr>
          <tr><th scope="row">Decomposed granite</th><td>Fine crushed granite with dust</td><td>Yes, when tamped</td><td>Paths, patio surfaces, xeriscape beds</td><td>Mortar</td></tr>
          <tr><th scope="row">Fill dirt</th><td>Soil</td><td>Firm when dry</td><td>Raising low ground before a patio</td><td>Any finished surface</td></tr>
        </tbody>
      </table>
    </div>
    <p class="reveal-up">If the patio surface itself should be soft-looking and walkable rather than stone, look at <a href="/services/decomposed-granite/">decomposed granite for paths and patios</a>. If the yard dips where the patio is going, start with <a href="/services/fill-dirt/">fill dirt to level the ground</a>.</p>
  </div>
</section>

<!-- ============ SIGNATURE: MORTAR RATIO ============ -->
<section class="section on-dark texture-grain slant-top ms-ratio" aria-labelledby="ms-ratio-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="ms-ratio__grid">
      <div class="ms-ratio__copy reveal-left">
        <span class="eyebrow">The mix</span>
        <h2 id="ms-ratio-title">How much <span class="text-accent">mason sand</span> goes into a batch of mortar?</h2>
        <p class="answer-block">Most site-mixed mortar uses about 3 parts mason sand to 1 part cementitious material by volume, so sand makes up roughly three quarters of the dry mix. Water goes in last, a little at a time, until the mortar holds its shape on the trowel.</p>
        <p>Follow the mix on the cement bag or the project spec when there is one, since mortar types vary. In a Grayson County summer, mortar stiffens fast in the sun, so mix smaller batches and keep fresh work damp. A cubic yard holds 27 cubic feet of sand, enough for about nine batches made with 1 cubic foot of binder each.</p>
      </div>
      <div class="ms-mix reveal-up" role="group" aria-labelledby="ms-mix-cap">
        <p class="ms-mix__label" id="ms-mix-cap">Mortar by volume: 3 parts sand to 1 part binder</p>
        <ol class="ms-mix__bar">
          <li class="ms-part--sand">Sand</li>
          <li class="ms-part--sand">Sand</li>
          <li class="ms-part--sand">Sand</li>
          <li class="ms-part--binder">Binder</li>
        </ol>
        <p class="ms-mix__legend"><span><b>Sand:</b> about 75% of the dry mix</span><span><b>Binder:</b> cement or masonry cement, about 25%</span></p>
        <dl class="ms-mix__batch">
          <div><dt>Binder</dt><dd>1 cu ft</dd></div>
          <div><dt>Mason sand</dt><dd>3 cu ft</dd></div>
          <div><dt>Batches per yd³</dt><dd>≈ 9</dd></div>
        </dl>
      </div>
    </div>
  </div>
</section>

<!-- ============ QUANTITY ============ -->
<section class="section sp-math edge-wave-top" aria-labelledby="ms-math-title">
  <div class="container">
    <div class="sp-math__grid">
      <div class="reveal-left">
        <span class="eyebrow">Bed and box math</span>
        <h2 id="ms-math-title">How much <span class="text-accent">mason sand</span> does a flagstone patio or a sandbox need?</h2>
        <p class="answer-block">A 14 by 16 foot flagstone patio on a 1-inch sand bed needs about 0.7 cubic yards of mason sand. A sandbox 6 feet square filled 1 foot deep takes about 1.3 cubic yards. Both come from length times width times depth in feet, divided by 27.</p>
        <p>Depth is the number people get wrong. Write inches as a fraction of a foot: 1 inch is 0.083 feet, 2 inches is 0.167, 6 inches is 0.5. If joints between the stones will be filled with sand as well, or the ground under the bed is uneven, round the order up rather than down. HARDROCK can run the numbers with you on the call.</p>
      </div>
      <div class="sp-math__card reveal-right">
        <p class="sp-math__formula">Length × Width × Depth <em>÷ 27</em></p>
        <dl class="sp-math__rows">
          <div><dt>Patio length</dt><dd>16 ft</dd></div>
          <div><dt>Patio width</dt><dd>14 ft</dd></div>
          <div><dt>Sand bed</dt><dd>0.083 ft (1 in)</dd></div>
          <div><dt>Mason sand needed</dt><dd>≈ 0.7 yd³</dd></div>
        </dl>
        <p>16 × 14 × 0.083 = 18.7 cubic feet. 18.7 ÷ 27 = 0.69 cubic yards.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ PROOF ============ -->
<section class="section sp-proof ms-proof" aria-labelledby="ms-proof-title">
  <div class="container">
    <div class="sp-proof__single">
      <figure class="reveal-left">
        <?php echo pictureTag('flagstone-patio-fire-pit', 'Flagstone patio with a square stone fire pit and decomposed granite in the joints, a fence and open yard behind', '(max-width: 900px) 100vw, 640px'); ?>
        <figcaption>A HARDROCK flagstone patio and stone fire pit, with decomposed granite in the joints: the kind of backyard build that uses fine sand underneath.</figcaption>
      </figure>
      <div class="ms-proof__copy reveal-right">
        <span class="eyebrow">From the ground up</span>
        <h2 id="ms-proof-title">Where does mason sand go in a flagstone patio with a fire pit?</h2>
        <p class="answer-block">In a flagstone patio with a fire pit, mason sand goes in the thin bed under each flagstone and in the mortar for stone or block walls. The joints between flagstones can be filled with fine sand, decomposed granite or mortar, depending on the finish wanted. On the HARDROCK patio pictured here, the joints are decomposed granite.</p>
        <p>Patios and fire pits like this are a favorite weekend build on acreage around Sherman and at lake homes near Pottsboro and Lake Texoma. Every other material HARDROCK supplies is on <a href="/services/">the HARDROCK services overview</a>.</p>
      </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
    echo p1_google_reviews($slug, ['heading' => 'HARDROCK reviews from Google', 'heading_tag' => 'h3', 'limit' => 6]); ?>
    <div class="sp-proof__foot">
      <a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain edge-torn-top sp-faq" id="faq" aria-labelledby="ms-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="ms-faq-title">What should you ask before ordering mason sand?</h2>
      <p>Mason sand buyers calling Hardrock Sand And Gravel mostly want to settle which kind of sand the project really calls for, whether the truck can reach a home in their part of Grayson County, and how the sand is priced.</p>
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
<?php echo sp_related_section(['decomposed-granite', 'fill-dirt', 'delivery'],
    'What else does a <span class="text-accent">mason sand</span> patio project need?',
    'A patio or fire pit build usually needs more than one material. Hardrock Sand And Gravel also carries decomposed granite for paths and patio surfaces and fill dirt for leveling a low yard, and delivers bulk loads across Sherman and Grayson County, so the sand and the ground work can be ordered together.'); ?>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Need mason sand for a patio, fire pit or sandbox?',
    'Call Hardrock Sand And Gravel with the job, the measurements and the address, or send the form. HARDROCK calls back with the price and a delivery day, so the sand is there before the stone work starts.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
