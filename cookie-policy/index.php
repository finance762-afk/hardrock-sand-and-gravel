<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/legal-page.php';

$pageTitle       = 'Cookie Policy | Hardrock Sand And Gravel, Sherman TX';
$pageDescription = 'The cookies and similar technologies used on the Hardrock Sand And Gravel website in Sherman, TX, what each one does, and how to block or remove them.';
$canonicalUrl    = $siteUrl . '/cookie-policy/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'legal';
$pageType        = 'other';
$headerDark      = true;

$companyName       = legal_company_name();
$companyEmail      = $email;
$companyPhone      = formatPhone($phone);
$companyPhoneE164  = $phoneE164;
$companyAddress    = legal_address();

$pageSchemas = [legal_schema('Cookie Policy', '/cookie-policy/', $pageDescription)];

$tocSections = [
    'what-are-cookies' => 'What cookies are', 'cookies-we-use' => 'Cookies we use', 'fonts-and-scripts' => 'Fonts and scripts',
    'control-cookies' => 'How to control cookies', 'analytics-opt-out' => 'Opt out of Google Analytics', 'cookie-notice' => 'Our cookie notice',
    'changes' => 'Changes', 'contact-us' => 'Contact us',
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/inner-page.css'; ?></style>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/legal-page.css'; ?></style>

<?php echo legal_hero_start('Cookie Policy'); ?>
  <h1 id="legal-title">Cookie Policy</h1>
  <?php echo legal_hero_end('Which cookies this ' . $siteName . ' website sets, why, and how to turn them off.'); ?>

<section class="legal-body" aria-label="Cookie Policy text">
  <article class="legal-prose content-narrow">

    <?php echo legal_toc($tocSections); ?>

    <h2 id="what-are-cookies">1. What cookies are</h2>
    <p>Cookies are small text files a website stores on your device. They let a site remember a choice, work properly, and report how it is used. Browser storage (localStorage) does the same job for a few simple settings. This policy covers both, for <?php echo esc($companyName); ?>&rsquo;s website.</p>

    <h2 id="cookies-we-use">2. Cookies we use</h2>
    <div class="legal-table-wrap">
      <table>
        <thead><tr><th scope="col">Name</th><th scope="col">Type</th><th scope="col">What it does</th><th scope="col">How long</th></tr></thead>
        <tbody>
          <tr><th scope="row"><code>p1_ft</code></th><td>First-party cookie</td><td>Set on your first page view. Stores the page you landed on, the referring site, any campaign tags or Google Ads click ID in the link, a random session ID and a device type. It is attached to a form you submit so we can tell which page produced the request. Not used to show ads.</td><td>30 days</td></tr>
          <tr><th scope="row"><code>cookieBannerDismissed_v1</code></th><td>Browser storage (localStorage)</td><td>Remembers that you closed the cookie notice so it does not appear again.</td><td>Until you clear site data</td></tr>
          <tr><th scope="row"><code>_ga</code>, <code>_ga_*</code></th><td>Analytics (Google Analytics 4)</td><td>Counts visits and shows which pages are viewed, so we can see what is useful. Google Analytics 4 is switched on for this site once its measurement ID is configured; these cookies are not set before then.</td><td>Up to 2 years</td></tr>
          <tr><th scope="row">Google Maps cookies</th><td>Third-party embed</td><td>Set by Google only on the Contact page, which shows an embedded map. They are subject to Google&rsquo;s own policies.</td><td>Set by Google</td></tr>
        </tbody>
      </table>
    </div>
    <p>The <code>p1_ft</code> cookie is marked HTTP-only and Secure, so scripts on the page cannot read it, and it is sent only to this website.</p>

    <h2 id="fonts-and-scripts">3. Fonts and scripts</h2>
    <p>This site&rsquo;s fonts are hosted on the site itself, so loading them does not contact Google Fonts or set cookies. We do not use advertising cookies, social-media tracking pixels or retargeting tags.</p>

    <h2 id="control-cookies">4. How to control cookies</h2>
    <p>Most browsers let you see, delete and block cookies, including third-party cookies. Look in your browser&rsquo;s Settings under Privacy or Site Data. Blocking the <code>p1_ft</code> cookie does not stop the site or the forms from working. Blocking all cookies may break some features on other websites.</p>

    <h2 id="analytics-opt-out">5. Opt out of Google Analytics</h2>
    <p>You can stop Google Analytics from measuring your visits on any site by installing the <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener">Google Analytics Opt-out Browser Add-on</a>.</p>

    <h2 id="cookie-notice">6. Our cookie notice</h2>
    <p>A short notice appears when you scroll the page. Choosing &ldquo;Got it&rdquo; stores a flag in your browser (<code>cookieBannerDismissed_v1</code>) so the notice does not return. Clear this site&rsquo;s data in your browser to see it again.</p>

    <h2 id="changes">7. Changes to this policy</h2>
    <p>We update this policy when the cookies on the site change. The &ldquo;Last Updated&rdquo; date at the top shows the current version.</p>

    <h2 id="contact-us">8. Contact us</h2>
    <?php echo legal_contact_block(); ?>

    <?php echo legal_disclaimer('Cookie Policy'); ?>
  </article>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
