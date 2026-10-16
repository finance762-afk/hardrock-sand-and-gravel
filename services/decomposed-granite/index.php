<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$svc             = sp_service('decomposed-granite');
$pageTitle       = 'Decomposed Granite in Sherman, TX | HARDROCK Sand and Gravel';
$pageDescription = 'Decomposed granite for firm garden paths, patios and xeriscape beds, delivered in Sherman, Denison and Grayson County, TX. Call HARDROCK at ' . formatPhone($phone) . '.';
$canonicalUrl    = $siteUrl . '/services/decomposed-granite/';
$ogImage         = '/assets/images/crushed-red-granite-closeup.jpg';
$currentPage     = 'services';
$pageType        = 'service';
$serviceSlug     = 'decomposed-granite';
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = 'crushed-red-granite-closeup';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* FAQ: research-brief questions this page can answer truthfully (delivery area, pricing unit) + one general DG question */
$faqs = [
    ['q' => 'Can HARDROCK deliver decomposed granite to my address?',
     'a' => 'HARDROCK Sand and Gravel delivers decomposed granite in Sherman, Denison and throughout Grayson County. Call ' . $spCall . ' with the street address and the square footage of the path or patio, and the cost and drop-off day are worked out during that conversation.'],
    ['q' => 'Is decomposed granite sold per ton or per cubic yard?',
     'a' => 'HARDROCK Sand and Gravel quotes decomposed granite by phone rather than listing a rate online, because quantity and distance both change the total. Run the patio numbers above first, then ring ' . $spCall . ' and ask which unit the quote is in.'],
    ['q' => 'Will a decomposed granite path wash out in heavy rain?',
     'a' => 'A well-built DG path with edging, a compacted base and a slight cross slope handles ordinary rain. Fast runoff crossing the path is what carries the fine grit away, so send gutter water and uphill drainage around it, and top-dress any thin spots after a big spring storm.'],
];

