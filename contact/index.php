<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/inner-page.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/legal-page.php';   /* legal_address() for the reach panel */

$pageTitle       = 'Contact Hardrock Sand And Gravel in Sherman, Texas';
$pageDescription = 'Call ' . formatPhone($phone) . ' or send the form to get a price and delivery day on bulk gravel, sand, rock or fill dirt in Sherman, Denison and Grayson County, TX.';
$canonicalUrl    = $siteUrl . '/contact/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'contact';
$pageType        = 'contact';
$headerDark      = true;
$bodyClass       = 'sp-page';

$spCall = formatPhone($phone);
$spTel  = 'tel:' . $phoneE164;
$ctCity = $address['city'] . ', ' . $address['state'];
/* Name + city query: reliably drops the Google listing pin without a street address (place_id embeds are not supported by this URL form) */
$ctMapSrc = 'https://www.google.com/maps?q=' . rawurlencode($siteName . ', ' . $ctCity) . '&output=embed';

$pageSchemas = [ip_webpage_schema('ContactPage', 'Contact ' . $siteName, '/contact/', $pageDescription, ['mainEntity' => ['@id' => rtrim($siteUrl, '/') . '/#organization']])];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?></style>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/inner-page.css'; ?></style>
<style>
/* ==========================================================================
   /contact/ — page-specific composition
   Signature: the form card beside a dark "reach us" panel with hours and the next-steps list.
   ========================================================================== */
.ct-hero { padding-bottom: calc(clamp(2rem, 4vw, 3rem) + 3vw); clip-path: polygon(0 0, 100% 0, 100% calc(100% - 3vw), 0 100%); }
.ct-hero .hero-text { position: relative; padding-left: var(--space-lg); max-width: 46rem; }
.ct-hero .hero-text::before { content: ""; position: absolute; left: 0; top: var(--space-xs); bottom: var(--space-xs); width: var(--space-1); background: linear-gradient(to bottom, var(--color-accent), color-mix(in srgb, var(--color-accent) 10%, transparent)); }
.ct-hero .hero-title { text-transform: uppercase; letter-spacing: .01em; line-height: 1.04; max-width: 24ch; }
.ct-hero .ct-hero__actions { display: flex; flex-wrap: wrap; gap: var(--space-sm) var(--space-lg); align-items: center; }
.ct-hero .ct-hero__actions .btn-primary { background: var(--color-accent); border-color: var(--color-accent); }

.ct-main { background: var(--color-paper); }
.ct-grid { display: grid; grid-template-columns: minmax(0, 1.3fr) minmax(0, 1fr); gap: var(--space-2xl); align-items: start; }
.ct-card { padding: var(--space-xl); border-radius: var(--radius-sm); background: var(--color-surface); border: 1px solid var(--color-line); border-top: var(--space-1) solid var(--color-accent); box-shadow: var(--shadow-lg); }
.ct-card h2 { font-size: var(--fs-h2); margin-bottom: var(--space-xs); }
.ct-card > p { margin: 0 0 var(--space-lg); color: var(--color-ink-2); max-width: 52ch; }
.ct-form { display: grid; gap: var(--space-md); }
.ct-form .form-grid { gap: var(--space-md); }
.ct-form .field textarea { min-height: 7rem; resize: vertical; }
.ct-form .req { color: var(--color-accent-dark); }
.ct-form .form-consent-fieldset { display: grid; gap: var(--space-xs); padding: var(--space-md); border: 1px solid var(--color-line); border-radius: var(--radius-sm); background: var(--color-paper-2); }
.ct-form .form-consent-item { margin: 0; }
.ct-form .btn { justify-self: start; }
.ct-form .form-footnote { margin: 0; font-size: var(--fs-small); color: var(--color-muted); }

