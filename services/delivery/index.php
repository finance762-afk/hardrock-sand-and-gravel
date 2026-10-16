<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$svc             = sp_service('delivery');
$pageTitle       = 'Gravel Delivery in Sherman, TX | HARDROCK Sand and Gravel';
$pageDescription = 'Bulk sand, gravel, rock and fill dirt delivered to homes, farms and job sites in Sherman, Denison and Grayson County, TX. Call HARDROCK at ' . formatPhone($phone) . '.';
$canonicalUrl    = $siteUrl . '/services/delivery/';
$ogImage         = '/assets/images/gravel-stockpiles-job-site.jpg';
$currentPage     = 'services';
$pageType        = 'service';
$serviceSlug     = 'delivery';
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = 'gravel-stockpiles-job-site';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* FAQ: research-brief questions this page can answer truthfully (delivery area, pricing unit) */
$faqs = [
    ['q' => 'Do you deliver to Sherman and the surrounding area?',
     'a' => 'Yes. HARDROCK Sand and Gravel delivers bulk material in Sherman, Denison and the rest of Grayson County. If the address sits outside the county, call ' . $spCall . ' and ask before you plan the job around it.'],
    ['q' => 'Do you sell delivered material by the ton or the cubic yard?',
     'a' => 'HARDROCK Sand and Gravel prices each delivery by phone, since the material, the amount and the distance all move the number. Work out your cubic yards with the formula on this page, then call ' . $spCall . ' for the current price and how that material is measured.'],
];

