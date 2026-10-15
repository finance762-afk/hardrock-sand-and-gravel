<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/area-page.php';
?>
<?php
/* ==========================================================================
   CONTENT DECK SOURCES — Sherman (researched 2026-10-15)
   - https://en.wikipedia.org/wiki/Sherman,_Texas  (county seat; named for Gen. Sidney Sherman; 2020 census 43,645; Austin College
     founded 1849, moved to Sherman 1876; Old Settlers' Park; US 75 Sam Rayburn Fwy, US 82 Buck Owens Fwy, SH 56, SH 11, SH 91 Texoma
     Pkwy; ZIPs 75090-75092; Texas Instruments wafer fab near the southern city limits; Denison/Sherman city centers 11 mi apart)
   - ELEVATION: Wikipedia infobox says 686 ft; Simple English Wikipedia / Google KG say 735 ft. Sources conflict, so the page shows a RANGE.
   - https://www.co.grayson.tx.us/page/hist.home  (blackland prairie "a dominant feature for much of the county")
   - https://www.tshaonline.org/handbook/entries/grayson-county  (county elevation 600-800 ft, generally level with some low hills)
   - https://phzmapi.org/75090.json and /75092.json  (2023 USDA Plant Hardiness Zone Map: 8a for both Sherman ZIPs)
   Unverifiable names dropped: no neighborhood names, no "Sherman soil series" claim. No frequency claims about past work.
   ========================================================================== */

/* ---- Page setup ------------------------------------------------------------------------------- */
$apSlug          = 'sherman';
$apRow           = ap_area($apSlug);
$pageTitle       = 'Sand and Gravel Supplier in Sherman, TX | HARDROCK';
$pageDescription = 'HARDROCK Sand and Gravel supplies pea gravel, road base, 57/67 rock and fill dirt to Sherman, TX addresses. Based in Sherman since 2019. Call ' . formatPhone($phone) . '.';
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
    ['q' => 'Does HARDROCK deliver sand and gravel inside Sherman, TX?',
     'a' => 'Yes. HARDROCK Sand and Gravel is based in Sherman and delivers bulk gravel, sand, rock and fill dirt to Sherman addresses. Call ' . $spCall . ' with the street address, the material and the size of the area, and HARDROCK prices the load by phone.'],
    ['q' => 'How much road base or fill does a Sherman driveway or building pad need?',
     'a' => 'Multiply length by width by depth in feet and divide by 27 to get cubic yards, then add 5 to 10 percent for settling. A 12 by 40 foot drive laid 4 inches deep works out to about 5.9 cubic yards before that extra. HARDROCK will check your numbers on the phone before ordering.'],
    ['q' => 'What are HARDROCK\'s hours for Sherman customers?',
     'a' => 'HARDROCK Sand and Gravel takes calls Monday to Thursday from 6:00 AM to 5:00 PM, Friday from 9:00 AM to 5:00 PM and Saturday from 9:00 AM to 2:00 PM. The business is closed Sunday. The number is ' . $spCall . '.'],
];
$pageSchemas = [ap_schema($apSlug, $pageTitle, $pageDescription, [
    'name' => 'Sherman', 'type' => 'City', 'sameAs' => 'https://en.wikipedia.org/wiki/Sherman,_Texas',
], $siteUrl . $ogImage)];
/* FAQPage mirrors the visible FAQ below (AI comprehension aid only) */
$pageSchemas[0]['@graph'][] = array_diff_key(generateFAQSchema($faqs), ['@context' => 1]);

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/area-page.css'; ?></style>
<style>
/* ==========================================================================
   /service-areas/sherman/ — page-specific composition
   Signature: the "four roads" route band — highway shields strung along a dashed centre line.
   ========================================================================== */
.sh-hero .hero-bg img { object-position: 50% 58%; }

