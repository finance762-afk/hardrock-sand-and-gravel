<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/area-page.php';
?>
<?php
/* ==========================================================================
   CONTENT DECK SOURCES — Grayson County (researched 2026-10-15)
   - https://en.wikipedia.org/wiki/Grayson_County,_Texas  (979 sq mi total, 933 land; created 1846; seat Sherman; Red River and Lake Texoma on
     the north; borders Fannin, Collin, Denton, Cooke counties and Oklahoma; cities Bells, Denison, Dorchester, Gunter, Knollwood, Pottsboro,
     Sadler, Sherman, Southmayd, Trenton, Van Alstyne, Whitesboro; towns Collinsville, Howe, Tioga, Tom Bean, Whitewright)
   - https://www.tshaonline.org/handbook/entries/grayson-county  (elevation 600-800 ft, generally level with some low hills; north = acidic
     Post Oak Belt soils with loamy or sandy surfaces, drains to Lake Texoma and the Red River; south = blackland soils, drains to Trinity
     tributaries; drained principally by Choctaw Creek and its tributaries Post Oak and Iron Ore creeks; average annual precipitation 37 in;
     growing season ~227 days; natural resources include limestone, oil and gas, bituminous coal, and sand and gravel)
   - ELEVATION: Texas Almanac lists 500-930 ft for the county; the Handbook says 600-800 ft. Sources conflict, so the page says roughly 600 to 800 ft.
   - https://www.co.grayson.tx.us/page/hist.home  (blackland prairie "a dominant feature for much of the county"; Woodbine-formation sandy soil
     "very pronounced" in the western section; Cross Timbers on the west side)
   - https://phzmapi.org/75076.json (Pottsboro) and /75495.json (Van Alstyne): 2023 USDA zone 8a (same as Sherman 75090 and Denison 75020).
   Unverifiable names dropped: Lake Randell is a real lake per the Texas Almanac but not described, so it is left out; no town is assigned to a soil belt;
   Trenton (mostly Fannin County) is left out of the community list. No frequency claims about past work; delivery radius beyond the county is
   unconfirmed in content-confirmations.json, so the page tells outside-county callers to ask.
   ========================================================================== */

/* ---- Page setup ------------------------------------------------------------------------------- */
$apSlug          = 'grayson-county';
$apRow           = ap_area($apSlug);
$pageTitle       = 'Sand and Gravel Delivery in Grayson County, TX | HARDROCK';
$pageDescription = 'Hardrock Sand And Gravel delivers gravel, sand, rock and fill dirt across Grayson County, TX, plus driveways, ponds and land clearing. Call ' . formatPhone($phone) . '.';
$canonicalUrl    = $siteUrl . ap_url($apSlug);
$ogImage         = '/assets/images/' . $apRow['photo'] . '.jpg';
$currentPage     = 'areas';
$pageType        = 'city';
$citySlug        = $apSlug;
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = $apRow['photo'];
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

$faqs = [
    ['q' => 'Does HARDROCK deliver sand and gravel outside Sherman and Denison?',
     'a' => 'Hardrock Sand And Gravel serves Grayson County beyond its Sherman base, including the small towns and rural roads between Sherman, Denison and the county lines. Call ' . $spCall . ' with the address; if it sits outside the county, ask before you plan the job around it.'],
    ['q' => 'What gravel should I use for a long rural driveway in Grayson County?',
     'a' => 'A common build is road base as the compacted lower layer and 57 rock as the top course, which drains and grips. Soft clay, sandy ground and long culvert crossings each change the details, so describe the lane and any wet spots when you call ' . $spCall . '.'],
    ['q' => 'Can HARDROCK clear land and dig a pond on acreage?',
     'a' => 'Yes. Hardrock Sand And Gravel lists land clearing, pond digging, driveways and house pads next to its bulk materials. Clearing opens the ground, the pond or pad is shaped on it, and the same business delivers the rock and fill for the finish.'],
];
$pageSchemas = [ap_schema($apSlug, $pageTitle, $pageDescription, [
    'name' => 'Grayson County', 'type' => 'AdministrativeArea', 'sameAs' => 'https://en.wikipedia.org/wiki/Grayson_County,_Texas',
], $siteUrl . $ogImage)];
/* FAQPage mirrors the visible FAQ below (AI comprehension aid only) */
$pageSchemas[0]['@graph'][] = array_diff_key(generateFAQSchema($faqs), ['@context' => 1]);