$pageSchemas = [
    ['@context' => 'https://schema.org', '@graph' => [
        array_diff_key(generateServiceSchema($svc), ['@context' => 1]) + ['image' => $siteUrl . '/assets/images/gravel-stockpiles-job-site.jpg'],
        array_diff_key(sp_breadcrumb_schema($svc['name'], 'delivery'), ['@context' => 1]),
        array_diff_key(generateFAQSchema($faqs), ['@context' => 1]),
    ]],
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style>
/* ==========================================================================
   /services/delivery/ — page-specific composition
   Signature: the drop-site checklist band, a numbered list strung on a dashed road-stripe spine.
   ========================================================================== */
.dl-hero .hero-bg img { object-position: 50% 62%; }
.dl-materials .sp-sign { border-top: var(--space-1) solid var(--color-accent); }
.dl-materials .sp-sign em { font-style: normal; font-family: var(--font-accent); text-transform: uppercase; letter-spacing: .1em; font-size: var(--fs-small); color: var(--color-accent-dark); }
.dl-materials .sp-problem__lead > p:not(.answer-block):not(.pull-quote) { margin: 0; color: var(--color-ink-2); }

.dl-drop__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.2fr); gap: var(--space-3xl); align-items: start; }
.dl-drop__lead { display: grid; gap: var(--space-md); }
.dl-drop__lead > p { margin: 0; }
.dl-drop .answer-block { background: color-mix(in srgb, var(--color-white) 7%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.dl-checks { counter-reset: dlcheck; position: relative; display: grid; gap: var(--space-md); margin: 0; padding: 0 0 0 calc(var(--space-2xl) + var(--space-xs)); list-style: none; }
.dl-checks::before { content: ""; position: absolute; top: var(--space-md); bottom: var(--space-md); left: var(--space-sm); width: var(--space-xs); border-radius: var(--radius-full);
  background: repeating-linear-gradient(to bottom, var(--color-accent-bright) 0 var(--space-lg), transparent var(--space-lg) var(--space-2xl)); }
.dl-checks li { counter-increment: dlcheck; position: relative; display: grid; gap: var(--space-1); padding: var(--space-md) var(--space-lg);
  border-radius: var(--radius-sm); background: color-mix(in srgb, var(--color-white) 6%, transparent); border: 1px solid color-mix(in srgb, var(--color-white) 12%, transparent); }
.dl-checks li::before { content: counter(dlcheck); position: absolute; left: calc(-1 * (var(--space-2xl) + var(--space-xs))); top: var(--space-md); display: grid; place-items: center;
  width: var(--space-xl); height: var(--space-xl); border-radius: 50%; background: var(--color-accent); color: var(--color-white);
  font-family: var(--font-accent); font-weight: 800; box-shadow: 0 0 0 var(--space-1) var(--color-dark); }
.dl-checks b { font-family: var(--font-heading); font-size: 1.1rem; text-transform: uppercase; letter-spacing: .03em; color: var(--color-white); }
.dl-checks span { font-size: .95rem; color: color-mix(in srgb, var(--color-white) 78%, transparent); }
.dl-proof .sp-proof__single figure picture { display: block; aspect-ratio: 16 / 10; }
.dl-proof .sp-proof__single figure img { width: 100%; height: 100%; object-fit: cover; }
@media (prefers-reduced-motion: no-preference) {
  .dl-checks li { transition: transform var(--transition), border-color var(--transition); }
  .dl-checks li:hover { transform: translateX(var(--space-1)); border-color: color-mix(in srgb, var(--color-accent-bright) 60%, transparent); }
}
.dl-proof .sp-proof__single { margin-bottom: var(--space-2xl); }
@media (max-width: 900px) { .dl-drop__grid { grid-template-columns: 1fr; gap: var(--space-2xl); } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero dl-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Rows of grey gravel piles dumped across a staked, graded site at sunset, with survey stakes and flags in front', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo sp_breadcrumb($svc['name']); ?>
    <div class="hero-grid hero-grid--form">
      <div class="hero-text hero-copy">
        <span class="eyebrow">Bulk delivery · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
        <h1 class="hero-title" id="sp-hero-title">Sand and Gravel <span class="text-accent">Delivery</span> in Sherman, TX</h1>
        <p class="hero-answer">HARDROCK Sand and Gravel delivers bulk pea gravel, decomposed granite, road base, 57 and 67 rock, fill dirt, mason sand, rip rap and river rock to homes, farms and job sites in Sherman, Denison and across Grayson County. Call or send the form with the address and the amount, and HARDROCK prices the load by phone.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('layers', 16); ?>8 bulk materials</li>
          <li><?php echo icon('truck', 16); ?>Homes, farms, job sites</li>
          <li><?php echo icon('phone', 16); ?>Priced by phone</li>
        </ul>
      </div>

      <aside class="hero-form-card" id="estimate-form">
        <h2>Want a price on a delivered load?</h2>
        <p class="hero-form-tagline">Name the material and the address. HARDROCK calls back with a price.</p>
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

<!-- ============ MATERIALS BY JOB ============ -->
<section class="section sp-problem dl-materials" aria-labelledby="dl-materials-title">
  <div class="container">
    <div class="sp-problem__grid">
      <div class="sp-problem__lead reveal-left">
        <span class="eyebrow">What's on the truck</span>
        <h2 id="dl-materials-title">Which bulk materials will HARDROCK deliver to your property?</h2>
        <p class="answer-block">HARDROCK Sand and Gravel delivers all eight of its bulk materials, from fine mason sand to large rip rap, to homes, farms and job sites. Most orders fit one of four jobs: building a base, changing grade, finishing a surface, or setting masonry and banks. Start with the job the material has to do, and the right material follows.</p>
        <p class="pull-quote">Order by what the material has to do, not by the name on the pile.</p>
        <p>Each material has its own page. For walkways and play areas, read about <a href="/services/pea-gravel/">pea gravel for paths, beds and play areas</a>. For a low corner of the yard, see <a href="/services/fill-dirt/">fill dirt for leveling and backfill</a>. For anything that carries tires, start with <a href="/services/road-base/">road base that packs firm under traffic</a>.</p>
      </div>
      <ul class="sp-signs">
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('milestone', 22); ?><b>Under tires and slabs</b><em>Road base · 57 and 67 rock</em><span>Road base packs into a firm layer under drives and parking areas. 57 and 67 rock drains freely as a driveway top course or in a French drain trench.</span></li>
        <li class="sp-sign reveal-up reveal-delay-2"><?php echo icon('tractor', 22); ?><b>Changing the grade</b><em>Fill dirt</em><span>Fill raises low corners, backfills trenches and retaining walls, and builds up ground where water stands after a storm.</span></li>
        <li class="sp-sign reveal-up reveal-delay-3"><?php echo icon('footprints', 22); ?><b>Finishing a surface</b><em>Pea gravel · DG · river rock</em><span>These three cover walkways, patios, play areas, landscape beds and dry creek beds, each with a different look and feel underfoot.</span></li>
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('hammer', 22); ?><b>Masonry and banks</b><em>Mason sand · rip rap</em><span>Mason sand goes into mortar and under pavers and flagstone. Rip rap armors pond banks, creek bends and culvert outlets against moving water.</span></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ ORDERING PROCESS ============ -->
<section class="section on-dark texture-grain slant-top sp-breakdown" aria-labelledby="dl-process-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="sp-breakdown__grid">
      <div class="reveal-left">
        <span class="eyebrow">How ordering works</span>
        <h2 id="dl-process-title">What happens after you call HARDROCK about a delivery?</h2>
        <p class="answer-block">After the call, HARDROCK checks the quantity, quotes the price and sets a delivery day, all by phone. Have three things ready: the delivery address, the material, and the size of the area in feet. If the size is a guess, HARDROCK works the cubic yards out with you before anything is loaded.</p>
        <ul class="sp-included">
          <li><?php echo icon('clock', 18); ?><span>Monday to Thursday: 6:00 AM to 5:00 PM</span></li>
          <li><?php echo icon('clock', 18); ?><span>Friday: 9:00 AM to 5:00 PM</span></li>
          <li><?php echo icon('clock', 18); ?><span>Saturday: 9:00 AM to 2:00 PM</span></li>
          <li><?php echo icon('x', 18); ?><span>Sunday: closed</span></li>
        </ul>
      </div>
      <ol class="sp-steps reveal-right">
        <li><b>Call or send the form</b><span>Give the address, the material and what it is for. A note on gate width or soft ground helps.</span></li>
        <li><b>Check the quantity</b><span>The area in feet becomes cubic yards, with a little extra for settling.</span></li>
        <li><b>Price and a day by phone</b><span>HARDROCK gives you the price and a delivery day over the phone.</span></li>
        <li><b>Load dropped</b><span>The material is dumped at the spot you marked, ready for a shovel, a tractor or a crew.</span></li>
      </ol>
    </div>
  </div>
</section>

<!-- ============ QUANTITY ============ -->
<section class="section sp-math edge-curve-top" aria-labelledby="dl-math-title">
  <div class="container">
    <div class="sp-math__grid">
      <div class="reveal-left">
        <span class="eyebrow">Size the order</span>
        <h2 id="dl-math-title">How many cubic yards should you order for delivery?</h2>
        <p class="answer-block">To size a delivery in cubic yards, multiply length by width by depth in feet, then divide by 27. A 16 by 20 foot play area covered 4 inches deep works out to about 4 cubic yards of pea gravel. Adding 5 to 10 percent for settling and spillage brings the order to roughly 4.2 to 4.4 cubic yards.</p>
        <p>Convert inches to feet before you multiply: 2 inches is 0.17 ft, 3 inches is 0.25 ft, 4 inches is 0.33 ft and 6 inches is 0.5 ft. Break an odd-shaped yard into rectangles, work each one out, and add them together before you call.</p>
      </div>
      <div class="sp-math__card reveal-right">
        <p class="sp-math__formula">Length × Width × Depth <em>÷ 27</em></p>
        <dl class="sp-math__rows">
          <div><dt>Length</dt><dd>20 ft</dd></div>
          <div><dt>Width</dt><dd>16 ft</dd></div>
          <div><dt>Depth</dt><dd>4 in (0.33 ft)</dd></div>
          <div><dt>Pea gravel</dt><dd>≈ 3.95 yd³</dd></div>
          <div><dt>With 10% extra</dt><dd>≈ 4.35 yd³</dd></div>
        </dl>
        <p>20 × 16 × 0.33 = 106.7 cubic feet. 106.7 ÷ 27 = 3.95 cubic yards.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ COMPARISON ============ -->
<section class="section sp-compare" aria-labelledby="dl-compare-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Bulk or bagged</span>
      <h2 id="dl-compare-title">Is bulk delivery worth it over bagged gravel from a store?</h2>
      <p class="answer-block">Bulk delivery starts to make sense once a job passes about one cubic yard, since a single yard equals 54 of the common half-cubic-foot bags. The 4-yard play area above would take about 216 bags from a store, or a long string of pickup trips, compared with bulk material dumped where you need it.</p>
    </div>
    <div class="sp-table-wrap reveal-up">
      <table class="sp-table">
        <caption>Bag counts assume the common 0.5 cubic foot bag; 27 cubic feet make one cubic yard. Pickup loads vary with the truck's payload rating.</caption>
        <thead>
          <tr><th scope="col">Option</th><th scope="col">How it arrives</th><th scope="col">For the 4-yard job</th><th scope="col">Best fit</th></tr>
        </thead>
        <tbody>
          <tr class="is-this"><th scope="row">Bulk delivery</th><td>Dumped loose at the spot you mark</td><td>Priced by HARDROCK over the phone, no loading on your end</td><td>Jobs of a yard or more: drives, pads, play areas, beds</td></tr>
          <tr><th scope="row">Bagged, from a store</th><td>Half-cubic-foot bags you load, haul and unload</td><td>About 216 bags, each lifted at least twice</td><td>Touch-ups and small beds under a yard</td></tr>
          <tr><th scope="row">Pickup truck trips</th><td>Loose, loaded and hauled by you</td><td>Around 8 trips; a half-ton pickup often carries only about half a yard of gravel within its payload</td><td>A small top-up close to home</td></tr>
        </tbody>
      </table>
    </div>
    <p class="reveal-up">Not sure which material the job needs? Every product HARDROCK carries is listed on <a href="/services/">HARDROCK's materials and services page</a>, each with its own uses and sizing notes.</p>
  </div>
</section>

<!-- ============ SIGNATURE: DROP-SITE CHECKLIST ============ -->
<section class="section on-dark texture-grain edge-torn-top dl-drop" aria-labelledby="dl-drop-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="dl-drop__grid">
      <div class="dl-drop__lead reveal-left">
        <span class="eyebrow">Before the truck arrives</span>
        <h2 id="dl-drop-title">Where should the delivery truck drop the load on your property?</h2>
        <p class="answer-block">The best drop spot is firm, level ground as close to the work as a loaded truck can safely reach. Mark it with a stake or flag, keep it clear of anything buried or overhead, and tell HARDROCK about gates, slopes or soft ground on the call.</p>
        <p>Grayson County's black clay is the usual trouble. After a wet week, ground around Sherman, Howe or Tom Bean can look dry on top and still give way under a heavy truck, so a gravel pad, a paved apron or a dry high spot makes a safer drop than open pasture.</p>
      </div>
      <ol class="dl-checks reveal-right">
        <li><b>Mark the spot</b><span>A stake, flag or cone shows exactly where the pile should go.</span></li>
        <li><b>Look up</b><span>A dump bed rises well above the cab when it tips. Keep the spot clear of power lines and low tree limbs.</span></li>
        <li><b>Look down</b><span>Keep loads off septic tanks and lateral lines, water meters, sprinkler heads and shallow pipes.</span></li>
        <li><b>Check the way in</b><span>Measure gates and the gaps between posts, trees or buildings along the route, and mention any culvert or ditch crossing.</span></li>
        <li><b>Watch the ground</b><span>Skip soft clay, fresh fill and the edge of a ditch. A loaded truck sinks where a pickup would roll right over.</span></li>
        <li><b>Protect the concrete</b><span>A pile dumped on a concrete drive is harder to shovel up cleanly; plywood or a tarp underneath makes cleanup easier.</span></li>
      </ol>
    </div>
  </div>
</section>

<!-- ============ PROOF ============ -->
<section class="section sp-proof dl-proof" aria-labelledby="dl-proof-title">
  <div class="container">
    <div class="sp-proof__single">
      <figure class="reveal-scale">
        <?php echo pictureTag('excavator-crushed-rock-pad', 'Yellow excavator beside a long pile of light grey crushed rock on a graded pad, with power lines overhead', '(max-width: 900px) 100vw, 620px'); ?>
        <figcaption>A long pile of crushed rock on a graded pad, with the excavator alongside.</figcaption>
      </figure>
      <div class="section-title reveal-up">
        <span class="eyebrow">Recent Work</span>
        <h2 id="dl-proof-title">What do HARDROCK's bulk loads look like on a job site?</h2>
        <p class="answer-block">HARDROCK's bulk loads in these photos sit on open, graded ground: rows of grey gravel piles across a staked site at the top of this page, and a long pile of light grey crushed rock beside an excavator here. Both piles sit on firm, level ground with room for equipment to work around them.</p>
      </div>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
    echo p1_google_reviews($slug, ['heading' => 'Reviews from HARDROCK customers on Google', 'heading_tag' => 'h3', 'limit' => 6]); ?>
    <div class="sp-proof__foot">
      <a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain slant-top sp-faq" id="faq" aria-labelledby="dl-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="dl-faq-title">What do customers ask before ordering a delivery?</h2>
      <p>Two questions come up on almost every HARDROCK delivery call: whether the truck reaches a particular address, and how the material on it is measured and priced. The short answers are below, and the full picture comes on the phone.</p>
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
<?php echo sp_related_section(['pea-gravel', 'road-base', 'fill-dirt'],
    'Which materials should you read up on <span class="text-accent">before ordering a delivery</span>?',
    'Three HARDROCK materials cover most of the delivery jobs around Sherman. Pea gravel finishes walkways, beds and play areas, road base packs into a firm layer under drives and parking, and fill dirt raises low ground and backfills trenches. Each page goes deeper on the uses and quantities for that one material.'); ?>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Need sand, gravel or dirt on the ground?',
    'Call HARDROCK Sand and Gravel or send the form with the address, the material and the size of the area. Mark the drop spot while you wait for the callback.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