.ct-side { position: sticky; top: calc(var(--nav-height) + var(--space-lg)); display: grid; gap: var(--space-lg); }
.ct-reach { position: relative; overflow: clip; isolation: isolate; display: grid; gap: var(--space-md); padding: var(--space-xl); border-radius: var(--radius-sm); background: var(--color-dark); color: var(--color-white); box-shadow: var(--shadow-lg); }
.ct-reach::before { content: ""; position: absolute; inset: 0 0 auto 0; height: var(--space-sm); background: repeating-linear-gradient(-45deg, var(--color-accent) 0 var(--space-sm), var(--color-dark) var(--space-sm) var(--space-lg)); }
.ct-reach h2 { margin-top: var(--space-sm); font-size: var(--fs-h3); color: var(--color-white); text-transform: uppercase; letter-spacing: .02em; }
.ct-phone { display: flex; align-items: center; gap: var(--space-sm); font-family: var(--font-heading); font-weight: 800; font-size: clamp(1.8rem, 1.3rem + 2vw, 2.6rem); line-height: 1; color: var(--color-white); text-decoration: none; }
.ct-phone svg { color: var(--color-accent-bright); flex: 0 0 auto; }
.ct-phone:hover, .ct-phone:focus-visible { color: var(--color-accent-bright); }
.ct-lines { display: grid; gap: var(--space-sm); margin: 0; padding: 0; list-style: none; }
.ct-lines li { display: grid; grid-template-columns: auto 1fr; gap: var(--space-sm); align-items: start; }
.ct-lines svg { color: var(--color-accent-bright); margin-top: var(--space-1); }
.ct-lines a { color: var(--color-white); overflow-wrap: anywhere; }
.ct-lines a:hover { color: var(--color-accent-bright); }
.ct-hours { display: grid; margin: 0; }
.ct-hours div { display: flex; justify-content: space-between; gap: var(--space-md); padding: var(--space-xs) 0; border-bottom: 1px dashed color-mix(in srgb, var(--color-white) 20%, transparent); }
.ct-hours dt { color: color-mix(in srgb, var(--color-white) 75%, transparent); }
.ct-hours dd { margin: 0; font-family: var(--font-accent); font-weight: 700; letter-spacing: .02em; }
.ct-hours .is-closed dd { color: var(--color-accent-bright); }
.ct-next { padding: var(--space-lg); border-radius: var(--radius-sm); background: var(--color-card-tint-3); border-left: var(--space-1) solid var(--color-accent); }
.ct-next h2 { font-size: var(--fs-h3); text-transform: uppercase; letter-spacing: .02em; }

.ct-map { background: var(--color-surface); }
.ct-map__grid > div:first-child { display: grid; gap: var(--space-md); align-content: start; }
.ct-map__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.6fr); gap: var(--space-2xl); align-items: center; }
.ct-map .map-embed { box-shadow: var(--shadow-lg); border: 1px solid var(--color-line); }
.ct-map__actions { display: flex; flex-wrap: wrap; gap: var(--space-sm); margin-top: var(--space-lg); }

