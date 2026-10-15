<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/blog-helpers.php';
?>
<?php
/* ==========================================================================
   Post sources (2026-10-15): cubic-yard arithmetic is worked in the table below (27 cubic feet per cubic yard);
   layer depths (4-6 in compacted road base, 2-3 in top rock, fabric on soft clay) match /services/driveways/ on this site;
   Grayson County blackland prairie and western sandy soil: https://www.co.grayson.tx.us/page/hist.home ;
   average rainfall near 37 in/yr, soil belts: https://www.tshaonline.org/handbook/entries/grayson-county .
   No HARDROCK prices are quoted: the business prices each load by phone (content-confirmations.json, pricing unit unconfirmed).
   ========================================================================== */

/* ---- Page setup ------------------------------------------------------------------------------- */
$blSlug          = 'how-much-gravel-for-a-driveway-sherman-tx';
$blPost          = blog_post($blSlug);
$pageTitle       = $blPost['title'];
$pageDescription = 'A gravel driveway needs about 1 cubic yard per 80 sq ft at 4 inches deep. See the formula, worked examples and layers for a Sherman, TX lot.';
$canonicalUrl    = $siteUrl . blog_url($blSlug);
$ogImage         = '/assets/images/' . blog_image_base($blPost['image']) . '.jpg';
$ogType          = 'article';
$currentPage     = 'blog';
$pageType        = 'blog';
$headerDark      = true;
$bodyClass       = 'sp-page bl-page';

$spCall = formatPhone($phone);
$spTel  = 'tel:' . $phoneE164;

$faqs = [
    ['q' => 'How much extra gravel should I order for a driveway?',
     'a' => 'Add 5 to 10 percent to the calculated cubic yards to cover settling, compaction and spillage. A drive that works out to 7.4 cubic yards is better ordered as about 7.8 to 8.2 cubic yards.'],
    ['q' => 'How many cubic yards of gravel fit in a pickup truck?',
     'a' => 'Often only about half a cubic yard of gravel, because a half-ton pickup\'s payload rating limits the weight it can carry. A 7-yard driveway would take about 15 trips, which is why most Grayson County drives are delivered in bulk.'],
    ['q' => 'Does HARDROCK price driveway gravel by the yard or by the ton?',
     'a' => 'HARDROCK Sand and Gravel prices each load by phone, because the material, the amount and the address all change the number. Work out your cubic yards first, then call ' . $spCall . ' and ask how that material is measured and priced.'],
];
$pageSchemas = [blog_post_schema($blPost, $pageDescription, 'gravel driveway, how much gravel for a driveway, driveway gravel Sherman TX, road base, 57 rock, cubic yards, Grayson County')];
/* FAQPage mirrors the visible FAQ below (AI comprehension aid only) */
$pageSchemas[0]['@graph'][] = array_diff_key(generateFAQSchema($faqs), ['@context' => 1]);

$blRelated = blog_related($blSlug, 3);

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/inner-page.css'; ?></style>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/blog.css'; ?></style>
<style>
/* /blog/how-much-gravel-for-a-driveway-sherman-tx/ — page-specific: the worked-example table is the signature block */
.bl-hero--drive .blog-post__header { max-width: 50rem; }
.bl-hero--drive::before { content: ""; position: absolute; inset: 0; z-index: -1; pointer-events: none;
  background: linear-gradient(108deg, transparent 40%, color-mix(in srgb, var(--color-accent) 22%, transparent) 100%); }
.bl-table-note { margin: calc(-1 * var(--space-sm)) 0 var(--space-lg); font-size: var(--fs-small); color: var(--color-muted); }
</style>

<!-- ============ POST HEADER ============ -->
<section class="hero hero--interior texture-grain bl-hero bl-hero--drive" aria-labelledby="bl-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <?php echo blog_breadcrumb($blPost['title']); ?>
    <header class="blog-post__header">
      <span class="blog-card__category"><?php echo esc($blPost['category']); ?></span>
      <h1 id="bl-title"><?php echo esc($blPost['title']); ?></h1>
      <p class="blog-post__meta">By <?php echo esc($siteName); ?> · <time datetime="<?php echo esc($blPost['dateISO']); ?>"><?php echo esc($blPost['date']); ?></time> · <?php echo esc($blPost['readtime']); ?></p>
    </header>
  </div>
</section>

<article class="blog-post" aria-labelledby="bl-title">

