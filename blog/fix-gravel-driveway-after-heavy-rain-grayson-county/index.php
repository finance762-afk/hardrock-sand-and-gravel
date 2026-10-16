<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/blog-helpers.php';
?>
<?php
/* ==========================================================================
   Post sources (2026-10-15): repair quantity arithmetic is worked in the text (27 cubic feet per cubic yard);
   the road base / 57 rock / fabric method matches /services/driveways/, /services/road-base/ and /services/rip-rap/ on this site;
   Grayson County soils and drainage (blackland south, Post Oak Belt north, creeks): https://www.tshaonline.org/handbook/entries/grayson-county ;
   blackland prairie "a dominant feature for much of the county": https://www.co.grayson.tx.us/page/hist.home ;
   average annual precipitation of 37 inches (Handbook) vs 43.6 inches in 2019 (Texas Almanac) — the post says "near 37 inches" and notes wet years run higher.
   No HARDROCK prices or response times are quoted. The rip rap method (fabric, skid steer, hand-set stone) is described on /services/rip-rap/.
   ========================================================================== */

/* ---- Page setup ------------------------------------------------------------------------------- */
$blSlug          = 'fix-gravel-driveway-after-heavy-rain-grayson-county';
$blPost          = blog_post($blSlug);
$pageTitle       = $blPost['title'];
$pageDescription = 'Let a rain-soaked gravel driveway dry, rake it back, fill ruts with road base and armor the culvert. A Grayson County, Texas repair guide from HARDROCK.';
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
    ['q' => 'How long should I wait before regrading a wet gravel driveway?',
     'a' => 'Wait until the surface is firm enough that a boot no longer sinks and the rock stops rolling under a vehicle. Working soaked gravel and clay together smears the two into mud, so patience saves material. How long that takes depends on the soil and the weather.'],
    ['q' => 'Can I fix a washed-out driveway with pea gravel?',
     'a' => 'Pea gravel is a poor repair for a drive. The stones are rounded, so they shift under tires instead of locking together. Packed road base fills the washout, and crushed 57 rock goes on top; both are on HARDROCK\'s product list.'],
    ['q' => 'Can HARDROCK deliver rock to repair a washout?',
     'a' => 'Yes. HARDROCK Sand and Gravel delivers road base, 57 and 67 rock and rip rap in Sherman, Denison and Grayson County, and also builds gravel driveways. Call ' . $spCall . ' with the address and the size of the damage and the load is priced by phone.'],
];
$pageSchemas = [blog_post_schema($blPost, $pageDescription, 'gravel driveway repair, washed out gravel driveway, driveway after heavy rain, road base, rip rap, culvert, Grayson County TX')];
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
/* /blog/fix-gravel-driveway-after-heavy-rain-grayson-county/ — page-specific: the numbered repair sequence is the signature block */
.bl-hero--rain .blog-post__header { max-width: 52rem; }
.bl-hero--rain::before { content: ""; position: absolute; inset: 0; z-index: -1; pointer-events: none;
  background: repeating-linear-gradient(-45deg, transparent 0 var(--space-xl), color-mix(in srgb, var(--color-white) 3%, transparent) var(--space-xl) calc(var(--space-xl) + var(--space-1))); }
.bl-figure { margin: var(--space-lg) 0; }
.bl-figure picture { display: block; aspect-ratio: 16 / 10; border-radius: var(--radius-sm); overflow: hidden; box-shadow: var(--shadow); }
.bl-figure img { width: 100%; height: 100%; object-fit: cover; margin: 0; border-radius: 0; }
.bl-figure figcaption { margin-top: var(--space-xs); font-size: var(--fs-small); color: var(--color-muted); }
</style>

<!-- ============ POST HEADER ============ -->
<section class="hero hero--interior texture-grain bl-hero bl-hero--rain" aria-labelledby="bl-title">
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
        <p class="answer-block">Let the gravel driveway dry, rake displaced rock back from the edges, fill ruts and potholes with packed road base, and clear the ditch or culvert before the next storm. A true washout needs road base compacted in first, not loose stone dumped on top.</p>
        <p>HARDROCK Sand and Gravel, a supplier in Sherman, TX since 2019, delivers the road base, crushed rock and rip rap these repairs use. This guide covers what heavy rain does to a gravel drive in Grayson County, how to repair it in order, and how much rock a patch takes.</p>
        <p>Building a new drive instead? Start with <a href="<?php echo esc(blog_url('how-much-gravel-for-a-driveway-sherman-tx')); ?>">how much gravel a driveway needs</a>.</p>
      </div>
      <figure class="blog-post__featured-image reveal-right">
        <?php echo pictureTag(blog_image_base($blPost['image']), $blPost['alt'], '(max-width: 900px) 100vw, 480px'); ?>
      </figure>
    </div>
  </div>