$pageSchemas = [
    ['@context' => 'https://schema.org', '@graph' => [
        array_diff_key(generateServiceSchema($svc), ['@context' => 1]) + ['image' => $siteUrl . '/assets/images/crushed-red-granite-closeup.jpg'],
        array_diff_key(sp_breadcrumb_schema($svc['name'], 'decomposed-granite'), ['@context' => 1]),
        array_diff_key(generateFAQSchema($faqs), ['@context' => 1]),
    ]],
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style>
/* ==========================================================================
   /services/decomposed-granite/ — page-specific composition
   Signature: a CSS-only path cross-section (edging | DG | base | fabric | clay) on the dark build-up band.
   ========================================================================== */
.dg-hero .hero-bg img { object-position: 50% 50%; }

/* Cross-section: edging posts either side of a stacked layer column */
.dg-xsec__grid { display: grid; grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr); gap: var(--space-3xl); align-items: start; }
.dg-xsec__copy { display: grid; gap: var(--space-md); }
.dg-xsec .answer-block { background: color-mix(in srgb, var(--color-white) 7%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.dg-stack { display: grid; grid-template-columns: var(--space-md) 1fr var(--space-md); margin: var(--space-md) 0 0; border-radius: var(--radius-sm); overflow: hidden; box-shadow: var(--shadow-lg); }
.dg-stack__edge { grid-column: 1; grid-row: 1 / 3; background: linear-gradient(to bottom, color-mix(in srgb, var(--color-secondary) 80%, var(--color-white)), var(--color-secondary)); }
.dg-stack__edge--r { grid-column: 3; }
.dg-layer { grid-column: 2; display: flex; justify-content: space-between; align-items: center; gap: var(--space-sm); padding: var(--space-md) var(--space-lg); font-size: var(--fs-small); }
.dg-layer b { font-family: var(--font-accent); text-transform: uppercase; letter-spacing: .08em; }
.dg-layer span { font-family: var(--font-accent); white-space: nowrap; }
.dg-layer--dg { min-height: 4.5rem; color: var(--color-ink);
  background: radial-gradient(circle, color-mix(in srgb, var(--color-accent) 45%, transparent) 0 18%, transparent 22%) 0 0 / var(--space-xs) var(--space-xs),
              radial-gradient(circle, color-mix(in srgb, var(--color-primary) 22%, transparent) 0 16%, transparent 20%) var(--space-1) var(--space-1) / var(--space-sm) var(--space-sm),
              color-mix(in srgb, var(--color-accent) 22%, var(--color-paper)); }
.dg-layer--base { min-height: 5.5rem; color: var(--color-white);
  background: radial-gradient(circle, color-mix(in srgb, var(--color-white) 30%, transparent) 0 28%, transparent 32%) 0 0 / var(--space-md) var(--space-md),
              radial-gradient(circle, color-mix(in srgb, var(--color-dark) 40%, transparent) 0 22%, transparent 26%) var(--space-xs) var(--space-xs) / var(--space-lg) var(--space-lg),
              color-mix(in srgb, var(--color-secondary) 75%, var(--color-dark)); }
.dg-layer--fabric { grid-column: 1 / -1; min-height: 0; padding: var(--space-xs) var(--space-lg); color: color-mix(in srgb, var(--color-white) 85%, transparent);
  background: repeating-linear-gradient(90deg, var(--color-dark) 0 var(--space-sm), color-mix(in srgb, var(--color-dark) 70%, var(--color-white)) var(--space-sm) var(--space-md)); }
.dg-layer--clay { grid-column: 1 / -1; min-height: 4.5rem; color: var(--color-white);
  background: repeating-linear-gradient(-45deg, color-mix(in srgb, var(--color-accent-dark) 70%, var(--color-dark)) 0 var(--space-xs), color-mix(in srgb, var(--color-accent-dark) 55%, var(--color-dark)) var(--space-xs) var(--space-md)); }
.dg-stack__cap { grid-column: 1 / -1; padding: var(--space-xs) var(--space-lg); font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 75%, transparent); background: var(--color-dark); }
.dg-xsec .sp-steps { margin-top: var(--space-md); }
.dg-note { padding: var(--space-md) var(--space-lg); border-left: var(--space-1) solid var(--color-accent-bright); background: color-mix(in srgb, var(--color-white) 6%, transparent); border-radius: 0 var(--radius-sm) var(--radius-sm) 0; }
.dg-proof { background: var(--color-surface); }
.dg-proof .sp-proof__single figure { outline: 2px solid var(--color-accent); outline-offset: var(--space-xs); }
@media (max-width: 900px) { .dg-xsec__grid { grid-template-columns: 1fr; gap: var(--space-2xl); } }
@media (max-width: 480px) { .dg-layer { flex-direction: column; align-items: flex-start; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero dg-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Close-up of crushed red granite chips', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo sp_breadcrumb($svc['name']); ?>
    <div class="hero-grid hero-grid--form">
      <div class="hero-text hero-copy">
        <span class="eyebrow">Decomposed granite · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
        <h1 class="hero-title" id="sp-hero-title"><span class="text-accent">Decomposed Granite</span> in Sherman, TX</h1>
        <p class="hero-answer">HARDROCK Sand and Gravel supplies and delivers decomposed granite to homeowners and landscapers in Sherman, Denison and across Grayson County. DG is granite weathered down to small chips and fine grit, and once it is dampened and compacted it sets into a firm, earth-toned floor for garden paths, patios and xeriscape beds.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('layers', 16); ?>Paths, patios, xeriscape</li>
          <li><?php echo icon('truck', 16); ?>Grayson County delivery</li>
          <li><?php echo icon('calendar', 16); ?>In business since 2019</li>
        </ul>
      </div>

      <aside class="hero-form-card" id="estimate-form">
        <h2>Want a price on decomposed granite?</h2>
        <p class="hero-form-tagline">Give us the square footage and address. HARDROCK phones back with a price.</p>
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

<!-- ============ COMPARISON (leads on this page) ============ -->
<section class="section sp-compare dg-compare" aria-labelledby="dg-compare-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Firm or loose</span>
      <h2 id="dg-compare-title">Why choose <span class="text-accent">decomposed granite</span> over pea gravel for a path?</h2>
      <p class="answer-block">Decomposed granite makes a firmer path than pea gravel, because its blend of fine grit and small chips binds together once it is wetted and rolled. Pea gravel never binds; it stays loose and rolls. That difference makes DG easier going for wheelbarrows, strollers, patio chairs and anyone a little unsteady on their feet.</p>
    </div>
    <div class="sp-table-wrap reveal-up">
      <table class="sp-table">
        <caption>HARDROCK delivers all four. Ask on the phone what is available for your job.</caption>
        <thead>
          <tr><th scope="col">Material</th><th scope="col">What it is made of</th><th scope="col">After compaction</th><th scope="col">How water behaves</th><th scope="col">Good for</th></tr>
        </thead>
        <tbody>
          <tr class="is-this"><th scope="row">Decomposed granite</th><td>Granite chips, grit and dust</td><td>Binds into a firm, walkable surface</td><td>Some soaks in, the rest runs off; softens where water stands</td><td>Paths, patios, seating areas, xeriscape</td></tr>
          <tr><th scope="row">Pea gravel</th><td>Rounded stones about 3/8 inch, no fines</td><td>Stays loose; does not pack</td><td>Drains straight through</td><td>Play areas, dog runs, casual walkways</td></tr>
          <tr><th scope="row">Road base</th><td>Crushed rock with fines, coarser pieces</td><td>Compacts very hard</td><td>Sheds water when crowned</td><td>The layer under DG, drives and pads</td></tr>
          <tr><th scope="row">Mason sand</th><td>Fine, clean sand</td><td>Will not hold a walking surface alone</td><td>Drains through</td><td>Bedding flagstone and pavers, mortar</td></tr>
        </tbody>
      </table>
    </div>
    <p class="reveal-up">Most DG paths sit on a layer of <a href="/services/road-base/">crushed road base that compacts hard</a>, and flagstone set into a DG patio usually beds on <a href="/services/mason-sand/">mason sand for flagstone and pavers</a>. Both come from the same supplier as the DG.</p>
  </div>
</section>

<!-- ============ WHERE IT WORKS ============ -->
<section class="section sp-problem dg-uses edge-wave-top" aria-labelledby="dg-uses-title">
  <div class="container">
    <div class="sp-problem__grid">
      <div class="sp-problem__lead reveal-left">
        <span class="eyebrow">Where DG belongs</span>
        <h2 id="dg-uses-title">Where does decomposed granite hold up in a North Texas yard?</h2>
        <p class="answer-block">Decomposed granite holds up best on level ground with foot traffic but no standing water, such as garden paths, patios and xeriscape beds. Under shade trees and around fire pits it gives a clean, earth-toned floor, and in a hot Grayson County summer it shrinks the stretch of lawn that needs watering.</p>
        <p class="pull-quote">DG asks for three things: a firm base, a little fall to shed rain and a few passes with a roller.</p>
      </div>
      <ul class="sp-signs">
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('route', 22); ?><b>Garden paths</b><span>A compacted DG path stays smooth enough for a loaded wheelbarrow and does not scatter into the flower beds the way loose stone tends to.</span></li>
        <li class="sp-sign reveal-up reveal-delay-2"><?php echo icon('flame', 22); ?><b>Patios and fire pits</b><span>Chairs sit level on packed DG, and around a fire pit it gives a mineral floor that will not catch a stray ember the way dry turf can.</span></li>
        <li class="sp-sign reveal-up reveal-delay-3"><?php echo icon('sun', 22); ?><b>Xeriscape beds</b><span>Spread between native and drought-hardy plants, DG replaces thirsty grass and keeps a tidy look through a dry August.</span></li>
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('droplets', 22); ?><b>Low spots: fix first</b><span>Where rain collects, DG turns soft and washes. Solve the drainage before laying it, or use a coarse drain rock in that one spot.</span></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ SIGNATURE: CROSS-SECTION ============ -->
<section class="section on-dark texture-grain slant-top dg-xsec" aria-labelledby="dg-xsec-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="dg-xsec__grid">
      <div class="dg-xsec__copy reveal-left">
        <span class="eyebrow">The build-up</span>
        <h2 id="dg-xsec-title">What goes under a decomposed granite path on Grayson County clay?</h2>
        <p class="answer-block">Under a decomposed granite path on Grayson County clay, a compacted layer of crushed base does most of the work. Local clay swells when it is wet and shrinks and cracks as it dries, so DG laid straight on top tends to rut and hold puddles. A base layer and solid edging keep the surface flat.</p>
        <div class="dg-stack" role="img" aria-label="Cross-section of a decomposed granite path: edging on both sides, about 2 to 3 inches of compacted decomposed granite over about 3 to 4 inches of compacted crushed base, optional fabric, then native clay shaped to drain">
          <span class="dg-stack__edge" aria-hidden="true"></span>
          <div class="dg-layer dg-layer--dg"><b>Decomposed granite</b><span>2–3 in. compacted</span></div>
          <div class="dg-layer dg-layer--base"><b>Crushed road base</b><span>3–4 in. compacted</span></div>
          <div class="dg-layer dg-layer--fabric"><b>Fabric (optional)</b></div>
          <span class="dg-stack__edge dg-stack__edge--r" aria-hidden="true"></span>
          <div class="dg-layer dg-layer--clay"><b>Native clay</b><span>Shaped to drain</span></div>
          <p class="dg-stack__cap">Typical build-up for a foot path. Paths that carry a mower or cart need a thicker base.</p>
        </div>
      </div>
      <div class="reveal-right">
        <ol class="sp-steps">
          <li><b>Dig out and shape</b><span>Remove grass and roots to the depth of both layers, and give the path a slight cross slope so rain runs off one side.</span></li>
          <li><b>Set the edging</b><span>Steel, stone or timber edging goes in before any material, so the layers have walls to compact against.</span></li>
          <li><b>Compact the base</b><span>Spread the crushed base, dampen it and run a plate compactor or roller until it no longer shows footprints.</span></li>
          <li><b>Lay DG in thin lifts</b><span>Add the DG an inch or so at a time, mist it and compact each lift. Thin passes pack far tighter than one deep layer.</span></li>
        </ol>
        <p class="dg-note">These are the usual steps for whoever builds the path; HARDROCK supplies both the decomposed granite and the road base. Some DG is sold "stabilized," with a binder mixed in that hardens it further and cuts down on washing and tracking. Ask HARDROCK which kind is available when you call.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ QUANTITY ============ -->
<section class="section sp-math edge-curve-top" aria-labelledby="dg-math-title">
  <div class="container">
    <div class="sp-math__grid">
      <div class="reveal-left">
        <span class="eyebrow">Order the right amount</span>
        <h2 id="dg-math-title">How much decomposed granite does a patio take?</h2>
        <p class="answer-block">A 12 by 14 foot patio laid with 3 inches of decomposed granite takes about 1.6 cubic yards. Multiply length by width by depth in feet and divide by 27, then order a little extra, because DG loses some height as it is compacted. HARDROCK runs the figure with you on the phone before anything is ordered.</p>
        <p>The base underneath is figured the same way. The same 12 by 14 patio with 4 inches of crushed road base needs 56 cubic feet, a little over 2 cubic yards, so this patio calls for nearly four cubic yards of material in total, not one and a half.</p>
      </div>
      <div class="sp-math__card reveal-right">
        <p class="sp-math__formula">Length × Width × Depth <em>÷ 27</em></p>
        <dl class="sp-math__rows">
          <div><dt>Patio length</dt><dd>14 ft</dd></div>
          <div><dt>Patio width</dt><dd>12 ft</dd></div>
          <div><dt>DG depth</dt><dd>0.25 ft (3 in)</dd></div>
          <div><dt>DG needed</dt><dd>≈ 1.6 yd³</dd></div>
        </dl>
        <p>14 × 12 × 0.25 = 42 cubic feet. 42 ÷ 27 = 1.56 cubic yards, before the compaction allowance.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ PROOF ============ -->
<section class="section sp-proof dg-proof" aria-labelledby="dg-proof-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Recent work</span>
      <h2 id="dg-proof-title">What do HARDROCK customers around Sherman say?</h2>
      <p class="answer-block">HARDROCK Sand and Gravel customers post their reviews on Google, and the most recent are shown below. Beside them is a flagstone patio from HARDROCK's photo collection: stone set with fine tan material in the joints around a square fire pit, the kind of outdoor floor that DG and mason sand go into.</p>
    </div>
    <div class="sp-proof__single">
      <figure class="reveal-left">
        <?php echo pictureTag('flagstone-patio-fire-pit', 'Flagstone patio around a square stone fire pit, joints filled with fine tan material, fence behind', '(max-width: 900px) 100vw, 640px'); ?>
        <figcaption>A flagstone patio set in fine gravel, with a square stone fire pit.</figcaption>
      </figure>
      <div class="reveal-right">
        <p>HARDROCK has been in business since 2019 under owner Dean Jones, and it covers Sherman, Denison and the rest of Grayson County with eight bulk materials plus driveways, house pads, ponds and land clearing. Every one of them is listed on <a href="/services/">the HARDROCK services overview</a>.</p>
      </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
    echo p1_google_reviews($slug, ['heading' => 'HARDROCK on Google: Grayson County reviews', 'heading_tag' => 'h3', 'limit' => 6]); ?>
    <div class="sp-proof__foot">
      <a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain slant-top sp-faq" id="faq" aria-labelledby="dg-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="dg-faq-title">What should you know before ordering decomposed granite?</h2>
      <p>Three decomposed granite questions come up most with HARDROCK Sand and Gravel: whether the load can come to a given address, which unit the price is quoted in, and how a finished DG path stands up to a North Texas downpour.</p>
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
<?php echo sp_related_section(['pea-gravel', 'mason-sand', 'road-base'],
    'What else goes into a <span class="text-accent">decomposed granite</span> path or patio?',
    'A DG project usually needs more than the DG itself. HARDROCK Sand and Gravel delivers the crushed road base that goes underneath, mason sand for bedding flagstone and pavers, and pea gravel for the looser play areas and dog runs next to the patio, all from one Sherman supplier.'); ?>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Need decomposed granite for a path or patio?',
    'Send the form or call HARDROCK Sand and Gravel with the square footage and the address. Fridays and Saturdays start at 9 AM; the rest of the working week starts at 6 AM.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
