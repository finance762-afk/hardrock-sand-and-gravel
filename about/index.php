<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/inner-page.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';

$pageTitle       = 'About Hardrock Sand And Gravel | Sherman, TX Supplier';
$pageDescription = 'Hardrock Sand And Gravel, owned by Dean Jones, has supplied bulk gravel, sand, rock and fill dirt around Sherman, TX since ' . $yearEstablished . '. See how the business works.';
$canonicalUrl    = $siteUrl . '/about/';
$ogImage         = '/assets/images/rip-rap-crew-skid-steer.jpg';
$currentPage     = 'about';
$pageType        = 'about';
$headerDark      = true;
$bodyClass       = 'sp-page';

$heroImage   = 'rip-rap-crew-skid-steer';
$heroPreload = sp_hero_preload($heroImage);
$spCall      = formatPhone($phone);
$spTel       = 'tel:' . $phoneE164;

/* Schema: AboutPage -> homepage #organization, plus breadcrumb. No ratings, no credentials that intake does not hold. */
$pageSchemas = [ip_webpage_schema('AboutPage', 'About ' . $siteName, '/about/', $pageDescription)];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/inner-page.css'; ?></style>
<style>
/* ==========================================================================
   /about/ — page-specific composition
   Signature: the "at a glance" band, four verifiable facts beside a three-stop timeline.
   ========================================================================== */
.ab-hero .hero-bg img { object-position: 50% 40%; }
.ab-hero .hero-text { max-width: 46rem; }
.ab-hero .hero-title { max-width: 24ch; }
.ab-hero .ab-hero__actions { display: flex; flex-wrap: wrap; gap: var(--space-sm) var(--space-lg); align-items: center; }
.ab-hero .ab-hero__actions .btn-primary { background: var(--color-accent); border-color: var(--color-accent); }

/* --- Story: copy + framed photo --- */
.ab-story { background: var(--color-paper); }
.ab-story .answer-block { max-width: none; }
.ab-story .sp-expert__copy h2 { max-width: 22ch; }
.ab-story .sp-photo picture { aspect-ratio: 4 / 4.6; }
.ab-story .sp-photo img { object-position: 50% 55%; }

/* --- How HARDROCK works: lead column + 2x2 cards --- */
.ab-ways { background: var(--color-surface); }
.ab-ways .sp-problem__lead .btn { justify-self: start; }
.ab-ways .sp-sign svg { width: var(--space-8); height: var(--space-8); }

/* --- At a glance: dark band, facts left, timeline right --- */
.ab-glance { background: linear-gradient(115deg, var(--color-dark) 0%, var(--color-dark-alt) 100%); }
.ab-glance__grid > div:first-child, .ab-verify__grid > div:first-child { display: grid; gap: var(--space-md); align-content: start; }
.ab-glance__grid { display: grid; grid-template-columns: minmax(0, 1.15fr) minmax(0, 1fr); gap: var(--space-3xl); align-items: start; }
.ab-glance .answer-block { background: color-mix(in srgb, var(--color-white) 7%, transparent); color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.ab-facts { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: var(--space-md); margin: var(--space-lg) 0 0; padding: 0; list-style: none; }
.ab-facts li { display: grid; gap: var(--space-1); padding: var(--space-md); border-left: var(--space-1) solid var(--color-accent); background: color-mix(in srgb, var(--color-white) 6%, transparent); }
.ab-facts b { font-family: var(--font-heading); font-weight: 800; font-size: clamp(2rem, 1.4rem + 2vw, 3rem); line-height: 1; color: var(--color-white); }
.ab-facts span { font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 75%, transparent); }
.ab-glance .timeline { border-left-color: color-mix(in srgb, var(--color-white) 25%, transparent); margin: 0; padding-top: 0; padding-bottom: 0; }
.ab-glance .timeline > li::before { box-shadow: 0 0 0 var(--space-1) var(--color-dark); }
.ab-glance .timeline time { display: block; font-family: var(--font-accent); font-weight: 800; letter-spacing: .12em; text-transform: uppercase; font-size: var(--fs-small); color: var(--color-accent-bright); }
.ab-glance .timeline p { margin: var(--space-1) 0 0; color: color-mix(in srgb, var(--color-white) 85%, transparent); }
@media (max-width: 900px) { .ab-glance__grid { grid-template-columns: 1fr; gap: var(--space-2xl); } }
@media (max-width: 480px) { .ab-facts { grid-template-columns: 1fr; } }