.sh-roads__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.25fr); gap: var(--space-3xl); align-items: start; }
.sh-roads__lead { display: grid; gap: var(--space-md); }
.sh-roads__lead > p { margin: 0; }
.sh-roads .answer-block { background: color-mix(in srgb, var(--color-white) 7%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.sh-route { position: relative; display: grid; gap: var(--space-md); margin: 0; padding: 0 0 0 calc(var(--space-3xl) + var(--space-sm)); list-style: none; }
.sh-route::before { content: ""; position: absolute; top: var(--space-md); bottom: var(--space-md); left: calc(var(--space-xl) - var(--space-1)); width: var(--space-xs); border-radius: var(--radius-full);
  background: repeating-linear-gradient(to bottom, var(--color-accent-bright) 0 var(--space-md), transparent var(--space-md) var(--space-xl)); }
.sh-route li { position: relative; display: grid; gap: var(--space-1); padding: var(--space-md) var(--space-lg); border-radius: var(--radius-sm);
  background: color-mix(in srgb, var(--color-white) 6%, transparent); border: 1px solid color-mix(in srgb, var(--color-white) 12%, transparent); }
.sh-route .sh-route__shield { position: absolute; left: calc(-1 * (var(--space-3xl) + var(--space-sm))); top: var(--space-md); display: grid; place-items: center; min-width: var(--space-3xl); height: var(--space-2xl);
  padding-inline: var(--space-xs); border-radius: var(--radius-sm) var(--radius-sm) var(--radius-full) var(--radius-full); background: var(--color-white); color: var(--color-dark);
  font-family: var(--font-accent); font-weight: 800; font-size: 1.05rem; line-height: 1; letter-spacing: .04em; box-shadow: 0 0 0 var(--space-1) var(--color-dark), 0 0 0 calc(var(--space-1) + 2px) var(--color-accent-bright); }
.sh-route b { font-family: var(--font-heading); font-size: 1.15rem; text-transform: uppercase; letter-spacing: .03em; color: var(--color-white); }
.sh-route em { font-style: normal; font-family: var(--font-accent); text-transform: uppercase; letter-spacing: .1em; font-size: var(--fs-small); color: var(--color-accent-bright); }
.sh-route span { font-size: .95rem; color: color-mix(in srgb, var(--color-white) 78%, transparent); }

.sh-ground { background: var(--color-surface); }
.sh-ground__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.1fr); gap: var(--space-2xl); align-items: center; }
.sh-ground__copy { display: grid; gap: var(--space-md); }
.sh-ground__copy > p { margin: 0; color: var(--color-ink-2); }
.sh-jobs { display: grid; gap: var(--space-md); margin: 0; padding: 0; list-style: none; }
.sh-jobs li { display: grid; grid-template-columns: auto 1fr; gap: var(--space-md); align-items: start; padding: var(--space-lg); border-radius: var(--radius-sm); border: 1px solid var(--color-line); }
.sh-jobs li:nth-child(1) { background: var(--color-card-tint-1); }
.sh-jobs li:nth-child(2) { background: var(--color-card-tint-2); }
.sh-jobs li:nth-child(3) { background: var(--color-card-tint-3); }
.sh-jobs svg { color: var(--color-accent-dark); margin-top: var(--space-1); }
.sh-jobs b { display: block; font-family: var(--font-heading); font-size: 1.15rem; text-transform: uppercase; letter-spacing: .02em; color: var(--color-ink); }
.sh-jobs span { display: block; margin-top: var(--space-1); font-size: var(--fs-small); color: var(--color-ink-2); }
.sh-jobs a { color: var(--color-accent-dark); font-weight: 600; text-decoration: underline; text-underline-offset: .18em; }
@media (prefers-reduced-motion: no-preference) {
  .sh-route li { transition: transform var(--transition), border-color var(--transition); }
  .sh-route li:hover { transform: translateX(var(--space-1)); border-color: color-mix(in srgb, var(--color-accent-bright) 60%, transparent); }
}
@media (max-width: 900px) { .sh-roads__grid, .sh-ground__grid { grid-template-columns: 1fr; gap: var(--space-2xl); } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero sh-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, $apRow['alt'], '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo ap_breadcrumb('Sherman'); ?>
    <div class="hero-grid hero-grid--form">
      <div class="hero-text hero-copy">
        <span class="eyebrow">Grayson County seat · Home base</span>
        <h1 class="hero-title" id="sp-hero-title">Sand and Gravel Supplier in <span class="text-accent">Sherman</span>, TX</h1>
        <p class="hero-answer">HARDROCK Sand and Gravel is a Sherman-based supplier of bulk gravel, sand, rock and fill dirt, delivered across town and the rest of Grayson County.</p>
        <div class="hero-actions btn-group">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('calendar', 16); ?>In business since <?php echo esc($yearEstablished); ?></li>
          <li><?php echo icon('layers', 16); ?>8 bulk materials</li>
          <li><?php echo icon('phone', 16); ?>Priced by phone</li>
        </ul>
      </div>
      <aside class="hero-form-card" id="estimate-form">
        <h2>Free estimate in Sherman</h2>
        <p class="hero-form-tagline">Name the material and the address. HARDROCK calls back with a price.</p>
        <form action="<?php echo esc($formAction); ?>" method="POST" class="hero-form">
          <?php echo p1_lead_hidden_fields('hero'); ?>
          <?php /* p1_lead_hidden_fields() echoes p1_attribution_fields('hero') */ ?>
          <div class="form-row"><label class="sr-only" for="hero-name">Name</label><input id="hero-name" type="text" name="name" placeholder="Name" autocomplete="name" required></div>
          <div class="form-row"><label class="sr-only" for="hero-phone">Phone</label><input id="hero-phone" type="tel" name="phone" placeholder="Phone" autocomplete="tel" inputmode="tel" required></div>
          <div class="form-row"><label class="sr-only" for="hero-email">Email</label><input id="hero-email" type="email" name="email" placeholder="Email" autocomplete="email" required></div>
          <div class="form-row"><label class="sr-only" for="hero-service">Service</label><select id="hero-service" name="service"><?php echo p1_service_options('Delivery'); ?></select></div>
          <?php echo p1_consent_row('hero'); ?>
          <button type="submit" class="btn btn-primary btn-block">Get my free estimate</button>
        </form>
      </aside>
    </div>
  </div>
</section>

<article class="sp-article" aria-labelledby="sp-hero-title">

<!-- ============ WHO SUPPLIES SHERMAN ============ -->
<section class="section ap-intro" aria-labelledby="sh-intro-title">
  <div class="container">
    <div class="ap-intro__grid">
      <div class="ap-intro__copy reveal-left">
        <span class="eyebrow">Sherman, Texas</span>
        <h2 id="sh-intro-title">Who delivers sand and gravel to Sherman, TX addresses?</h2>
        <p class="answer-block">HARDROCK Sand and Gravel, a supplier based in Sherman, TX since 2019, delivers pea gravel, road base, 57 and 67 rock, fill dirt, mason sand, decomposed granite, river rock and rip rap to Sherman addresses. Call <?php echo esc($spCall); ?> with the street, the material and the size of the area, and HARDROCK prices the load by phone.</p>
        <p>If you searched for sand and gravel near me in Sherman, the useful fact is that the supplier is already in town. Sherman is the Grayson County seat, named for Texas Revolution general Sidney Sherman, and the county's largest city at 43,645 people in the 2020 census. Austin College, founded in 1849, has been in Sherman since it moved here in 1876.</p>
        <p>Addresses in Sherman run from lots near the courthouse and the Austin College campus out to acreage at the south edge of the city, where Texas Instruments has built a large semiconductor wafer fab near the city limits. A load going to any of those addresses is planned around how a truck gets in, where the pile can sit, and what the material has to do once it is down.</p>
      </div>
      <dl class="ap-facts reveal-right">
        <p class="ap-facts__title">Sherman at a glance</p>
        <div><dt>County seat since</dt><dd>1846</dd></div>
        <div><dt>2020 census</dt><dd>43,645 people</dd></div>
        <div><dt>Elevation</dt><dd>about 690–735 ft</dd></div>
        <div><dt>ZIP codes</dt><dd>75090, 75091, 75092</dd></div>
        <div><dt>USDA zone (2023 map)</dt><dd>8a</dd></div>
        <div><dt>Austin College in town</dt><dd>since 1876</dd></div>
        <p class="ap-facts__note">Elevation varies by source: Wikipedia lists 686 ft and other references list 735 ft.</p>
      </dl>
    </div>
  </div>
</section>

<!-- ============ SIGNATURE: FOUR ROADS ============ -->
<section class="section on-dark texture-grain slant-top sh-roads" aria-labelledby="sh-roads-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="sh-roads__grid">
      <div class="sh-roads__lead reveal-left">
        <span class="eyebrow">Giving directions</span>
        <h2 id="sh-roads-title">Which roads get a gravel load to your Sherman address?</h2>
        <p class="answer-block">Four highways organize a Sherman delivery address: US 75 north and south, US 82 east and west, SH 56 and SH 11 across the city, and SH 91 toward Denison. Give HARDROCK the street, the nearest cross street and which side of US 75 and US 82 the lot sits on, and the route is settled on the call.</p>
        <p>Sherman sits between Denison to the north and Howe to the south, about 70 miles north of Dallas. A street name alone can be ambiguous on a growing edge of town, so a landmark helps: the freeway frontage road, a church, a farm gate, a mailbox number on a rural road. Mention it on the call so the route can be confirmed before a loaded truck heads out.</p>
        <p>Heading to Denison instead? Read about <a href="<?php echo esc(areaUrl('denison')); ?>">sand and gravel delivery in Denison</a>, or see how <a href="/services/delivery/">HARDROCK's delivery service</a> works from call to drop.</p>
      </div>
      <ol class="sh-route reveal-right">
        <li><span class="sh-route__shield" aria-hidden="true">US 75</span><b>Sam Rayburn Freeway</b><em>North – south</em><span>The main spine through town. Say whether the lot is east or west of it.</span></li>
        <li><span class="sh-route__shield" aria-hidden="true">US 82</span><b>Buck Owens Freeway</b><em>East – west</em><span>Crosses US 75 and gives the second reference point for describing where a lot sits.</span></li>
        <li><span class="sh-route__shield" aria-hidden="true">SH 56</span><b>State Highways 56 and 11</b><em>East – west</em><span>Two more east–west state highways, useful reference points for lots away from the freeways.</span></li>
        <li><span class="sh-route__shield" aria-hidden="true">SH 91</span><b>Texoma Parkway</b><em>North – south</em><span>Links Sherman with Denison, whose city centers are about 11 miles apart.</span></li>
      </ol>
    </div>
  </div>
</section>

<!-- ============ WHAT THE GROUND MEANS ============ -->
<section class="section sh-ground edge-curve-top" aria-labelledby="sh-ground-title">
  <div class="container">
    <div class="sh-ground__grid">
      <div class="sh-ground__copy reveal-left">
        <span class="eyebrow">Ground conditions</span>
        <h2 id="sh-ground-title">What does Sherman's ground mean for a driveway, pad or bed?</h2>
        <p class="answer-block">Where a Sherman lot sits on blackland clay, the soil swells when wet and shrinks when dry, so a drive or slab pad needs a compacted base layer instead of bare dirt. Grayson County's own history page calls blackland prairie a dominant feature of much of the county, though the soil varies from lot to lot.</p>
        <p>Sherman sits at roughly 690 to 735 feet. The Handbook of Texas describes Grayson County as generally level with some low hills and puts its average rainfall near 37 inches a year. Water that stands on a lot after a storm is the first thing to note before ordering, because it decides whether the job needs fill to raise the grade, rock to carry the water off, or both.</p>
        <p>Order by what the material has to do, not by the name on the pile. The three jobs at right are common reasons to order in a clay-soil county, and each links to the material guide behind it.</p>
      </div>
      <ul class="sh-jobs reveal-right">
        <li><?php echo icon('route', 24); ?><div><b>Drives and parking</b><span>A <a href="/services/road-base/">road base</a> layer packs firm under tires, and <a href="/services/57-67-rock/">57 or 67 rock</a> on top drains and grips. See <a href="/services/driveways/">gravel driveways</a> for the full job.</span></div></li>
        <li><?php echo icon('house', 24); ?><div><b>Slab and building pads</b><span><a href="/services/fill-dirt/">Fill dirt</a> raises the grade in compacted lifts, then base caps it for the slab crew. See <a href="/services/house-pads/">house pads</a>.</span></div></li>
        <li><?php echo icon('footprints', 24); ?><div><b>Beds, paths and patios</b><span><a href="/services/decomposed-granite/">Decomposed granite</a>, <a href="/services/pea-gravel/">pea gravel</a> and <a href="/services/river-rock/">river rock</a> finish the surface; <a href="/services/mason-sand/">mason sand</a> beds the pavers. Sherman is USDA zone 8a.</span></div></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ SERVICES AVAILABLE ============ -->
<section class="section ap-svc" aria-labelledby="sh-svc-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Available in Sherman</span>
      <h2 id="sh-svc-title">What materials and site work can HARDROCK bring to Sherman?</h2>
      <p class="answer-block">HARDROCK Sand and Gravel brings eight bulk materials plus driveway, house pad, pond and land clearing work to Sherman. The six below match most Sherman lots, from a base under a drive to fill under a slab; the rest are one tap away and each has its own page.</p>
    </div>
    <?php echo ap_service_list(['road-base', '57-67-rock', 'fill-dirt', 'house-pads', 'driveways', 'delivery'], 'Sherman'); ?>
  </div>
</section>

<!-- ============ WHY HARDROCK ============ -->
<section class="section ap-why edge-wave-top" aria-labelledby="sh-why-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Why HARDROCK</span>
      <h2 id="sh-why-title">Why order sand and gravel from a supplier based in Sherman?</h2>
      <p>HARDROCK Sand and Gravel is a local business, in business since <?php echo esc($yearEstablished); ?>, and the four facts below come from HARDROCK's own business details rather than from guesswork.</p>
    </div>
    <ul class="ap-why__grid">
      <li class="reveal-up reveal-delay-1"><?php echo icon('map-pin', 24); ?><b>Based in Sherman</b><span>HARDROCK's listed location is Sherman, TX, so Sherman is the starting point, not the far end of a haul.</span></li>
      <li class="reveal-up reveal-delay-2"><?php echo icon('layers', 24); ?><b>Material and site work</b><span>Eight bulk materials plus driveways, house pads, ponds and land clearing under one phone number.</span></li>
      <li class="reveal-up reveal-delay-3"><?php echo icon('phone', 24); ?><b>Priced by phone</b><span>Each load is priced on the call from the material, the amount and the address, with the cubic yards checked first.</span></li>
      <li class="reveal-up reveal-delay-4"><?php echo icon('clock', 24); ?><b>Early weekday start</b><span>Phones open 6:00 AM Monday to Thursday, 9:00 AM Friday and 9:00 AM to 2:00 PM Saturday.</span></li>
    </ul>
  </div>
</section>

<!-- ============ GOOGLE REVIEWS (Page One feed; renders nothing when the feed is empty) ============ -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
$shReviews = p1_google_reviews($slug, ['heading' => 'What customers say about HARDROCK on Google', 'limit' => 6]);
if ($shReviews !== ''): ?>
<section class="section sp-proof" aria-label="Google reviews"><div class="container"><?php echo $shReviews; ?>
  <div class="sp-proof__foot"><a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a></div>
</div></section>
<?php endif; ?>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain slant-top sp-faq" id="faq" aria-labelledby="sh-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="sh-faq-title">What do Sherman customers ask before ordering?</h2>
      <p>Three questions come up before almost any gravel order in Sherman: whether the truck comes to the address, how much material the job needs, and when the phones are open.</p>
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
<section class="ap-near" aria-labelledby="sh-near-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Also serving</span>
      <h2 id="sh-near-title">Where else does HARDROCK deliver besides Sherman?</h2>
      <p>HARDROCK Sand and Gravel also delivers to Denison, about 11 miles north of Sherman, and across the rest of Grayson County. Each page covers its own roads, ground conditions and the materials that suit the work there.</p>
    </div>
    <?php echo ap_nearby($apSlug); ?>
  </div>
</section>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Get a Free Estimate in Sherman',
    'Call HARDROCK Sand and Gravel or send the form with your Sherman address, the material and the size of the area. HARDROCK prices the load by phone and sets a delivery day.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