</section>

<!-- ============ MID-PAGE ESTIMATE BAND ============ -->
<?php $ctaBandTitle = 'Drive washed <span class="text-accent">out</span>? Get a price.';
$ctaBandCopy = 'Send the address and the size of the damage and HARDROCK Sand and Gravel prices the repair rock by phone.';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/cta-band.php'; ?>

<!-- ============ BODY ============ -->
<section class="section bl-body" aria-label="Article">
  <div class="container">
    <div class="bl-layout">
      <div class="blog-post__content">

        <h2 id="damage">What does heavy rain do to a gravel driveway?</h2>
        <p class="answer-block">Heavy rain moves water across and under a gravel drive, and the water takes rock and soil with it. The common damage is ruts where tires pressed into wet ground, potholes where soft clay worked up through thin rock, edges that slumped, and washouts where runoff cut a channel.</p>
        <p>Grayson County makes this more likely on many lots. The county's own history page calls blackland prairie a dominant feature of much of the county, and clay like that goes soft when it soaks up water. The Handbook of Texas puts average rainfall near 37 inches a year, and wet years run higher: the Texas Almanac lists 43.6 inches for 2019. In the north, the Handbook describes loamy or sandy surface soils draining toward Lake Texoma and the Red River, where loose ground moves with runoff.</p>
        <p>The rock also gets pushed into the mud. Our <a href="/services/driveways/">gravel driveway page</a> explains why a drive with no firm base keeps losing rock into soft ground, and why the repair below starts with the base.</p>

        <h2 id="repair">How do you repair ruts and potholes in order?</h2>
        <p class="answer-block">Work in this order: wait for the surface to firm up, rake displaced rock back, cut out any soft spot, fill it with road base packed in thin layers, then top with crushed 57 rock. Skipping the base and topping up loose stone is the repair that fails again.</p>
        <ol class="bl-steps">
          <li><b>Wait for firm ground.</b> Working soaked gravel and clay together smears them into mud. Start once a boot no longer sinks.</li>
          <li><b>Rake the edges back.</b> Pull rock that was pushed to the sides or down the lane back toward the middle, and set aside what is clean.</li>
          <li><b>Dig out the soft spot.</b> Remove mud and loose fines from a pothole or rut down to firm ground, so you build on something solid.</li>
          <li><b>Fill with <a href="/services/road-base/">road base</a>.</b> Add it in thin layers, wet and compact each one. This is the layer that carries weight.</li>
          <li><b>Top with <a href="/services/57-67-rock/">57 rock</a>.</b> The crushed angular stone locks together, drains and gives tires grip. Rake it level with a slight crown so water runs off.</li>
        </ol>
        <figure class="bl-figure">
          <?php echo pictureTag('rip-rap-crew-skid-steer', 'Two workers setting rip rap on filter fabric while a skid steer brings more rock', '(max-width: 1000px) 100vw, 640px'); ?>
          <figcaption>Rip rap being set on filter fabric by hand while a skid steer brings more rock, the method described for culvert outlets and banks.</figcaption>
        </figure>

        <h2 id="water">How do you stop the next storm from washing the drive out again?</h2>
        <p class="answer-block">Give water somewhere to go. Keep a slight crown on the driveway so rain sheds to the sides, keep the ditch and culvert clear, and cover the culvert outlet and any cut bank with rip rap over filter fabric. Rock that heavy stays put where small gravel would travel downstream.</p>
        <p>The outlet is where many drives fail. Water leaving a culvert at speed digs a hole and undermines the road above it. <a href="/services/rip-rap/">Rip rap</a> set over fabric at that spot takes the energy out of the flow. HARDROCK sets rip rap on its own jobs the same way: the bank is cleared, fabric is rolled down the slope, rock is fed to the bank and the stones are hand-set so they lock together.</p>
        <p>Drives near the river and lake in northern Grayson County deal with more moving water; the <a href="/service-areas/denison/">Denison page</a> covers bank and drainage work there.</p>

        <h2 id="quantity">How much rock does a repair need?</h2>
        <p class="answer-block">A repair needs rock in proportion to the damage: multiply the length, width and depth of the damaged area in feet and divide by 27. A 4 by 10 foot rut filled 4 inches deep is 13.3 cubic feet, about half a cubic yard of rock. Add 5 to 10 percent for settling.</p>
        <p>Whole-drive numbers are in <a href="<?php echo esc(blog_url('how-much-gravel-for-a-driveway-sherman-tx')); ?>">the driveway quantity guide</a>, with worked examples from a house drive to a 200 foot lane. For patching, a half yard here and a yard there add up quickly, so list every bad stretch before you call.</p>

        <h2 id="call">When should you call a supplier instead of patching?</h2>
        <p class="answer-block">Call when damage runs over a long stretch, the same spot washes out after every storm, a culvert is undermined, or the base underneath has failed. At that point the repair is a rebuild: shaped subgrade, compacted road base and fresh top rock, sized in cubic yards.</p>
        <p>HARDROCK Sand and Gravel delivers the material or builds the drive; see <a href="/services/delivery/">delivery</a> for how an order works. Tell HARDROCK the address, the length of the damaged stretch and where the water goes, and the load is priced by phone. Call <a href="<?php echo esc($spTel); ?>"><?php echo esc($spCall); ?></a> Monday to Thursday from 6:00 AM, Friday from 9:00 AM or Saturday from 9:00 AM to 2:00 PM.</p>

      </div>

      <aside class="bl-aside" aria-label="Article sidebar">
        <nav class="bl-toc" aria-label="Table of contents">
          <h2>In this guide</h2>
          <ol>
            <li><a href="#damage">What rain does</a></li>
            <li><a href="#repair">Repair in order</a></li>
            <li><a href="#water">Stop the next washout</a></li>
            <li><a href="#quantity">How much rock</a></li>
            <li><a href="#call">When to call</a></li>
            <li><a href="#faq">Quick questions</a></li>
          </ol>
        </nav>
        <div class="bl-side-cta">
          <h2>Need repair rock?</h2>
          <p>HARDROCK Sand and Gravel delivers road base, 57 rock and rip rap in Sherman, Denison and Grayson County.</p>
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
      <h2 id="bl-faq-title">What else do people ask about repairing a rain-damaged drive?</h2>
      <p>Three questions follow the repair steps for a rain-damaged driveway: how long to wait before regrading, which gravel to avoid for the repair, and who can deliver the road base and rock.</p>
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
        <h2>Which HARDROCK pages go with a driveway repair?</h2>
        <p>These HARDROCK pages cover the materials behind each driveway repair step, plus the Grayson County page for ground conditions and drainage, so you can match the rock to the job before you call.</p>
      </div>
      <ul class="bl-links">
        <li><a href="/services/driveways/"><?php echo icon('route', 22); ?><b>Gravel driveways</b><span>Rebuilding a failed drive</span></a></li>
        <li><a href="/services/road-base/"><?php echo icon('milestone', 22); ?><b>Road base</b><span>The layer that carries weight</span></a></li>
        <li><a href="/services/rip-rap/"><?php echo icon('waves', 22); ?><b>Rip rap</b><span>Culvert outlets and banks</span></a></li>
        <li><a href="/service-areas/grayson-county/"><?php echo icon('map-pin', 22); ?><b>Grayson County</b><span>Ground conditions by area</span></a></li>
        <li><a href="/contact/"><?php echo icon('phone', 22); ?><b>Contact HARDROCK</b><span>Call or send the form</span></a></li>
      </ul>
    </div>
    <?php if ($blRelated): ?>
    <div class="blog-post__related-articles">
      <div class="section-title reveal-up">
        <span class="eyebrow-label">Related articles</span>
        <h2>What should you read after this guide?</h2>
        <p>The other HARDROCK guide covers how much gravel a driveway needs: the cubic-yard formula, three worked examples and the layers a Grayson County clay lot calls for before you place an order.</p>
      </div>
      <div class="blog-grid"><?php foreach ($blRelated as $blRel) echo blog_card($blRel); ?></div>
    </div>
    <?php endif; ?>
  </div>
</section>

</article>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Need rock to fix the drive?',
    'Call HARDROCK Sand and Gravel with the address and the size of the damage. HARDROCK prices the load by phone and sets a delivery day.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
