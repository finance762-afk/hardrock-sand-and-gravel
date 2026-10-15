<?php
/**
 * includes/header.php — skip link, glass navbar, mobile overlay menu, opens <main id="main-content">.
 * Loop variables are prefixed ($navSvc, $navArea) — pages own $svc, $area, $c, $card.
 * Optional page flag: $headerDark = true puts the bar on the dark variant (pages whose hero sits under it).
 */
$navCall    = formatPhone($phone);
$navTel     = 'tel:' . $phoneE164;
$navDark    = !empty($headerDark);
$navLogo    = siteLogo();
$navHomeLbl = esc($siteName) . ' — home';
?>
<a href="#main-content" class="skip-link">Skip to main content</a>

<header class="site-header<?php echo $navDark ? ' site-header--dark' : ''; ?>" data-header>
  <nav class="navbar" aria-label="Main navigation">
    <div class="navbar-inner container">
      <a class="site-logo brand<?php echo $navLogo ? '' : ' has-text-logo'; ?>" href="/" aria-label="<?php echo $navHomeLbl; ?>"<?php echo isActivePage('home') ? ' aria-current="page"' : ''; ?>>
        <?php echo logoMarkup(); ?>
      </a>

      <ul class="navbar-links">
        <li><a href="/"<?php echo ariaCurrent('home'); ?>>Home</a></li>
        <li class="has-dropdown">
          <a href="/services/"<?php echo ariaCurrent('services'); ?>>Services <?php echo icon('chevron-down', 14); ?></a>
          <ul class="dropdown dropdown--cols" style="display:none">
            <?php foreach ($services as $navSvc): ?>
            <li><a href="/services/<?php echo esc($navSvc['slug']); ?>/"><?php echo esc($navSvc['name']); ?></a></li>
            <?php endforeach; ?>
            <li class="dropdown-all"><a href="/services/">View all <?php echo count($services); ?> services</a></li>
          </ul>
        </li>
        <li class="has-dropdown">
          <a href="/service-areas/"<?php echo ariaCurrent('areas'); ?>>Service Areas <?php echo icon('chevron-down', 14); ?></a>
          <ul class="dropdown" style="display:none">
            <?php foreach ($serviceAreas as $navArea): ?>
            <li><a href="<?php echo esc(areaUrl(getAreaSlug($navArea))); ?>"><?php echo esc($navArea); ?></a></li>
            <?php endforeach; ?>
            <li class="dropdown-all"><a href="/service-areas/">View all service areas</a></li>
          </ul>
        </li>
        <li><a href="/about/"<?php echo ariaCurrent('about'); ?>>About</a></li>
        <li><a href="/blog/"<?php echo ariaCurrent('blog'); ?>>Blog</a></li>
        <li><a href="/contact/"<?php echo ariaCurrent('contact'); ?>>Contact</a></li>
      </ul>

      <div class="navbar-cta">
        <a class="btn btn-secondary navbar-phone" href="<?php echo esc($navTel); ?>"><?php echo icon('phone', 18); ?><span><?php echo esc($navCall); ?></span></a>
        <a class="btn btn-primary" href="/contact/" data-open-estimate>Free Estimate</a>
      </div>

      <button type="button" class="hamburger" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
      </button>
    </div>
  </nav>
</header>

<?php /* Mobile overlay lives OUTSIDE <header>: the header's backdrop-filter would become the containing block for position:fixed and shrink it to the bar height. main.js toggles .active + aria-hidden. */ ?>
<div class="mobile-menu" id="mobile-menu" aria-hidden="true">
  <div class="mobile-menu-inner">
    <nav aria-label="Mobile navigation">
      <ul class="mobile-menu-links">
        <li><a href="/"<?php echo ariaCurrent('home'); ?>>Home</a></li>
        <li>
          <a href="/services/"<?php echo ariaCurrent('services'); ?>>Services</a>
          <ul class="mobile-submenu">
            <?php foreach ($services as $navSvc): ?>
            <li><a href="/services/<?php echo esc($navSvc['slug']); ?>/"><?php echo esc($navSvc['name']); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li>
          <a href="/service-areas/"<?php echo ariaCurrent('areas'); ?>>Service Areas</a>
          <ul class="mobile-submenu">
            <?php foreach ($serviceAreas as $navArea): ?>
            <li><a href="<?php echo esc(areaUrl(getAreaSlug($navArea))); ?>"><?php echo esc($navArea); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li><a href="/about/"<?php echo ariaCurrent('about'); ?>>About</a></li>
        <li><a href="/blog/"<?php echo ariaCurrent('blog'); ?>>Blog</a></li>
        <li><a href="/contact/"<?php echo ariaCurrent('contact'); ?>>Contact</a></li>
      </ul>
    </nav>
    <div class="mobile-menu-cta">
      <a class="btn btn-accent btn-lg" href="<?php echo esc($navTel); ?>"><?php echo icon('phone', 20); ?><span>Call <?php echo esc($navCall); ?></span></a>
      <a class="btn btn-outline-white btn-lg" href="/contact/" data-open-estimate>Get a Free Estimate</a>
    </div>
  </div>
</div>

<main id="main-content">
