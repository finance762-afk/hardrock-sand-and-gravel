<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/area-page.php';
?>
<?php
/* ==========================================================================
   CONTENT DECK SOURCES — Denison (researched 2026-10-15)
   - https://en.wikipedia.org/wiki/Denison,_Texas  (founded 1872 with the Katy depot, named for Katy VP George Denison; about 1 mile south of
     the Oklahoma line, city limits reach the Red River; Denison Dam ~5 mi north forms Lake Texoma; Sherman/Denison centers 11 mi apart;
     2020 census 24,479; US 75 Katy Memorial Expressway, US 69, SH 91 Texoma Parkway, Spur 503 Eisenhower Parkway; ZIPs 75020-75021;
     Denison ISD; Eisenhower born in Denison Oct 14, 1890; Munson Stadium)
   - ELEVATION: Wikipedia infobox 728 ft; ZIP-database values 620-713 ft; topographic-map averages ~653 ft. Sources conflict, so a RANGE is shown.
   - https://www.tshaonline.org/handbook/entries/denison-tx  (townsite laid out summer 1872; Eisenhower Birthplace State Historic Site, 3 acres)
   - https://www.tshaonline.org/handbook/entries/grayson-county  (northern county drains to Lake Texoma and the Red River; acidic Post Oak Belt
     soils with loamy or sandy surfaces; blackland to the south)
   - https://en.wikipedia.org/wiki/Eisenhower_State_Park_(Texas)  (state park on the Texoma shore northwest of Denison; acreage sources conflict 423-463, so no acreage is stated)
   - https://phzmapi.org/75020.json and /75021.json  (2023 USDA Plant Hardiness Zone Map: 8a)
   - Lake Texoma shoreline: a Tulsa District U.S. Army Corps of Engineers notice (texomaconnect.com, Jan 2020) says its Shoreline Management Plan governs
     private uses; no source found stating what rip rap on the shoreline requires, so the page only says to ask the Corps.
   Unverifiable names dropped: Loy Lake, Waterloo Lake, Munson Park, any neighborhood names, "Denison Commercial Historic District" details.
   No frequency claims about past work.
   ========================================================================== */