<!-- ============ ANSWER-FIRST INTRO ============ -->
<section class="section bl-intro" aria-label="Short answer">
  <div class="container">
    <div class="bl-intro__grid">
      <div class="blog-post__content reveal-left">
        <p class="answer-block">A gravel driveway needs about one cubic yard of rock for every 80 square feet at 4 inches deep. A 12 by 50 foot drive laid 4 inches deep takes about 7.4 cubic yards, so order roughly 7.8 to 8.2 once you add 5 to 10 percent for settling.</p>
        <p>HARDROCK Sand and Gravel, a supplier in Sherman, TX since 2019, delivers the road base and crushed rock that go into a drive. This guide shows the arithmetic, the layers and the Grayson County ground conditions that change the order, so the number you give on the phone is one you trust.</p>
        <p>Already have a drive that washed out? Skip ahead to <a href="<?php echo esc(blog_url('fix-gravel-driveway-after-heavy-rain-grayson-county')); ?>">fixing a gravel driveway after heavy rain</a>.</p>
      </div>
      <figure class="blog-post__featured-image reveal-right">
        <?php echo pictureTag(blog_image_base($blPost['image']), $blPost['alt'], '(max-width: 900px) 100vw, 480px'); ?>
      </figure>
    </div>
  </div>
</section>

<!-- ============ MID-PAGE ESTIMATE BAND ============ -->
<?php $ctaBandTitle = 'Know your drive\'s <span class="text-accent">size</span>? Get a price.';
$ctaBandCopy = 'Send the length, width and address of your drive and HARDROCK Sand and Gravel prices the load by phone.';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/cta-band.php'; ?>

<!-- ============ BODY ============ -->
<section class="section bl-body" aria-label="Article">
  <div class="container">
    <div class="bl-layout">
      <div class="blog-post__content">

        <h2 id="calculate">How do you calculate cubic yards for a driveway?</h2>
        <p class="answer-block">Multiply length by width by depth, all in feet, then divide by 27. Depth is the step people miss: 4 inches is 0.33 feet, 6 inches is 0.5 feet. A cubic yard is 27 cubic feet, which is why the divisor never changes.</p>
        <p class="bl-formula">Length × Width × Depth <em>÷ 27</em></p>
        <p>Measure the real path, not the plan. A drive that widens at the gate or bulges into a turnaround is easiest to handle as separate rectangles: work out each one, then add the totals. These three examples use the same arithmetic.</p>
        <div class="sp-table-wrap">
          <table class="sp-table">
            <caption>Cubic yards = length × width × depth in feet ÷ 27. The last column adds 10 percent for settling.</caption>
            <thead><tr><th scope="col">Driveway</th><th scope="col">Depth</th><th scope="col">Cubic feet</th><th scope="col">Cubic yards</th><th scope="col">With 10% extra</th></tr></thead>
            <tbody>
              <tr><th scope="row">12 × 50 ft house drive</th><td>4 in (0.33 ft)</td><td>200</td><td>≈ 7.4</td><td>≈ 8.1</td></tr>
              <tr><th scope="row">10 × 100 ft farm lane</th><td>4 in (0.33 ft)</td><td>333</td><td>≈ 12.3</td><td>≈ 13.6</td></tr>
              <tr class="is-this"><th scope="row">12 × 200 ft rural lane, full build</th><td>6 in (0.5 ft)</td><td>1,200</td><td>≈ 44.4</td><td>≈ 48.9</td></tr>
            </tbody>
          </table>
        </div>
        <p class="bl-table-note">Rounded to one decimal. Cubic feet are rounded to the nearest whole number.</p>
        <p>A cubic yard is a measure of volume, not weight, so how a given material is sold depends on the material. HARDROCK prices each load by phone and says on the call how it is measured, so bring the cubic yards and ask.</p>

        <h2 id="depth">How deep should driveway gravel be?</h2>
        <p class="answer-block">A drive that lasts is built in layers: a shaped, crowned subgrade, 4 to 6 inches of compacted road base, then 2 to 3 inches of top rock. The total is the number to put in the formula, not the 4 inches of top rock people picture.</p>
        <p>That layering is why the table above ends with a 6 inch row for a full build. On soft clay, many builders also roll out geotextile fabric between the dirt and the base, so the base cannot work down into the mud. Our <a href="/services/driveways/">gravel driveway page</a> walks through the full build, and the quantity changes when you only top up an existing surface.</p>

        <h2 id="materials">Which gravel goes into a Grayson County driveway?</h2>
        <p class="answer-block">Two materials do most of the work: <a href="/services/road-base/">road base</a> for the compacted lower layer and <a href="/services/57-67-rock/">57 rock</a> for the top course. Road base packs into one firm layer; 57 stone drains and gives tires grip. Rounded pea gravel and river rock roll underfoot and are a poor top layer for a drive.</p>
        <p>Split the total between the two. On a 6 inch full build, roughly 4 inches is road base and 2 inches is top rock, so the road base is about two thirds of the order. HARDROCK can deliver both loads in one visit, or build the whole drive; the <a href="/services/delivery/">delivery page</a> explains what happens after the call.</p>

        <h2 id="soil">Does Grayson County's soil change how much gravel you need?</h2>
        <p class="answer-block">Yes. Grayson County has blackland prairie across much of its area, sandy Woodbine soil in the west and loamy or sandy Post Oak Belt ground in the north. Clay swells when wet and shrinks when dry, so on blackland a thicker base, and sometimes fabric, keeps the rock from sinking.</p>
        <p>The Handbook of Texas puts average rainfall near 37 inches a year, and a lane that is firm in August can be soft in March. If your lot sits on clay or stays wet after a storm, plan for the 6 inch build, not the 4 inch top-up. Local pages cover the ground in more detail for <a href="/service-areas/sherman/">Sherman</a> and the wider <a href="/service-areas/grayson-county/">Grayson County</a> area.</p>

        <h2 id="order">What should you tell HARDROCK when you order driveway gravel?</h2>
        <p class="answer-block">Give HARDROCK Sand and Gravel the address, the length and width of the drive, the depth you plan and where the pile can go. Mention soft ground, a narrow gate or a culvert crossing too. With those details the load is priced and a delivery day set on the same call.</p>
        <ul>
          <li><strong>Address and drop spot.</strong> A firm, level place close to the work, clear of wires and buried lines.</li>
          <li><strong>Drive size.</strong> Length, width and the depth you chose, or the cubic yards from the table.</li>
          <li><strong>Access.</strong> Gate width, overhead limbs and how soft the ground gets after rain.</li>
          <li><strong>Crossings.</strong> A ditch or culvert on the lane needs rock at the outlet; see the <a href="/services/rip-rap/">rip rap page</a>.</li>
        </ul>
        <p>Call <a href="<?php echo esc($spTel); ?>"><?php echo esc($spCall); ?></a> Monday to Thursday from 6:00 AM, Friday from 9:00 AM or Saturday from 9:00 AM to 2:00 PM.</p>

      </div>

      <aside class="bl-aside" aria-label="Article sidebar">
        <nav class="bl-toc" aria-label="Table of contents">
          <h2>In this guide</h2>
          <ol>
            <li><a href="#calculate">Calculate cubic yards</a></li>
            <li><a href="#depth">How deep to go</a></li>
            <li><a href="#materials">Which gravel to use</a></li>
            <li><a href="#soil">Grayson County soil</a></li>
            <li><a href="#order">What to tell HARDROCK</a></li>
            <li><a href="#faq">Quick questions</a></li>
          </ol>
        </nav>
        <div class="bl-side-cta">
          <h2>Price my drive</h2>
          <p>HARDROCK Sand and Gravel delivers road base and 57 rock in Sherman, Denison and Grayson County.</p>
          <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>Call <?php echo esc($spCall); ?></a>
          <button type="button" class="btn btn-accent" data-open-estimate>Get a free estimate</button>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section on-dark texture-grain slant-top sp-faq" id="faq" aria-labelledby="bl-faq-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Quick questions</span>
      <h2 id="bl-faq-title">What else do people ask about driveway gravel quantities?</h2>
      <p>Three follow-up questions come up once the driveway gravel arithmetic is done: how much extra to add for settling, whether a pickup truck can do the hauling, and how HARDROCK prices a delivered load.</p>
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

