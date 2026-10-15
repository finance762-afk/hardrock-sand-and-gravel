<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/blog-helpers.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
$pageTitle       = 'Sand and Gravel Blog: Driveway & Rock Guides | HARDROCK';
$pageDescription = 'Plain-English guides from HARDROCK Sand and Gravel in Sherman, TX: how much gravel a driveway needs, repairing rain damage and choosing the right rock.';
$canonicalUrl    = $siteUrl . '/blog/';
$ogImage         = '/assets/images/' . blog_image_base($blogPosts[0]['image']) . '.jpg';
$currentPage     = 'blog';
$pageType        = 'blog';
$headerDark      = true;
$bodyClass       = 'sp-page bl-page';

$spCall = formatPhone($phone);
$blCats = array_values(array_unique(array_column($blogPosts, 'category')));
$blFeatured = $blogPosts[0];
$blRest = array_slice($blogPosts, 1);

$pageSchemas = [['@context' => 'https://schema.org', '@graph' => [
    [
        '@type' => 'Blog', '@id' => rtrim($siteUrl, '/') . '/blog/#blog', 'url' => $canonicalUrl, 'name' => $siteName . ' Blog', 'description' => $pageDescription,
        'publisher' => ['@id' => rtrim($siteUrl, '/') . '/#organization'], 'inLanguage' => 'en-US',
        'blogPost' => array_map(fn($p) => ['@type' => 'BlogPosting', '@id' => rtrim($siteUrl, '/') . blog_url($p['slug']) . '#post', 'headline' => $p['title'], 'url' => rtrim($siteUrl, '/') . blog_url($p['slug']), 'datePublished' => $p['dateISO']], $blogPosts),
    ],
    blog_breadcrumb_schema(),
]]];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/blog.css'; ?></style>
<style>
/* /blog/ — page-specific composition: featured latest post over an editorial grid */
.bli-hero .hero-text { max-width: 46rem; }
.bli-hero .hero-title { text-transform: uppercase; letter-spacing: .01em; line-height: 1.06; text-wrap: balance; }
.bli-more { margin-top: var(--space-3xl); }
.bli-more h2 { font-size: var(--fs-h3); text-transform: uppercase; letter-spacing: .03em; margin-bottom: var(--space-xs); }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--interior texture-grain bl-hero bli-hero" aria-labelledby="bli-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <?php echo blog_breadcrumb(); ?>
    <div class="hero-text hero-copy">
      <span class="eyebrow">The HARDROCK blog</span>
      <h1 class="hero-title" id="bli-title">Sand, Gravel and <span class="text-accent">Driveway</span> Guides for Sherman, TX</h1>
      <p class="hero-answer">HARDROCK Sand and Gravel answers the questions that come before an order: how much to buy, which rock to use and what Grayson County weather does to a drive. More guides are added over time.</p>
    </div>
  </div>
</section>

<!-- ============ POSTS (registry-driven) ============ -->
<section class="section bl-index" aria-labelledby="bli-posts-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Latest guide</span>
      <h2 id="bli-posts-title">What is HARDROCK's newest sand and gravel guide?</h2>
      <p class="answer-block">The newest guide is <a href="<?php echo esc(blog_url($blFeatured['slug'])); ?>"><?php echo esc($blFeatured['title']); ?></a>, filed under <?php echo esc($blFeatured['category']); ?>. Every guide is written for Sherman, Denison and Grayson County conditions, and each links to the HARDROCK material and service pages it refers to.</p>
      <?php if (count($blCats) > 1): ?>
      <ul class="bl-cats" aria-label="Blog categories"><?php foreach ($blCats as $blCat): ?><li><?php echo esc($blCat); ?></li><?php endforeach; ?></ul>
      <?php endif; ?>
    </div>
    <div class="reveal-up"><?php echo blog_card($blFeatured, '(max-width: 800px) 100vw, 560px', 'blog-card--featured'); ?></div>
    <?php if ($blRest): ?>
    <div class="bli-more">
      <h2>More guides</h2>
      <div class="blog-grid">
        <?php foreach ($blRest as $blRestPost) echo blog_card($blRestPost); ?>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- ============ FINAL CTA ============ -->
<?php echo sp_final_cta('Ready to price a load?',
    'Call HARDROCK Sand and Gravel or send the form with the material, the amount and the address. HARDROCK prices the load by phone and sets a delivery day.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