/* ---- Page setup ------------------------------------------------------------------------------- */
$apSlug          = 'denison';
$apRow           = ap_area($apSlug);
$pageTitle       = 'Sand and Gravel Delivery in Denison, TX | HARDROCK';
$pageDescription = 'Hardrock Sand And Gravel delivers rip rap, road base, pea gravel and fill dirt to Denison, TX, about 11 miles north of Sherman. Call us at ' . formatPhone($phone) . '.';
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
    ['q' => 'Does HARDROCK deliver rip rap and gravel to Denison, TX?',
     'a' => 'Yes. Hardrock Sand And Gravel is based in Sherman, which sits about 11 miles south of Denison, and delivers bulk rock, gravel, sand and fill dirt to Denison addresses. Call ' . $spCall . ' with the address and the job, and HARDROCK prices the load by phone.'],
    ['q' => 'Do I need permission before putting rip rap on the Lake Texoma shoreline?',
     'a' => 'Possibly, and HARDROCK cannot answer that for your shoreline. The U.S. Army Corps of Engineers, Tulsa District, administers the Lake Texoma Shoreline Management Plan, so ask the Corps before moving rock at the water\'s edge. Rip rap on a private pond or ditch bank is a different question; call ' . $spCall . ' to talk it through.'],
    ['q' => 'What should I tell HARDROCK about an older Denison lot before a delivery?',
     'a' => 'Give the street address, the width of the gate or drive, any low-hanging limbs or wires, and whether the ground is soft after rain. Denison dates to 1872, so older lots may come with established fences, trees and narrow gates. That detail lets HARDROCK confirm where a truck can set the pile.'],
];
$pageSchemas = [ap_schema($apSlug, $pageTitle, $pageDescription, [
    'name' => 'Denison', 'type' => 'City', 'sameAs' => 'https://en.wikipedia.org/wiki/Denison,_Texas',
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
   /service-areas/denison/ — page-specific composition
   Signature: the bank cross-section — a slope drawn as stacked layers (grade, fabric, rock) beside the real photo.
   ========================================================================== */
.dn-hero .hero-bg img { object-position: 50% 55%; }

.dn-lake { background: var(--color-paper); }
.dn-lake__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.2fr); gap: var(--space-3xl); align-items: center; }
.dn-lake__copy { display: grid; gap: var(--space-md); }
.dn-lake__copy > p { margin: 0; color: var(--color-ink-2); max-width: var(--measure); }
.dn-lake__side { display: grid; gap: var(--space-xl); }
.dn-photo { margin: 0; position: relative; }
.dn-photo picture { display: block; aspect-ratio: 4 / 3; overflow: hidden; border-radius: var(--radius-sm); box-shadow: var(--shadow-lg); clip-path: polygon(0 0, 100% 0, 100% 100%, 12% 100%, 0 88%); }
.dn-photo img { width: 100%; height: 100%; object-fit: cover; }
.dn-photo figcaption { margin-top: var(--space-sm); font-size: var(--fs-small); color: var(--color-muted); }

.dn-bank__grid { display: grid; grid-template-columns: minmax(0, 1.15fr) minmax(0, 1fr); gap: var(--space-3xl); align-items: start; }
.dn-bank__lead { display: grid; gap: var(--space-md); }
.dn-bank__lead > p { margin: 0; }
.dn-bank .answer-block { background: color-mix(in srgb, var(--color-white) 7%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.dn-layers { display: grid; gap: var(--space-xs); margin: 0; padding: 0; list-style: none; counter-reset: dnlayer; }
.dn-layers li { counter-increment: dnlayer; position: relative; display: grid; gap: var(--space-1); padding: var(--space-md) var(--space-lg) var(--space-md) calc(var(--space-3xl) + var(--space-xs)); border-radius: var(--radius-sm); border: 1px solid color-mix(in srgb, var(--color-white) 14%, transparent); }
.dn-layers li::before { content: counter(dnlayer); position: absolute; left: var(--space-lg); top: 50%; translate: 0 -50%; display: grid; place-items: center; width: var(--space-xl); height: var(--space-xl); border-radius: 50%; background: var(--color-accent); color: var(--color-white); font-family: var(--font-accent); font-weight: 800; }
.dn-layers li:nth-child(1) { background: color-mix(in srgb, var(--color-accent) 22%, var(--color-dark)); margin-inline-end: var(--space-2xl); }
.dn-layers li:nth-child(2) { background: color-mix(in srgb, var(--color-black) 55%, var(--color-dark)); margin-inline-end: var(--space-xl); }
.dn-layers li:nth-child(3) { background: color-mix(in srgb, var(--color-white) 14%, var(--color-dark)); margin-inline-end: var(--space-lg); }
.dn-layers li:nth-child(4) { background: color-mix(in srgb, var(--color-white) 24%, var(--color-dark)); }
.dn-layers b { font-family: var(--font-heading); font-size: 1.15rem; text-transform: uppercase; letter-spacing: .03em; color: var(--color-white); }
.dn-layers span { font-size: .95rem; color: color-mix(in srgb, var(--color-white) 80%, transparent); }
.dn-layers__note { margin: var(--space-sm) 0 0; font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 70%, transparent); }

.dn-roads { background: var(--color-surface); }
.dn-roads__grid { display: grid; grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr); gap: var(--space-2xl); align-items: center; }
.dn-roads__copy { display: grid; gap: var(--space-md); }
.dn-roads__copy > p { margin: 0; color: var(--color-ink-2); }
.dn-tags { display: flex; flex-wrap: wrap; gap: var(--space-xs); margin: 0; padding: 0; list-style: none; }
.dn-tags li { padding: var(--space-xs) var(--space-md); border-radius: var(--radius-full); background: var(--color-card-tint-3); border: 1px solid var(--color-line); font-family: var(--font-accent); text-transform: uppercase; letter-spacing: .08em; font-size: var(--fs-small); font-weight: 700; color: var(--color-ink); }
@media (max-width: 900px) { .dn-lake__grid, .dn-bank__grid, .dn-roads__grid { grid-template-columns: 1fr; gap: var(--space-2xl); } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero dn-hero" aria-labelledby="sp-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, $apRow['alt'], '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo ap_breadcrumb('Denison'); ?>
    <div class="hero-grid hero-grid--form">
      <div class="hero-text hero-copy">
        <span class="eyebrow">Red River side of Grayson County</span>
        <h1 class="hero-title" id="sp-hero-title">Sand and Gravel Delivery in <span class="text-accent">Denison</span>, TX</h1>
        <p class="hero-answer">Hardrock Sand And Gravel delivers rip rap, road base, pea gravel and fill dirt to Denison, about 11 miles north of Sherman.</p>
        <div class="hero-actions btn-group">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('waves', 16); ?>Rip rap for banks</li>
          <li><?php echo icon('droplets', 16); ?>Pond and drainage rock</li>
          <li><?php echo icon('phone', 16); ?>Priced by phone</li>
        </ul>
      </div>
      <aside class="hero-form-card" id="estimate-form">
        <h2>Free estimate in Denison</h2>
        <p class="hero-form-tagline">Name the material and the address. HARDROCK calls back with a price.</p>
        <form action="<?php echo esc($formAction); ?>" method="POST" class="hero-form">
          <?php echo p1_lead_hidden_fields('hero'); ?>
          <?php /* p1_lead_hidden_fields() echoes p1_attribution_fields('hero') */ ?>
          <div class="form-row"><label class="sr-only" for="hero-name">Name</label><input id="hero-name" type="text" name="name" placeholder="Name" autocomplete="name" required></div>
          <div class="form-row"><label class="sr-only" for="hero-phone">Phone</label><input id="hero-phone" type="tel" name="phone" placeholder="Phone" autocomplete="tel" inputmode="tel" required></div>
          <div class="form-row"><label class="sr-only" for="hero-email">Email</label><input id="hero-email" type="email" name="email" placeholder="Email" autocomplete="email" required></div>
          <div class="form-row"><label class="sr-only" for="hero-service">Service</label><select id="hero-service" name="service"><?php echo p1_service_options('Rip rap'); ?></select></div>
          <?php echo p1_consent_row('hero'); ?>
          <button type="submit" class="btn btn-primary btn-block">Get my free estimate</button>
        </form>
      </aside>
    </div>
  </div>
</section>

<article class="sp-article" aria-labelledby="sp-hero-title">

<!-- ============ WHO DELIVERS TO DENISON (lake / river angle) ============ -->
<section class="section dn-lake" aria-labelledby="dn-lake-title">
  <div class="container">
    <div class="dn-lake__grid">
      <div class="dn-lake__copy reveal-left">
        <span class="eyebrow">Denison, Texas</span>
        <h2 id="dn-lake-title">Where can you get rip rap and gravel delivered in Denison, TX?</h2>
        <p class="answer-block">Hardrock Sand And Gravel, a Sherman, TX supplier in business since 2016, delivers rip rap, road base, pea gravel, 57 and 67 rock and fill dirt to Denison addresses, about 11 miles north of Sherman. Call <?php echo esc($spCall); ?> with the address and the job, and HARDROCK prices the load by phone.</p>
        <p>Denison sits in the northeast corner of the county, about a mile south of the Oklahoma line, with city limits that reach the Red River. Denison Dam sits roughly five miles north and holds back Lake Texoma, and Eisenhower State Park sits on the lake shore northwest of town. That water is why bank, ditch and pond work are worth planning for here, and why rip rap is the first material to ask about when you search for sand and gravel near me in Denison.</p>
        <p>Dwight D. Eisenhower was born in Denison on October 14, 1890, and the house is now the three-acre Eisenhower Birthplace State Historic Site. Those are sights a visitor looks for; for a gravel order, the useful facts are the roads, the slopes and the soil described below.</p>
      </div>
      <div class="dn-lake__side reveal-right">
      <figure class="dn-photo">
        <?php echo pictureTag('rip-rap-stockpile-closeup', 'Close-up of a pile of angular grey rip rap stone with a golf ball for scale', '(max-width: 900px) 100vw, 560px'); ?>
        <figcaption>Angular rip rap close up, with a golf ball for scale. HARDROCK's rip rap goes on banks, pond edges and culvert outlets.</figcaption>
      </figure>
        <dl class="ap-facts">
        <p class="ap-facts__title">Denison at a glance</p>
        <div><dt>Town founded</dt><dd>1872, with the Katy depot</dd></div>
        <div><dt>2020 census</dt><dd>24,479 people</dd></div>
        <div><dt>Elevation</dt><dd>about 650–730 ft</dd></div>
        <div><dt>ZIP codes</dt><dd>75020, 75021</dd></div>
        <div><dt>USDA zone (2023 map)</dt><dd>8a</dd></div>
        <div><dt>Denison Dam</dt><dd>about 5 miles north</dd></div>
        <p class="ap-facts__note">Elevation varies by source: Wikipedia lists 728 ft, while ZIP-code and map data run lower.</p>
        </dl>
      </div>
    </div>
  </div>
</section>

<!-- ============ SIGNATURE: BANK CROSS-SECTION ============ -->
<section class="section on-dark texture-grain slant-top dn-bank" aria-labelledby="dn-bank-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="dn-bank__grid">
      <div class="dn-bank__lead reveal-left">
        <span class="eyebrow">Bank and ditch work</span>
        <h2 id="dn-bank-title">How does rip rap hold a slope near Denison's creeks and ponds?</h2>
        <p class="answer-block">Rip rap holds a slope by covering bare, graded soil with a filter layer and then heavy angular rock that moving water cannot carry off. The Handbook of Texas describes the northern part of Grayson County, which drains toward Lake Texoma and the Red River, as having loamy or sandy surface soils, and loose surface soil is what runoff strips from an unprotected bank.</p>
        <p>The photo behind this page's headline shows the method on a HARDROCK job: black filter fabric laid on a graded slope while rip rap is placed over it. Slope, flow and bank height decide how much rock a job needs, so HARDROCK sizes it on the call rather than from a table. Read more on <a href="/services/rip-rap/">rip rap for banks and culverts</a> and <a href="/services/ponds/">pond digging and shaping</a>.</p>
        <p>Rock at the water's edge of Lake Texoma itself is a separate question. The U.S. Army Corps of Engineers, Tulsa District, administers the lake's Shoreline Management Plan, so check with the Corps first. For an inland pond, creek bend or ditch outlet, <a href="/services/delivery/">delivery</a> is the next step.</p>
      </div>
      <div class="reveal-right">
        <ol class="dn-layers">
          <li><b>Graded slope</b><span>Bare soil shaped to a steady angle with loose spots and roots removed.</span></li>
          <li><b>Filter fabric</b><span>Laid over the soil so water drains through but the soil stays put.</span></li>
          <li><b>Bedding layer</b><span>Smaller stone where the job calls for it, to cushion the fabric.</span></li>
          <li><b>Rip rap</b><span>Large angular rock set over the top, heavy enough to stay where it is placed.</span></li>
        </ol>
        <p class="dn-layers__note">A simplified order of work. Fabric, bedding and rock size depend on the slope and the flow, and HARDROCK confirms them on the call.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ ROADS AND OLDER LOTS ============ -->
<section class="section dn-roads edge-curve-top" aria-labelledby="dn-roads-title">
  <div class="container">
    <div class="dn-roads__grid">
      <div class="dn-roads__copy reveal-left">
        <span class="eyebrow">Getting the truck in</span>
        <h2 id="dn-roads-title">What should you tell HARDROCK about a Denison delivery address?</h2>
        <p class="answer-block">Tell HARDROCK the street address, the width of the gate or drive, any low limbs or wires, and whether the ground is soft after rain. Denison dates to 1872, so older lots may carry established fences, trees and narrow gates. A few details on the call let HARDROCK confirm where a truck can set the pile.</p>
        <p>Four roads frame a Denison address: US 75, called the Katy Memorial Expressway, US 69, State Highway 91, the Texoma Parkway, and Spur 503, the Eisenhower Parkway. The Katy railroad depot of 1872 is why the town sits where it does. Say which of those roads the lot is nearest.</p>
        <p>Beyond the water jobs, other Denison orders are about getting in and finishing. For a gravel lane or a lot approach, see <a href="/services/driveways/">gravel driveways</a> and <a href="/services/road-base/">road base</a>; for a flower bed or a path near an older home, <a href="/services/pea-gravel/">pea gravel</a> and <a href="/services/river-rock/">river rock</a> are the usual finishes. Sherman customers can read the <a href="<?php echo esc(areaUrl('sherman')); ?>">Sherman page</a> for the other end of the same stretch of US 75.</p>
      </div>
      <div class="reveal-right">
        <ul class="dn-tags" aria-label="Denison reference points">
          <li>US 75 · Katy Memorial Expressway</li>
          <li>US 69</li>
          <li>SH 91 · Texoma Parkway</li>
          <li>Spur 503 · Eisenhower Parkway</li>
          <li>Denison ISD</li>
          <li>Munson Stadium</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ============ SERVICES AVAILABLE ============ -->
<section class="section ap-svc" aria-labelledby="dn-svc-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Available in Denison</span>
      <h2 id="dn-svc-title">What can HARDROCK deliver or build in Denison, TX?</h2>
      <p class="answer-block">Hardrock Sand And Gravel delivers eight bulk materials to Denison and also digs ponds, builds house pads and driveways, and clears land. The six below fit water, bank and drive jobs best; every other material and service has its own page, listed underneath.</p>
    </div>
    <?php echo ap_service_list(['rip-rap', 'ponds', 'river-rock', 'pea-gravel', 'road-base', 'fill-dirt'], 'Denison'); ?>
  </div>
</section>

<!-- ============ WHY HARDROCK ============ -->
<section class="section ap-why edge-wave-top" aria-labelledby="dn-why-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Why HARDROCK</span>
      <h2 id="dn-why-title">Why choose a Sherman supplier for a Denison job?</h2>
      <p>Hardrock Sand And Gravel serves Denison from Sherman, a short run up the highway. The four facts below come from the business's own details, so a first-time Denison customer knows what to expect on the phone.</p>
    </div>
    <ul class="ap-why__grid">
      <li class="reveal-up reveal-delay-1"><?php echo icon('waves', 24); ?><b>Rock for water</b><span>Rip rap, river rock and 57/67 rock are all on the product list, so a bank or a drain is one call.</span></li>
      <li class="reveal-up reveal-delay-2"><?php echo icon('tractor', 24); ?><b>Ponds and site work</b><span>Pond digging, house pads, driveways and land clearing sit alongside the bulk material.</span></li>
      <li class="reveal-up reveal-delay-3"><?php echo icon('phone', 24); ?><b>Priced by phone</b><span>The load is priced on the call from the material, the amount and the Denison address.</span></li>
      <li class="reveal-up reveal-delay-4"><?php echo icon('calendar', 24); ?><b>In business since <?php echo esc($yearEstablished); ?></b><span>A local operator, with phones open early on weekdays and Saturday until 2:00 PM.</span></li>
    </ul>
  </div>
</section>

<!-- ============ GOOGLE REVIEWS (Page One feed; renders nothing when the feed is empty) ============ -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
$dnReviews = p1_google_reviews($slug, ['heading' => 'What customers say about HARDROCK on Google', 'limit' => 6]);
if ($dnReviews !== ''): ?>
<section class="section sp-proof" aria-label="Google reviews"><div class="container"><?php echo $dnReviews; ?>
  <div class="sp-proof__foot"><a class="btn btn-secondary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">Read HARDROCK's Google reviews</a></div>
</div></section>
<?php endif; ?>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain slant-top sp-faq" id="faq" aria-labelledby="dn-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="dn-faq-title">What should Denison customers know before ordering rock?</h2>
      <p>Three things are worth settling before a Denison order: whether the truck comes to the address, who has to sign off on shoreline rock, and what to say about an older lot.</p>
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
<section class="ap-near" aria-labelledby="dn-near-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Also serving</span>
      <h2 id="dn-near-title">Where else does HARDROCK deliver besides Denison?</h2>
      <p>Hardrock Sand And Gravel also delivers in Sherman, its home base, and across the rest of Grayson County. Each page covers its own roads, ground conditions and the materials that suit the work there.</p>
    </div>
    <?php echo ap_nearby($apSlug); ?>
  </div>
</section>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Get a Free Estimate in Denison',
    'Call Hardrock Sand And Gravel or send the form with your Denison address, the material and the size of the bank, drive or bed. HARDROCK prices the load by phone and sets a delivery day.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
