<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
http_response_code(404);   /* real 404 status — Apache serves this file through ErrorDocument 404 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';

$pageTitle       = 'Page Not Found | HARDROCK Sand and Gravel, Sherman TX';
$pageDescription = 'That page is not on the HARDROCK Sand and Gravel site. Find gravel, sand, rock and dirt delivery in Sherman, TX, or call ' . formatPhone($phone) . '.';
$canonicalUrl    = $siteUrl . '/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'other';
$pageType        = 'other';
$noindex         = true;
$headerDark      = true;

$nfCall = formatPhone($phone);
$nfTel  = 'tel:' . $phoneE164;

/* Popular destinations: every href is a page that exists on disk (link integrity) */
$nfPopular = [
    ['href' => '/services/',              'icon' => 'layers',   'label' => 'All services',          'note' => 'Eight materials plus driveways, pads, ponds and clearing'],
    ['href' => '/services/delivery/',     'icon' => 'truck',    'label' => 'Gravel delivery',       'note' => 'Bulk loads to Sherman, Denison and Grayson County'],
    ['href' => '/services/road-base/',    'icon' => 'milestone','label' => 'Road base',             'note' => 'The firm layer under drives and pads'],
    ['href' => '/services/pea-gravel/',   'icon' => 'footprints','label' => 'Pea gravel',           'note' => 'Walkways, beds, play areas and drainage'],
    ['href' => '/faq/',                   'icon' => 'info',     'label' => 'Questions and answers', 'note' => 'Pricing, cubic yards, 57 vs 67 rock'],
    ['href' => '/contact/',               'icon' => 'phone',    'label' => 'Contact HARDROCK',      'note' => 'Call, email or send the form'],
];
/* "Search suggestion": the things people actually look for, as one-tap links */
$nfSearches = [
    ['gravel delivery', '/services/delivery/'], ['driveway gravel', '/services/driveways/'], ['fill dirt', '/services/fill-dirt/'],
    ['57 and 67 rock', '/services/57-67-rock/'], ['mason sand', '/services/mason-sand/'], ['rip rap', '/services/rip-rap/'],
    ['river rock', '/services/river-rock/'], ['decomposed granite', '/services/decomposed-granite/'], ['house pads', '/services/house-pads/'],
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style>
/* ==========================================================================
   404 — page-specific composition
   Signature: oversized "404" watermark behind a dark hero, six destination tiles below.
   ========================================================================== */
.nf-hero { position: relative; overflow: clip; isolation: isolate; padding-bottom: calc(clamp(2rem, 4vw, 3rem) + 3vw); clip-path: polygon(0 0, 100% 0, 100% calc(100% - 3vw), 0 100%); }
.nf-hero::after { content: "404"; position: absolute; right: -2vw; bottom: -4vw; z-index: -1; font-family: var(--font-heading); font-weight: 800; font-size: clamp(9rem, 28vw, 24rem); line-height: .8; color: var(--color-white); opacity: .06; pointer-events: none; }
.nf-hero .hero-text { position: relative; padding-left: var(--space-lg); max-width: 44rem; }
.nf-hero .hero-text::before { content: ""; position: absolute; left: 0; top: var(--space-xs); bottom: var(--space-xs); width: var(--space-1); background: linear-gradient(to bottom, var(--color-accent), color-mix(in srgb, var(--color-accent) 10%, transparent)); }
.nf-hero h1 { text-transform: uppercase; letter-spacing: .01em; line-height: 1.04; text-wrap: balance; }
.nf-hero .nf-actions { display: flex; flex-wrap: wrap; gap: var(--space-sm) var(--space-lg); align-items: center; }
.nf-hero .nf-actions .btn-primary { background: var(--color-accent); border-color: var(--color-accent); }

.nf-popular { background: var(--color-paper); }
.nf-popular h2, .nf-find h2 { text-transform: uppercase; letter-spacing: .015em; text-wrap: balance; }
.nf-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-md); margin: 0; padding: 0; list-style: none; }
.nf-grid a { display: grid; grid-template-columns: auto 1fr; gap: var(--space-xs) var(--space-md); align-items: center; height: 100%; padding: var(--space-lg); border-radius: var(--radius-sm); border: 1px solid var(--color-line); text-decoration: none; color: var(--color-ink); box-shadow: var(--shadow-sm); transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition); }
.nf-grid li:nth-child(3n+1) a { background: var(--color-card-tint-1); }
.nf-grid li:nth-child(3n+2) a { background: var(--color-card-tint-2); }
.nf-grid li:nth-child(3n) a { background: var(--color-card-tint-3); }
.nf-grid a:hover, .nf-grid a:focus-visible { transform: translateY(calc(-1 * var(--space-1))); box-shadow: var(--shadow); border-color: var(--color-accent); }
.nf-grid svg { grid-row: span 2; color: var(--color-accent-dark); }
.nf-grid b { font-family: var(--font-heading); font-size: 1.2rem; text-transform: uppercase; letter-spacing: .02em; }
.nf-grid span { font-size: var(--fs-small); color: var(--color-ink-2); }

