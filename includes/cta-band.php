<?php
/**
 * includes/cta-band.php — compact mid-page estimate band (CLAUDE.md "Lead Form Placement": About, FAQ and blog posts
 * get ONE of these after the first content section, never a hero form). Partial: include it after setting
 *   $ctaBandTitle  (HTML, may hold <span class="text-accent">)   $ctaBandCopy  (plain text, one or two sentences)
 * Form id on the page is "cta-band". Layout: copy about a third, form card about two thirds, fields three-up
 * (name | phone | email / service | button / consent | footnote). Styles live in includes/inner-page.css.
 * Needs config.php ($formAction, $phone, $phoneE164) and functions.php; loop variables are prefixed ($ctaBand…).
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
?>
<section class="cta-band texture-grain" id="estimate" aria-labelledby="cta-band-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="cta-band__grid">
      <div class="cta-band__copy reveal-left">
        <span class="eyebrow">Free estimate</span>
        <h2 id="cta-band-title"><?php echo $ctaBandTitle; ?></h2>
        <p><?php echo esc($ctaBandCopy); ?></p>
        <a class="link-call" href="tel:<?php echo esc($phoneE164); ?>"><?php echo icon('phone', 18); ?>or call <?php echo esc(formatPhone($phone)); ?></a>
      </div>
      <div class="cta-band__card reveal-right">
        <form class="cta-band__form" action="<?php echo esc($formAction); ?>" method="POST">
          <?php echo p1_lead_hidden_fields('cta-band'); ?>
          <div class="field"><label for="cta-band-name">Name</label><input id="cta-band-name" type="text" name="name" autocomplete="name" required></div>
          <div class="field"><label for="cta-band-phone">Phone</label><input id="cta-band-phone" type="tel" name="phone" autocomplete="tel" inputmode="tel" required></div>
          <div class="field"><label for="cta-band-email">Email</label><input id="cta-band-email" type="email" name="email" autocomplete="email" required></div>
          <div class="field"><label for="cta-band-service">Material or service</label><select id="cta-band-service" name="service"><?php echo p1_service_options(); ?></select></div>
          <button type="submit" class="btn btn-primary btn-lg cta-band__submit">Get my free estimate</button>
          <div class="cta-band__consent"><?php echo p1_consent_row('cta-band'); ?></div>
          <p class="form-footnote">No obligation. Consent is not a condition of purchase.</p>
        </form>
      </div>
    </div>
  </div>
</section>