/* --- Work you can see + verification --- */
.ab-work { background: var(--color-paper); }
.ab-work .sp-gallery-item { box-shadow: var(--shadow); }
.ab-work .sp-gallery-item img { transition: transform var(--transition-slow); }
.ab-work .sp-gallery-item:hover img { transform: scale(1.04); }
.ab-verify { background: var(--color-paper-2); }
.ab-verify__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); gap: var(--space-2xl); align-items: start; }
.ab-verify .sp-points { margin-top: var(--space-md); }
.ab-verify__actions { display: flex; flex-wrap: wrap; gap: var(--space-sm); margin-top: var(--space-lg); }
.ab-reviews { margin-top: var(--space-2xl); }
@media (max-width: 900px) { .ab-verify__grid { grid-template-columns: 1fr; } }
@media (prefers-reduced-motion: reduce) { .ab-work .sp-gallery-item img { transition: none; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior sp-hero ab-hero" aria-labelledby="ab-hero-title">
  <div class="hero-bg">
    <?php echo pictureTag($heroImage, 'Two workers setting limestone rip rap over black filter fabric on a bank while a skid steer brings more rock', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']); ?>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <?php echo ip_breadcrumb('About'); ?>
    <div class="hero-text hero-copy">
      <span class="eyebrow">About HARDROCK · <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
      <h1 class="hero-title" id="ab-hero-title">Sherman&rsquo;s <span class="text-accent">Sand, Gravel</span> and Site Work Supplier Since <?php echo esc($yearEstablished); ?></h1>
      <p class="hero-answer">Owned by <?php echo esc($ownerName); ?>, Hardrock Sand And Gravel is a veteran and woman owned supplier that has delivered bulk rock, sand and dirt around Sherman, TX since <?php echo esc($yearEstablished); ?> and takes on the drives, pads and ponds they go into.</p>
      <div class="ab-hero__actions">
        <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Get a free estimate</button>
        <a class="link-call" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($spCall); ?></a>
      </div>
      <ul class="hero-chips">
        <li><?php echo icon('calendar-check', 16); ?>Since <?php echo esc($yearEstablished); ?></li>
        <li><?php echo icon('badge-check', 16); ?>Veteran &amp; Woman Owned · HUB</li>
        <li><?php echo icon('map-pin', 16); ?>Delivery across five counties</li>
      </ul>
    </div>
  </div>
</section>

<article class="sp-article" aria-labelledby="ab-hero-title">

<!-- ============ STORY ============ -->
<section class="section ab-story" aria-labelledby="ab-story-title">
  <div class="container">
    <div class="sp-expert__grid">
      <div class="sp-expert__copy reveal-left">
        <span class="eyebrow">The company</span>
        <h2 id="ab-story-title">Who is Hardrock Sand And Gravel in Sherman, TX?</h2>
        <p class="answer-block">Hardrock Sand And Gravel is a veteran and woman owned Sherman, Texas supplier of bulk sand, gravel, rock and dirt, owned by <?php echo esc($ownerName); ?> and in business since <?php echo esc($yearEstablished); ?>. It delivers across Grayson, Collin, Denton, Fannin and Cooke counties, and it also takes on driveways, house pads, ponds and land clearing.</p>
        <p>Hardrock Sand And Gravel sells bulk materials: pea gravel, decomposed granite, pink granite, road base, 57 and 67 rock, fill dirt, mason sand, rip rap and river rock. It also arranges the work those materials go into. That pairing is why a call can start with &ldquo;I&rsquo;m putting in a driveway&rdquo; instead of a product name, and why one call can cover both the material and the base layer that goes under it.</p>
        <p>The business has been open since <?php echo esc($yearEstablished); ?>, which is <?php echo esc($yearsInBusiness); ?> years in business in <?php echo esc(date('Y')); ?>. <?php echo esc($ownerName); ?> owns Hardrock Sand And Gravel, a Veteran &amp; Woman Owned Business and a HUB (Historically Underutilized Business). The business works out of <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?>, and everything it sells is delivered: there is no customer pickup.</p>
        <p>Material is priced by the ton and by the yard, and a full load is 20 yards or 20 tons. The delivered price depends on the material, the amount and the delivery address, so HARDROCK works out the cubic yards with you before anything is loaded, then gives you a price and a delivery day. Driveways, pads, ponds and clearing always get a site visit before the quote, to check the elevation and the soil type. Browse <a href="/services/">all <?php echo count($services); ?> services</a> or read the <a href="/faq/">FAQ</a> first.</p>
      </div>
      <figure class="sp-photo reveal-right">
        <?php echo pictureTag('gravel-driveway-rural', 'Long tan gravel driveway cut across open pasture with a green tractor parked alongside', '(max-width: 900px) 100vw, 480px'); ?>
        <figcaption>A new gravel drive running out across open pasture.</figcaption>
      </figure>
    </div>
  </div>
</section>

<!-- ============ MID-PAGE ESTIMATE BAND (one per About page) ============ -->
<?php $ctaBandTitle = 'Tell us what you are <span class="text-accent">building</span>';
$ctaBandCopy  = 'Name the material or the job and the delivery address. HARDROCK calls back with a price and a delivery day.';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/cta-band.php'; ?>

<!-- ============ HOW HARDROCK WORKS (values) ============ -->
<section class="section sp-problem ab-ways" aria-labelledby="ab-ways-title">
  <div class="container">
    <div class="sp-problem__grid">
      <div class="sp-problem__lead reveal-left">
        <span class="eyebrow">How we work</span>
        <h2 id="ab-ways-title">How does Hardrock Sand And Gravel work with customers?</h2>
        <p class="answer-block">Hardrock Sand And Gravel follows four habits on every order: it prices your actual load by phone, checks the cubic yards before a truck is loaded, matches the material to the job, and keeps its deliveries inside Grayson, Collin, Denton, Fannin and Cooke counties.</p>
        <a class="btn btn-secondary" href="/services/">See every material and service</a>
      </div>
      <ul class="sp-signs">
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('phone', 32); ?><b>Priced by the ton or the yard</b><span>Material is priced by the ton and by the yard, and a full load is 20 yards or 20 tons. Amount and delivery address move the delivered number, so HARDROCK quotes your real load by phone.</span></li>
        <li class="sp-sign reveal-up reveal-delay-2"><?php echo icon('ruler', 32); ?><b>Quantity checked first</b><span>Length times width times depth, divided by 27, plus a little extra for settling. HARDROCK checks it with you before anything is loaded.</span></li>
        <li class="sp-sign reveal-up reveal-delay-3"><?php echo icon('layers', 32); ?><b>Material matched to the job</b><span>Road base under a drive, 57 rock in a drain, pea gravel on a path. Say what you are building and HARDROCK recommends the material.</span></li>
        <li class="sp-sign reveal-up reveal-delay-1"><?php echo icon('map-pin', 32); ?><b>Delivered across five counties</b><span>Grayson, Collin, Denton, Fannin and Cooke counties are the delivery area, and every order is delivered: there is no pickup, so a call about a drop on your road starts with a place HARDROCK already delivers to.</span></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ AT A GLANCE (signature) ============ -->
<section class="section on-dark texture-grain slant-top ab-glance" aria-labelledby="ab-glance-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="ab-glance__grid">
      <div class="reveal-left">
        <span class="eyebrow">By the numbers</span>
        <h2 id="ab-glance-title">How long has Hardrock Sand And Gravel been in business?</h2>
        <p class="answer-block">Hardrock Sand And Gravel has been in business in Sherman, TX since <?php echo esc($yearEstablished); ?>, which makes <?php echo esc($yearsInBusiness); ?> years. Today it offers <?php echo count($services); ?> services: bulk materials, delivery and four kinds of site work, delivered across five North Texas counties.</p>
        <ul class="ab-facts">
          <li><b><?php echo esc($yearEstablished); ?></b><span>Year Hardrock Sand And Gravel opened</span></li>
          <li><b><?php echo count($services); ?></b><span>Services, from pea gravel to land clearing</span></li>
          <li><b>20</b><span>Yards or tons in a full load, delivery only</span></li>
          <li><b>5</b><span>Counties served: Grayson, Collin, Denton, Fannin, Cooke</span></li>
        </ul>
      </div>
      <ol class="timeline reveal-right">
        <li><time datetime="<?php echo esc($yearEstablished); ?>"><?php echo esc($yearEstablished); ?></time><p>Hardrock Sand And Gravel opens in <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?>.</p></li>
        <li><time>Today</time><p>Bulk materials including decomposed and pink granite, delivery across five counties, and four kinds of site work: driveways, house pads, ponds and land clearing.</p></li>
        <li><time>Hours</time><p>Monday to Thursday 6 AM to 5 PM, Friday 9 AM to 5 PM, Saturday 9 AM to 2 PM, closed Sunday.</p></li>
      </ol>
    </div>
  </div>
</section>

<!-- ============ WORK YOU CAN SEE ============ -->
<section class="section ab-work" aria-labelledby="ab-work-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Recent work</span>
      <h2 id="ab-work-title">What does Hardrock Sand And Gravel work look like on the ground?</h2>
      <p class="answer-block">Hardrock Sand And Gravel&rsquo;s jobs around Grayson County include pond basins dug between trees, crushed rock spread across graded pads, rip rap rolled out over filter fabric, and a flagstone patio with decomposed granite in the joints. These photos show jobs as they look while the work is happening.</p>
    </div>
    <div class="sp-gallery-grid reveal-up">
      <figure class="sp-gallery-item"><?php echo pictureTag('pond-excavation-trees', 'Pond basin dug out of grey clay among standing trees', '(max-width: 700px) 100vw, 600px'); ?><figcaption>A pond basin dug out between mature trees</figcaption></figure>
      <figure class="sp-gallery-item"><?php echo pictureTag('excavator-crushed-rock-pad', 'Yellow excavator working a pile of crushed rock on a graded pad', '(max-width: 700px) 100vw, 440px'); ?><figcaption>Excavator spreading crushed rock on a graded pad</figcaption></figure>
      <figure class="sp-gallery-item"><?php echo pictureTag('rip-rap-slope-filter-fabric', 'Workers rolling filter fabric down a cleared bank before placing rip rap', '(max-width: 700px) 100vw, 440px'); ?><figcaption>Filter fabric goes down the bank before the rock goes on</figcaption></figure>
    </div>
  </div>
</section>

<!-- ============ VERIFY HARDROCK (credentials: only what the owner has confirmed) ============ -->
<?php /* Credentials confirmed by Dean Jones, VP Operations, 2026-10-16: Veteran & Woman Owned Business, HUB (Historically Underutilized Business), $1M general liability + umbrella insurance, contractor accounts on Net 30 terms. No certification numbers were supplied, so none are shown. Never add a credential the owner has not confirmed. */ ?>
<section class="section ab-verify edge-curve-top" aria-labelledby="ab-verify-title">
  <div class="container">
    <div class="ab-verify__grid">
      <div class="reveal-left">
        <span class="eyebrow">Check us out</span>
        <h2 id="ab-verify-title">Can you check out Hardrock Sand And Gravel before you order?</h2>
        <p class="answer-block">Yes. Hardrock Sand And Gravel is a Veteran &amp; Woman Owned Business and a HUB (Historically Underutilized Business), carries $1M general liability and umbrella insurance, and has a public Google Business Profile in Sherman, TX where customers leave reviews. The same phone number, email and hours you see on this site are listed there. Read what other customers wrote, then call.</p>
        <div class="ab-verify__actions">
          <a class="btn btn-primary" href="<?php echo esc($gbp['share_url']); ?>" target="_blank" rel="noopener">See HARDROCK on Google</a>
          <a class="btn btn-secondary" href="<?php echo esc($gbp['review_url']); ?>" target="_blank" rel="noopener">Leave a Google review</a>
        </div>
      </div>
      <ul class="sp-points reveal-right">
        <li><?php echo icon('badge-check', 22); ?><span><b>Veteran &amp; Woman Owned Business.</b> Hardrock Sand And Gravel is also a HUB (Historically Underutilized Business).</span></li>
        <li><?php echo icon('shield-check', 22); ?><span><b>Insured.</b> $1M general liability and umbrella insurance.</span></li>
        <li><?php echo icon('handshake', 22); ?><span><b>Contractor accounts.</b> Available on Net 30 terms; ask on the phone before your first order.</span></li>
        <li><?php echo icon('calendar-check', 22); ?><span><b>In business since <?php echo esc($yearEstablished); ?>.</b> <?php echo esc($yearsInBusiness); ?> years delivering across Grayson County and its neighbors, with a public Google Business Profile where customers leave reviews.</span></li>
        <li><?php echo icon('phone', 22); ?><span><b>A real number to call.</b> <a href="<?php echo esc($spTel); ?>"><?php echo esc($spCall); ?></a>, Monday to Saturday, or email <a href="mailto:<?php echo esc($email); ?>"><?php echo esc($email); ?></a>.</span></li>
      </ul>
    </div>
    <?php /* Google reviews from the Page One feed; renders nothing while the feed is empty */
    $abReviews = p1_google_reviews($slug, ['heading' => 'What ' . $address['city'] . ' customers say on Google']);
    if ($abReviews !== ''): ?>
    <div class="ab-reviews"><?php echo $abReviews; ?></div>
    <?php endif; ?>
  </div>
</section>

</article>

<?php echo sp_final_cta('Ready to talk <span class="text-accent">gravel, sand or site work</span>?', 'Call ' . $spCall . ' or send the estimate form. Hardrock Sand And Gravel quotes by phone and sets a delivery day anywhere in Grayson, Collin, Denton, Fannin and Cooke counties.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
