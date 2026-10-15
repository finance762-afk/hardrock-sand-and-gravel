<?php
/**
 * includes/footer.php — closes <main>, site footer (4 columns, entity block, legal row, credit, partner badge),
 * estimate dialog, cookie banner, sticky mobile CTA bar, back-to-top, deferred scripts; closes </body></html>.
 * Loop variables are prefixed ($footSvc, $footArea, $footDay) — pages own $svc, $area, $c, $card.
 * No third-party scripts, no runtime icon injection (icons are inline SVG via icon()).
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';

$footCall  = formatPhone($phone);
$footTel   = 'tel:' . $phoneE164;
$footBase  = rtrim($siteUrl, '/');
$footAsset = '?v=' . ($cssVersion ?? '1');
$footLines = [];
if (($addressPublic ?? true) && !empty($address['street'])) $footLines[] = $address['street'];
$footLines[] = trim(($address['city'] ?? '') . ', ' . ($address['state'] ?? '') . (!empty($address['zip']) ? ' ' . $address['zip'] : ''), ' ,');
$footAddress = implode(', ', $footLines);
$footText    = preg_replace('/[^0-9+]/', '', (string) ($textUsNumber ?? ''));
$footHasText = strlen($footText) >= 10;
?>
</main>

<footer class="site-footer">
  <div class="footer-top">
    <div class="container">
      <div class="footer-grid">

        <div class="footer-col footer-brand">
          <a class="site-logo brand<?php echo siteLogo() ? '' : ' has-text-logo'; ?>" href="/" aria-label="<?php echo esc($siteName); ?> — home"><?php echo logoMarkup(true); ?></a>
          <p><?php echo esc($businessDescription); ?></p>
          <div class="footer-badges">
            <span>Since <?php echo esc($yearEstablished); ?></span>
            <span>Bulk delivery</span>
            <span><?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?></span>
          </div>
          <?php if (!empty($socialLinks)): ?>
          <ul class="footer-social" aria-label="Social media">
            <?php foreach ($socialLinks as $footNet => $footUrl): ?>
            <li><a href="<?php echo esc($footUrl); ?>" target="_blank" rel="noopener"><?php echo esc(ucfirst((string) $footNet)); ?></a></li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </div>

        <div class="footer-col">
          <h4>Materials &amp; Services</h4>
          <ul>
            <?php foreach ($services as $footSvc): ?>
            <li><a href="/services/<?php echo esc($footSvc['slug']); ?>/"><?php echo esc($footSvc['name']); ?></a></li>
            <?php endforeach; ?>
            <li><a href="/services/"><strong>View all <?php echo count($services); ?> services</strong></a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Service Areas</h4>
          <ul>
            <?php foreach ($serviceAreas as $footArea): ?>
            <li><a href="<?php echo esc(areaUrl(getAreaSlug($footArea))); ?>"><?php echo esc($footArea); ?></a></li>
            <?php endforeach; ?>
            <li><a href="/service-areas/"><strong>View all areas</strong></a></li>
          </ul>
          <h4 class="footer-subhead">Company</h4>
          <ul>
            <li><a href="/about/">About <?php echo esc($siteName); ?></a></li>
            <li><a href="/faq/">FAQ</a></li>
            <li><a href="/blog/">Blog</a></li>
            <li><a href="/contact/">Contact</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Contact</h4>
          <ul class="footer-contact">
            <li><?php echo icon('map-pin', 18); ?><span><?php echo esc($footAddress); ?></span></li>
            <li><?php echo icon('phone', 18); ?><a href="<?php echo esc($footTel); ?>"><?php echo esc($footCall); ?></a></li>
            <li><?php echo icon('mail', 18); ?><a href="mailto:<?php echo esc($email); ?>"><?php echo esc($email); ?></a></li>
          </ul>
          <h4 class="footer-subhead">Hours</h4>
          <dl class="footer-hours">
            <?php foreach ($hours as $footDay): ?>
            <div><dt><?php echo esc($footDay['day']); ?></dt><dd><?php echo esc($footDay['label']); ?></dd></div>
            <?php endforeach; ?>
          </dl>
          <a class="btn btn-accent footer-cta" href="/contact/" data-open-estimate>Get a Free Estimate</a>
        </div>

      </div>

      <!-- AEO entity block: same @id as the homepage JSON-LD so it merges instead of duplicating -->
      <div class="footer-entity" itemscope itemtype="https://schema.org/LocalBusiness" itemid="<?php echo esc($footBase); ?>/#organization">
        <meta itemprop="name" content="<?php echo esc($siteName); ?>">
        <meta itemprop="url" content="<?php echo esc($footBase); ?>/">
        <meta itemprop="telephone" content="<?php echo esc($phoneE164); ?>">
        <span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
          <meta itemprop="addressLocality" content="<?php echo esc($address['city']); ?>">
          <meta itemprop="addressRegion" content="<?php echo esc($address['state']); ?>">
        </span>
        <p><?php echo esc($siteName); ?> is a sand and gravel supplier in <?php echo esc($address['city']); ?>, <?php echo esc($address['state']); ?>, in business since <?php echo esc($yearEstablished); ?>. <?php echo esc($siteName); ?> delivers pea gravel, 57 and 67 rock, road base, decomposed granite, mason sand, river rock, rip rap and fill dirt to <?php echo esc(implode(', ', array_map(fn($footA) => preg_replace('/,\s*[A-Za-z]{2}$/', '', $footA), $serviceAreas))); ?>, and also handles driveways, house pads, ponds and land clearing. Call <a href="<?php echo esc($footTel); ?>"><?php echo esc($footCall); ?></a> for availability and pricing.</p>
      </div>
    </div>
  </div>

  <div class="footer-bottom footer-legal">
    <div class="container">
      <nav class="footer-legal-links footer-legal-row" aria-label="Legal">
        <a href="/privacy-policy/">Privacy Policy</a>
        <span class="footer-legal-divider divider" aria-hidden="true">|</span>
        <a href="/terms/">Terms of Service</a>
        <span class="footer-legal-divider divider" aria-hidden="true">|</span>
        <a href="/cookie-policy/">Cookie Policy</a>
        <span class="footer-legal-divider divider" aria-hidden="true">|</span>
        <a href="/accessibility/">Accessibility</a>
        <span class="footer-legal-divider divider" aria-hidden="true">|</span>
        <a href="/privacy-policy/#ccpa-rights">Do Not Sell or Share My Personal Information</a>
        <span class="footer-legal-divider divider" aria-hidden="true">|</span>
        <a href="/sitemap.xml">Sitemap</a>
      </nav>
      <div class="footer-bottom-bar footer-bottom-inner">
        <p>&copy; <?php echo date('Y'); ?> <?php echo esc($siteName); ?>. All rights reserved.</p>
        <p class="footer-credit"><a href="https://pageoneinsights.com" rel="dofollow" target="_blank">Web Design & Hosting by Page One Insights, LLC</a></p>
      </div>
    </div>
  </div>
  <?php include __DIR__ . '/partner-badge.php'; ?>
</footer>

<!-- Estimate dialog: any [data-open-estimate] opens it (main.js); without JS those links go to /contact/ -->
<dialog class="estimate-dialog" id="estimate-dialog" aria-labelledby="estimate-dialog-title">
  <div class="dialog-head">
    <h2 id="estimate-dialog-title">Get a free estimate</h2>
    <button type="button" class="dialog-close" data-close-estimate aria-label="Close estimate form"><?php echo icon('x', 20); ?></button>
  </div>
  <p class="dialog-sub">Tell us what you need hauled or built. <?php echo esc($siteName); ?> will call you back with availability and pricing.</p>
  <div class="dialog-body">
    <form class="estimate-form" action="<?php echo esc($formAction); ?>" method="POST">
      <?php echo p1_lead_hidden_fields('dialog'); ?>
      <div class="field">
        <label for="dialog-name">Your name</label>
        <input type="text" id="dialog-name" name="name" autocomplete="name" required>
      </div>
      <div class="form-grid">
        <div class="field">
          <label for="dialog-phone">Phone</label>
          <input type="tel" id="dialog-phone" name="phone" autocomplete="tel" inputmode="tel" required>
        </div>
        <div class="field">
          <label for="dialog-email">Email</label>
          <input type="email" id="dialog-email" name="email" autocomplete="email" required>
        </div>
      </div>
      <div class="field">
        <label for="dialog-service">Material or service</label>
        <select id="dialog-service" name="service"><?php echo p1_service_options(); ?></select>
      </div>
      <div class="field">
        <label for="dialog-message">Project details (optional)</label>
        <textarea id="dialog-message" name="message" rows="3" placeholder="Material, amount, delivery address"></textarea>
      </div>
      <?php echo p1_consent_row('dialog'); ?>
      <button type="submit" class="btn btn-primary btn-lg">Request My Estimate</button>
      <p class="form-footnote">Consent is not a condition of purchase. Message and data rates may apply if you reply by text.</p>
    </form>
  </div>
</dialog>

<div class="cookie-banner" id="cookie-banner" role="region" aria-label="Cookie notice">
  <p class="cookie-banner__text">We use cookies to improve your experience and analyze site usage. By continuing, you agree to our use of cookies. <a href="/cookie-policy/">Learn more</a>.</p>
  <button type="button" class="cookie-banner__dismiss" id="cookie-banner-dismiss" aria-label="Dismiss cookie notice">Got it</button>
</div>

<div class="mobile-cta-bar<?php echo $footHasText ? ' mobile-cta-bar--3' : ''; ?>" role="region" aria-label="Quick contact">
  <a class="mobile-cta-bar__call" href="<?php echo esc($footTel); ?>"><?php echo icon('phone', 20); ?><span>Call Now</span></a>
  <?php if ($footHasText): ?>
  <a class="mobile-cta-bar__text" href="sms:<?php echo esc($footText); ?>"><?php echo icon('mail', 20); ?><span>Text Us</span></a>
  <?php endif; ?>
  <a class="mobile-cta-bar__estimate" href="/contact/" data-open-estimate><span>Free Estimate</span></a>
</div>

<button type="button" class="back-to-top" aria-label="Back to top"><?php echo icon('chevron-down', 20); ?></button>

<script src="/assets/js/main.js<?php echo $footAsset; ?>" defer></script>
<script src="/assets/js/animations.js<?php echo $footAsset; ?>" defer></script>
<script src="/assets/js/effects.js<?php echo $footAsset; ?>" defer></script>
</body>
</html>