/* Communities in the county (Wikipedia list). Plain text: only Sherman and Denison have their own page. */
$gcTowns = ['Bells', 'Collinsville', 'Dorchester', 'Gunter', 'Howe', 'Knollwood', 'Pottsboro', 'Sadler', 'Southmayd', 'Tioga', 'Tom Bean', 'Van Alstyne', 'Whitesboro', 'Whitewright'];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/area-page.css'; ?></style>
<style>
/* ==========================================================================
   /service-areas/grayson-county/ — page-specific composition
   Signature: three "ground belts" (west / north / south) as tall cards, each ending in what that ground means for the order.
   ========================================================================== */
.gc-hero .hero-bg img { object-position: 50% 60%; }

.gc-acre { background: var(--color-paper); }
.gc-acre__grid { display: grid; grid-template-columns: minmax(0, 1.3fr) minmax(0, 1fr); gap: var(--space-3xl); align-items: center; }
.gc-acre__copy { display: grid; gap: var(--space-md); }
.gc-acre__copy > p { margin: 0; color: var(--color-ink-2); max-width: var(--measure); }
.gc-photo { margin: 0; position: relative; justify-self: center; max-width: 22rem; }
.gc-photo::before { content: ""; position: absolute; inset: var(--space-lg) calc(-1 * var(--space-lg)) calc(-1 * var(--space-lg)) var(--space-lg); border: 2px solid var(--color-accent); border-radius: var(--radius-sm); z-index: 0; }
.gc-photo picture { position: relative; z-index: 1; display: block; aspect-ratio: 3 / 4; overflow: hidden; box-shadow: var(--shadow-lg); clip-path: polygon(0 0, 88% 0, 100% 10%, 100% 100%, 0 100%); }
.gc-photo img { width: 100%; height: 100%; object-fit: cover; }
.gc-photo figcaption { position: relative; z-index: 1; margin-top: var(--space-sm); font-size: var(--fs-small); color: var(--color-muted); }

.gc-belts__intro { display: grid; gap: var(--space-md); max-width: 62ch; margin-bottom: var(--space-2xl); }
.gc-belts__intro > p { margin: 0; }
.gc-belts .answer-block { background: color-mix(in srgb, var(--color-white) 7%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.gc-belts__grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-md); margin: 0; padding: 0; list-style: none; }
.gc-belt { display: grid; grid-template-rows: auto auto 1fr auto; gap: var(--space-sm); padding: var(--space-lg); border-radius: var(--radius-sm); background: color-mix(in srgb, var(--color-white) 6%, transparent); border: 1px solid color-mix(in srgb, var(--color-white) 14%, transparent); border-top: var(--space-1) solid var(--color-accent-bright); }
.gc-belt em { font-style: normal; font-family: var(--font-accent); text-transform: uppercase; letter-spacing: .14em; font-size: var(--fs-small); color: var(--color-accent-bright); }
.gc-belt b { font-family: var(--font-heading); font-size: 1.35rem; text-transform: uppercase; letter-spacing: .02em; color: var(--color-white); }
.gc-belt span { font-size: .95rem; color: color-mix(in srgb, var(--color-white) 80%, transparent); }
.gc-belt strong { display: block; padding-top: var(--space-sm); border-top: 1px dashed color-mix(in srgb, var(--color-white) 22%, transparent); font-weight: 500; font-size: var(--fs-small); color: var(--color-white); }
.gc-belt strong a { color: var(--color-accent-bright); text-decoration: underline; text-underline-offset: .18em; }
.gc-belts__note { margin: var(--space-lg) 0 0; max-width: 62ch; font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 70%, transparent); }