<!-- ============ RELATED ============ -->
<section class="section bl-related" aria-label="Related services and articles">
  <div class="container">
    <div class="blog-post__related-services">
      <div class="section-title reveal-up">
        <span class="eyebrow-label">Related services</span>
        <h2>Which HARDROCK pages go with a driveway job?</h2>
        <p>These HARDROCK pages cover the driveway materials and work behind the arithmetic above, plus the local page for Sherman, where the ground and the roads decide how the job is delivered.</p>
      </div>
      <ul class="bl-links">
        <li><a href="/services/driveways/"><?php echo icon('route', 22); ?><b>Gravel driveways</b><span>The full build, layer by layer</span></a></li>
        <li><a href="/services/road-base/"><?php echo icon('milestone', 22); ?><b>Road base</b><span>The compacted lower layer</span></a></li>
        <li><a href="/services/57-67-rock/"><?php echo icon('mountain', 22); ?><b>57 and 67 rock</b><span>The drainage and top course</span></a></li>
        <li><a href="/service-areas/sherman/"><?php echo icon('map-pin', 22); ?><b>Sherman delivery</b><span>Roads and ground in town</span></a></li>
        <li><a href="/contact/"><?php echo icon('phone', 22); ?><b>Contact HARDROCK</b><span>Call or send the form</span></a></li>
      </ul>
    </div>
    <?php if ($blRelated): ?>
    <div class="blog-post__related-articles">
      <div class="section-title reveal-up">
        <span class="eyebrow-label">Related articles</span>
        <h2>What should you read after this guide?</h2>
        <p>The other HARDROCK guide covers repairing a gravel driveway after heavy rain in Grayson County: the order of work, the rock to use and how to keep the next storm from washing the drive out again.</p>
      </div>
      <div class="blog-grid"><?php foreach ($blRelated as $blRel) echo blog_card($blRel); ?></div>
    </div>
    <?php endif; ?>
  </div>
</section>

</article>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Ready to order driveway gravel?',
    'Call HARDROCK Sand and Gravel with the size of the drive and the address. HARDROCK checks the cubic yards, prices the load by phone and sets a delivery day.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