.nf-find { background: var(--color-surface); }
.nf-find__grid > div:first-child { display: grid; gap: var(--space-md); align-content: start; justify-items: start; }
.nf-find__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.2fr); gap: var(--space-2xl); align-items: center; }
.nf-tags { display: flex; flex-wrap: wrap; gap: var(--space-xs); margin: 0; padding: 0; list-style: none; }
.nf-tags a { display: inline-flex; align-items: center; min-height: 2.75rem; padding: 0 var(--space-md); border-radius: var(--radius-full); border: 1px solid color-mix(in srgb, var(--color-accent) 45%, var(--color-line)); background: var(--color-card-tint-3); color: var(--color-accent-dark); font-weight: 600; font-size: var(--fs-small); text-decoration: none; transition: background-color var(--transition), color var(--transition); }
.nf-tags a:hover, .nf-tags a:focus-visible { background: var(--color-accent-dark); color: var(--color-white); }

@media (max-width: 900px) { .nf-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } .nf-find__grid { grid-template-columns: 1fr; } }
@media (max-width: 560px) { .nf-grid { grid-template-columns: 1fr; } .nf-hero .hero-text { padding-left: var(--space-md); } }
@media (prefers-reduced-motion: reduce) { .nf-grid a { transition: none; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--type hero--interior texture-grain nf-hero" aria-labelledby="nf-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-text hero-copy">
      <span class="eyebrow">Error 404 · Page not found</span>
      <h1 class="hero-title" id="nf-title">That load went <span class="text-accent">somewhere else</span></h1>
      <p class="hero-answer">The page you wanted is not on the HARDROCK Sand and Gravel site, but the gravel, sand and dirt are still a call away in Sherman, TX.</p>
      <div class="nf-actions">
        <a class="btn btn-primary btn-lg" href="/">Back to the homepage</a>
        <a class="link-call" href="<?php echo esc($nfTel); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc($nfCall); ?></a>
      </div>
    </div>
  </div>
</section>

<!-- ============ POPULAR PAGES ============ -->
<section class="section nf-popular" aria-labelledby="nf-popular-title">
  <div class="container">
    <div class="section-title">
      <span class="eyebrow-label">Start here</span>
      <h2 id="nf-popular-title">Which page were you looking for?</h2>
      <p class="answer-block">These are the pages visitors to HARDROCK Sand and Gravel open most: the full list of materials and services, gravel delivery in Sherman, the two most-ordered base materials, the FAQ and the contact page.</p>
    </div>
    <ul class="nf-grid">
      <?php foreach ($nfPopular as $nfLink): ?>
      <li><a href="<?php echo esc($nfLink['href']); ?>"><?php echo icon($nfLink['icon'], 30); ?><b><?php echo esc($nfLink['label']); ?></b><span><?php echo esc($nfLink['note']); ?></span></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- ============ SEARCH SUGGESTION ============ -->
<section class="section nf-find edge-curve-top" aria-labelledby="nf-find-title">
  <div class="container">
    <div class="nf-find__grid">
      <div>
        <span class="eyebrow">Looking for a material?</span>
        <h2 id="nf-find-title">Can&rsquo;t find the gravel, sand or rock you need?</h2>
        <p class="answer-block">Pick the material or job below to open its page, or call <?php echo esc($nfCall); ?> and describe what you are building. HARDROCK Sand and Gravel will point you to the right material and price it by phone.</p>
        <a class="btn btn-secondary" href="/contact/">Send HARDROCK a message</a>
      </div>
      <ul class="nf-tags" aria-label="Popular searches">
        <?php foreach ($nfSearches as $nfTag): ?>
        <li><a href="<?php echo esc($nfTag[1]); ?>"><?php echo esc($nfTag[0]); ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<?php echo sp_final_cta('Skip the search and <span class="text-accent">call HARDROCK</span>', 'HARDROCK Sand and Gravel answers the phone Monday through Saturday and prices every order by phone for Sherman, Denison and Grayson County.', 'Contact HARDROCK'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