.gc-towns { background: var(--color-surface); }
.gc-towns__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.2fr); gap: var(--space-2xl); align-items: start; }
.gc-towns__copy { display: grid; gap: var(--space-md); }
.gc-towns__copy > p { margin: 0; color: var(--color-ink-2); }
.gc-towns__list { display: flex; flex-wrap: wrap; gap: var(--space-xs); margin: 0; padding: 0; list-style: none; }
.gc-towns__list li { padding: var(--space-xs) var(--space-md); border-radius: var(--radius-full); background: var(--color-card-tint-1); border: 1px solid var(--color-line); font-weight: 600; font-size: var(--fs-small); color: var(--color-ink); }
.gc-towns__list li.is-link { background: var(--color-card-tint-3); }
.gc-towns__list li.is-link a { color: var(--color-accent-dark); text-decoration: underline; text-underline-offset: .18em; }
@media (max-width: 900px) { .gc-acre__grid, .gc-towns__grid { grid-template-columns: 1fr; gap: var(--space-2xl); } .gc-belts__grid { grid-template-columns: 1fr; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero gc-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, $apRow['alt'], '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo ap_breadcrumb('Grayson County'); ?>
    <div class="hero-grid hero-grid--form">
      <div class="hero-text hero-copy">
        <span class="eyebrow">Acreage across 979 square miles</span>
        <h1 class="hero-title" id="sp-hero-title">Sand, Gravel and Site Work in <span class="text-accent">Grayson County</span>, TX</h1>
        <p class="hero-answer">Hardrock Sand And Gravel serves Grayson County, Texas from Sherman with bulk gravel, sand, rock and fill dirt, plus driveways, pads, ponds and land clearing for rural lots.</p>
        <div class="hero-actions btn-group">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('trees', 16); ?>Land clearing</li>
          <li><?php echo icon('route', 16); ?>Rural drives</li>
          <li><?php echo icon('phone', 16); ?>Priced by phone</li>
        </ul>
      </div>
      <aside class="hero-form-card" id="estimate-form">
        <h2>Free estimate in Grayson County</h2>
        <p class="hero-form-tagline">Name the material and the address. HARDROCK calls back with a price.</p>
        <form action="<?php echo esc($formAction); ?>" method="POST" class="hero-form">
          <?php echo p1_lead_hidden_fields('hero'); ?>
          <?php /* p1_lead_hidden_fields() echoes p1_attribution_fields('hero') */ ?>
          <div class="form-row"><label class="sr-only" for="hero-name">Name</label><input id="hero-name" type="text" name="name" placeholder="Name" autocomplete="name" required></div>
          <div class="form-row"><label class="sr-only" for="hero-phone">Phone</label><input id="hero-phone" type="tel" name="phone" placeholder="Phone" autocomplete="tel" inputmode="tel" required></div>
          <div class="form-row"><label class="sr-only" for="hero-email">Email</label><input id="hero-email" type="email" name="email" placeholder="Email" autocomplete="email" required></div>
          <div class="form-row"><label class="sr-only" for="hero-service">Service</label><select id="hero-service" name="service"><?php echo p1_service_options('Land clearing'); ?></select></div>
          <?php echo p1_consent_row('hero'); ?>
          <button type="submit" class="btn btn-primary btn-block">Get my free estimate</button>
        </form>
      </aside>
    </div>
  </div>
</section>

<article class="sp-article" aria-labelledby="sp-hero-title">

<!-- ============ WHO SERVES THE COUNTY (distance / acreage angle) ============ -->
<section class="section gc-acre" aria-labelledby="gc-acre-title">
  <div class="container">
    <div class="gc-acre__grid">
      <div class="gc-acre__copy reveal-left">
        <span class="eyebrow">Grayson County, Texas</span>
        <h2 id="gc-acre-title">Who delivers sand and gravel across Grayson County, TX?</h2>
        <p class="answer-block">Hardrock Sand And Gravel, a Sherman, TX supplier in business since 2016, delivers pea gravel, road base, 57 and 67 rock, fill dirt, mason sand, decomposed granite, river rock and rip rap across Grayson County, and also does driveway, pad, pond and land clearing work. Call <?php echo esc($spCall); ?> with the address and HARDROCK prices the load by phone.</p>
        <p>Grayson County covers 979 square miles, 933 of them land, with the Red River and Lake Texoma along its north edge and Collin County to the south. Distance is the first thing that sets a county order apart from an in-town one: a rural lane can be a mile of gravel, a gate can be a quarter-mile from the pavement, and the address may not turn up on a map. Sherman, the county seat, and Denison have their own pages, and this one covers everything between and around them.</p>
        <p>Anyone searching for sand and gravel near me in Grayson County is usually weighing a haul. Tell HARDROCK where the nearest paved road is, how long the lane runs and whether a loaded dump truck can turn around, and the call settles whether the load goes to the gate or to a staging spot. The Handbook of Texas lists sand and gravel among the county's own natural resources, alongside limestone.</p>
        <p>County weather matters to a gravel lane. The Handbook puts average rainfall near 37 inches a year with a growing season of about 227 days, and a rural road that is dry in August can be soft in March. HARDROCK's <a href="/services/delivery/">delivery page</a> explains what happens after the call.</p>
      </div>
      <figure class="gc-photo reveal-right">
        <?php echo pictureTag('gravel-driveway-rural', 'New tan gravel drive running across open pasture, with a green tractor at the left edge and fence posts in the distance', '(max-width: 900px) 90vw, 352px'); ?>
        <figcaption>A new gravel drive across open pasture, the kind of rural lane the road base and rock pages cover.</figcaption>
      </figure>
    </div>
  </div>
</section>

<!-- ============ SIGNATURE: THREE GROUND BELTS ============ -->
<section class="section on-dark texture-grain slant-top gc-belts" aria-labelledby="gc-belts-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="gc-belts__intro reveal-up">
      <span class="eyebrow">Ground conditions</span>
      <h2 id="gc-belts-title">What kind of ground is your Grayson County lot on?</h2>
      <p class="answer-block">Grayson County has three kinds of ground: sandy Woodbine soils and Cross Timbers woods on the west, loamy or sandy Post Oak Belt soils in the north that drain to Lake Texoma and the Red River, and blackland prairie clay across the south. The kind under your lot changes which gravel layer, how much of it, and what to plan for after a wet week.</p>
      <p>Elevation runs roughly 600 to 800 feet on mostly level ground with low hills, and Choctaw Creek with its tributaries Post Oak and Iron Ore creeks drains the county principally. Soils change from one lot to the next, so treat the cards below as a starting question, not a soil report.</p>
    </div>
    <ul class="gc-belts__grid">
      <li class="gc-belt reveal-left"><em>West</em><b>Sandy and wooded</b><span>The county's own history calls the Woodbine-formation sandy soil in the western section "very pronounced," and the Cross Timbers woodland has been influential since the early days. Trees and brush are likely the first job on wooded ground here.</span><strong>Plan for: clearing first, then a base. See <a href="/services/land-clearing/">land clearing</a> and <a href="/services/driveways/">driveways</a>.</strong></li>
      <li class="gc-belt reveal-up reveal-delay-1"><em>North</em><b>Loamy, sandy, wet edge</b><span>The Handbook of Texas describes the north as acidic Post Oak Belt soils with loamy or sandy surfaces, draining to Lake Texoma and the Red River. Loose surface soil moves with runoff on a slope or ditch.</span><strong>Plan for: bank and drainage rock. See <a href="/services/rip-rap/">rip rap</a> and <a href="/services/ponds/">ponds</a>.</strong></li>
      <li class="gc-belt reveal-right"><em>South</em><b>Blackland prairie</b><span>Blackland prairie is a dominant feature of much of the county, and the Handbook ties the southern end to blackland soils draining toward Trinity River tributaries. Clay like this swells wet and shrinks dry.</span><strong>Plan for: a compacted base under anything heavy. See <a href="/services/road-base/">road base</a> and <a href="/services/fill-dirt/">fill dirt</a>.</strong></li>
    </ul>
    <p class="gc-belts__note">Sources: Handbook of Texas, Grayson County entry, and the Grayson County history page. Where the two describe soils differently, both are shown.</p>
  </div>
</section>

<!-- ============ COMMUNITIES ============ -->
<section class="section gc-towns edge-curve-top" aria-labelledby="gc-towns-title">
  <div class="container">
    <div class="gc-towns__grid">
      <div class="gc-towns__copy reveal-left">
        <span class="eyebrow">Across the county</span>
        <h2 id="gc-towns-title">Which Grayson County towns does HARDROCK serve?</h2>
        <p class="answer-block">Hardrock Sand And Gravel serves Grayson County from its Sherman base, including Sherman, Denison and the smaller towns listed here. Call <?php echo esc($spCall); ?> to confirm a specific address, since the exact delivery edge depends on the load and the road.</p>
        <p>The list follows the county's own towns and cities. Part of Van Alstyne lies in Collin County and part of Whitewright in Fannin County, so give the street address, not just the town. USDA's 2023 hardiness map puts the ZIP codes for Sherman, Denison, Pottsboro and Van Alstyne all in zone 8a.</p>
      </div>
      <ul class="gc-towns__list reveal-right" aria-label="Grayson County communities">
        <li class="is-link"><a href="<?php echo esc(areaUrl('sherman')); ?>">Sherman</a></li>
        <li class="is-link"><a href="<?php echo esc(areaUrl('denison')); ?>">Denison</a></li>
        <?php foreach ($gcTowns as $gcTown): ?><li><?php echo esc($gcTown); ?></li><?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<!-- ============ SERVICES AVAILABLE ============ -->
<section class="section ap-svc" aria-labelledby="gc-svc-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Available across the county</span>
      <h2 id="gc-svc-title">What does HARDROCK do on Grayson County acreage?</h2>
      <p class="answer-block">Hardrock Sand And Gravel clears brush and trees from rural lots, digs and shapes ponds, builds gravel driveways and house pads, and delivers eight bulk materials to the finished site. The six below suit acreage best; the other materials are listed underneath with their own pages.</p>
    </div>
    <?php echo ap_service_list(['land-clearing', 'ponds', 'driveways', 'delivery', 'fill-dirt', 'rip-rap'], 'Grayson County'); ?>
  </div>
</section>

<!-- ============ WHY HARDROCK ============ -->
<section class="section ap-why edge-wave-top" aria-labelledby="gc-why-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Why HARDROCK</span>
      <h2 id="gc-why-title">Why use one business for clearing, dirt and rock?</h2>
      <p>Hardrock Sand And Gravel lists both site work and bulk material, so an acreage job can run on one phone number. The four facts below come from the business's own details.</p>
    </div>
    <ul class="ap-why__grid">
      <li class="reveal-up reveal-delay-1"><?php echo icon('trees', 24); ?><b>Clear, shape, finish</b><span>Land clearing, ponds, pads and drives are on the service list next to the gravel and fill that finish them.</span></li>
      <li class="reveal-up reveal-delay-2"><?php echo icon('map-pin', 24); ?><b>Sherman base, county reach</b><span>HARDROCK is based in Sherman, the county seat, and serves Sherman, Denison and Grayson County.</span></li>
      <li class="reveal-up reveal-delay-3"><?php echo icon('phone', 24); ?><b>Priced by phone</b><span>The load or job is priced on the call from the material, the amount and the address.</span></li>
      <li class="reveal-up reveal-delay-4"><?php echo icon('calendar', 24); ?><b>In business since <?php echo esc($yearEstablished); ?></b><span>Phones open 6:00 AM Monday to Thursday, 9:00 AM Friday and 9:00 AM to 2:00 PM Saturday.</span></li>
    </ul>
  </div>
</section>

<!-- ============ GOOGLE REVIEWS (Page One feed; renders nothing when the feed is empty) ============ -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
$gcReviews = p1_google_reviews($slug, ['heading' => 'What customers say about HARDROCK on Google', 'limit' => 6]);
if ($gcReviews !== ''): ?>
<section class="section sp-proof" aria-label="Google reviews"><div class="container"><?php echo $gcReviews; ?>
  <div class="sp-proof__foot"><a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a></div>
</div></section>
<?php endif; ?>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain slant-top sp-faq" id="faq" aria-labelledby="gc-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="gc-faq-title">What do rural Grayson County customers ask before ordering?</h2>
      <p>Rural orders raise three questions before any others: how far HARDROCK delivers, what gravel suits a long lane, and whether clearing and pond work come from the same business.</p>
    </div>
    <div class="faq-grid">
      <?php foreach ($faqs as $faqIdx => $faq): ?>
      <details class="faq reveal-up reveal-delay-<?php echo ($faqIdx % 2) + 1; ?>"<?php echo $faqIdx === 0 ? ' open' : ''; ?>>
        <summary><?php echo esc($faq['q']); ?></summary>
        <p><?php echo esc($faq['a']); ?></p>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</article>

<!-- ============ NEARBY AREAS ============ -->
<section class="ap-near" aria-labelledby="gc-near-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Also serving</span>
      <h2 id="gc-near-title">Where else does HARDROCK deliver in Grayson County?</h2>
      <p>Hardrock Sand And Gravel has dedicated pages for the county's two largest cities, Sherman and Denison. Use them for local roads, ground conditions and materials; the rest of the county is covered on this page and by phone.</p>
    </div>
    <?php echo ap_nearby($apSlug); ?>
  </div>
</section>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Get a Free Estimate in Grayson County',
    'Call Hardrock Sand And Gravel or send the form with your Grayson County address, the material or job and how far the lane or lot sits from the pavement. HARDROCK prices it by phone.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