@media (max-width: 960px) {
  .ct-grid, .ct-map__grid { grid-template-columns: 1fr; }
  .ct-side { position: static; }
}
@media (max-width: 560px) { .ct-hero .hero-text { padding-left: var(--space-md); } .ct-card { padding: var(--space-lg); } .ct-form .btn { justify-self: stretch; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--type hero--interior texture-grain ct-hero" aria-labelledby="ct-hero-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <?php echo ip_breadcrumb('Contact'); ?>
    <div class="hero-text hero-copy">
      <span class="eyebrow">Contact · <?php echo esc($ctCity); ?></span>
      <h1 class="hero-title" id="ct-hero-title">Contact <span class="text-accent">HARDROCK</span> Sand and Gravel in Sherman, TX</h1>
      <p class="hero-answer">Call <?php echo esc($spCall); ?> or send the form below. HARDROCK calls back with a price and a delivery day for Sherman, Denison and Grayson County.</p>
      <div class="ct-hero__actions">
        <a class="btn btn-primary btn-lg" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 20); ?>Call <?php echo esc($spCall); ?></a>
        <a class="link-call" href="#contact-form">or send the form</a>
      </div>
      <ul class="hero-chips">
        <li><?php echo icon('clock', 16); ?>Open 6 AM Mon–Thu</li>
        <li><?php echo icon('truck', 16); ?>Priced by phone</li>
        <li><?php echo icon('map-pin', 16); ?>Sherman · Denison · Grayson County</li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ FORM + REACH PANEL ============ -->
<section class="section ct-main" aria-labelledby="ct-form-title">
  <div class="container">
    <div class="ct-grid">

      <div class="ct-card reveal-left" id="contact-form">
        <h2 id="ct-form-title">How do I get a price from Hardrock Sand And Gravel?</h2>
        <p class="answer-block">Send the material or job, the delivery address and roughly how much you need. Hardrock Sand And Gravel calls back during business hours with a price and a delivery day. No obligation.</p>
        <form class="ct-form" action="<?php echo esc($formAction); ?>" method="POST">
          <?php echo p1_lead_hidden_fields('contact'); ?>
          <?php /* Standard names above (_honey, consent_version, consent_page) are what the leads endpoint reads; the underscore variants below are the build prompt's names, kept as harmless duplicates. */ ?>
          <input type="text" name="_honeypot" style="display:none" tabindex="-1" autocomplete="off" aria-hidden="true">
          <input type="hidden" name="_consent_version" value="v2.1">
          <input type="hidden" name="_consent_page" value="<?php echo esc($_SERVER['REQUEST_URI'] ?? '/contact/'); ?>">
          <input type="hidden" name="address_state" value="<?php echo esc($address['state']); ?>">

          <div class="field">
            <label for="contact-name">Your name <span class="req" aria-hidden="true">*</span></label>
            <input type="text" id="contact-name" name="name" autocomplete="name" required>
          </div>
          <div class="form-grid">
            <div class="field">
              <label for="contact-phone">Phone <span class="req" aria-hidden="true">*</span></label>
              <input type="tel" id="contact-phone" name="phone" autocomplete="tel" inputmode="tel" required>
            </div>
            <div class="field">
              <label for="contact-email">Email <span class="req" aria-hidden="true">*</span></label>
              <input type="email" id="contact-email" name="email" autocomplete="email" required>
            </div>
          </div>
          <div class="field">
            <label for="contact-service">Material or service</label>
            <select id="contact-service" name="service"><?php echo p1_service_options(); ?></select>
          </div>
          <div class="field">
            <label for="contact-street">Delivery or job address</label>
            <input type="text" id="contact-street" name="address_street" autocomplete="street-address" placeholder="Street address">
          </div>
          <div class="form-grid">
            <div class="field">
              <label for="contact-city">City</label>
              <input type="text" id="contact-city" name="address_city" autocomplete="address-level2">
            </div>
            <div class="field">
              <label for="contact-zip">ZIP</label>
              <input type="text" id="contact-zip" name="address_zip" autocomplete="postal-code" inputmode="numeric" maxlength="10">
            </div>
          </div>
          <div class="field">
            <label for="contact-message">Project details</label>
            <textarea id="contact-message" name="message" rows="4" placeholder="Material, how much (or the size of the area), when you need it"></textarea>
          </div>

          <?php echo consentFieldset('contact'); ?>

          <button type="submit" class="btn btn-primary btn-lg">Send my request</button>
          <p class="form-footnote">Fields marked * are required. We use your details only to answer this request; see the <a href="/privacy-policy/">Privacy Policy</a>.</p>
        </form>
      </div>

      <aside class="ct-side" aria-label="Ways to reach Hardrock Sand And Gravel">
        <div class="ct-reach reveal-right">
          <h2>Reach HARDROCK directly</h2>
          <a class="ct-phone" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 30); ?><?php echo esc($spCall); ?></a>
          <ul class="ct-lines">
            <li><?php echo icon('mail', 20); ?><a href="mailto:<?php echo esc($email); ?>"><?php echo esc($email); ?></a></li>
            <li><?php echo icon('map-pin', 20); ?><span><?php echo esc(legal_address()); ?><br>Serving Sherman, Denison and Grayson County</span></li>
          </ul>
          <h3 class="sr-only">Business hours</h3>
          <dl class="ct-hours">
            <?php foreach ($hours as $ctDay): ?>
            <div<?php echo $ctDay['opens'] ? '' : ' class="is-closed"'; ?>><dt><?php echo esc($ctDay['day']); ?></dt><dd><?php echo esc($ctDay['label']); ?></dd></div>
            <?php endforeach; ?>
          </dl>
        </div>

        <div class="ct-next reveal-right">
          <h2>What happens next</h2>
          <ol class="next-steps">
            <li><strong>HARDROCK reads your request.</strong>Calls come in during business hours, Monday through Saturday.</li>
            <li><strong>You get a call back.</strong>HARDROCK checks the material, the cubic yards and the address with you.</li>
            <li><strong>Price and delivery day.</strong>You hear the price and a delivery day by phone, before anything is loaded.</li>
          </ol>
        </div>
      </aside>

    </div>
  </div>
</section>

<!-- ============ MAP + DIRECTIONS ============ -->
<section class="section ct-map edge-curve-top" aria-labelledby="ct-map-title">
  <div class="container">
    <div class="ct-map__grid">
      <div class="reveal-left">
        <span class="eyebrow">Find us</span>
        <h2 id="ct-map-title">Where is Hardrock Sand And Gravel located?</h2>
        <p class="answer-block">Hardrock Sand And Gravel is based in <?php echo esc($ctCity); ?> and delivers to Grayson, Collin, Denton, Fannin and Cooke counties. Every order is delivered: there is no customer pickup, so there is no need to drive out. Call <?php echo esc($spCall); ?> with your delivery address instead.</p>
        <div class="ct-map__actions">
          <a class="btn btn-primary" href="<?php echo esc($gbp['directions']); ?>" target="_blank" rel="noopener"><?php echo icon('map-pin', 18); ?>Get directions</a>
          <a class="btn btn-secondary" href="<?php echo esc($spTel); ?>"><?php echo icon('phone', 18); ?>Call first</a>
        </div>
      </div>
      <div class="map-embed reveal-right">
        <iframe title="Map of Hardrock Sand And Gravel in <?php echo esc($ctCity); ?>" src="<?php echo esc($ctMapSrc); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</section>

<?php echo sp_final_cta('Need sand, gravel or dirt <span class="text-accent">on the ground</span>?', 'Call ' . $spCall . ' or send the form above. Hardrock Sand And Gravel quotes by phone and sets a delivery day for Sherman, Denison and Grayson County.'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
