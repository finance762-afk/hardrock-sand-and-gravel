<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/legal-page.php';

$pageTitle       = 'Accessibility Statement | HARDROCK Sand and Gravel';
$pageDescription = 'HARDROCK Sand and Gravel in Sherman, TX aims to meet WCAG 2.1 Level AA. See the accessibility features on this site and how to reach us if you hit a barrier.';
$canonicalUrl    = $siteUrl . '/accessibility/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'legal';
$pageType        = 'other';
$headerDark      = true;

$companyName       = legal_company_name();
$companyEmail      = $email;
$companyPhone      = formatPhone($phone);
$companyPhoneE164  = $phoneE164;
$companyAddress    = legal_address();
$siteHost          = (string) parse_url($siteUrl, PHP_URL_HOST);

$pageSchemas = [legal_schema('Accessibility Statement', '/accessibility/', $pageDescription)];

$tocSections = [
    'commitment' => 'Our commitment', 'conformance' => 'Conformance status', 'features' => 'Accessibility features', 'known-issues' => 'Known issues',
    'feedback' => 'Feedback and reporting', 'alternatives' => 'Other ways to reach us', 'changes' => 'Changes', 'contact-us' => 'Contact us',
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/inner-page.css'; ?></style>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/legal-page.css'; ?></style>

<?php echo legal_hero_start('Accessibility'); ?>
  <h1 id="legal-title">Accessibility Statement</h1>
  <?php echo legal_hero_end('How ' . $siteName . ' works to make this website usable for everyone, and what to do if it is not.'); ?>

<section class="legal-body" aria-label="Accessibility Statement text">
  <article class="legal-prose content-narrow">

    <?php echo legal_toc($tocSections); ?>

    <h2 id="commitment">1. Our commitment</h2>
    <p><?php echo esc($companyName); ?> wants everyone who needs sand, gravel, rock, dirt or site work in Sherman, Denison and Grayson County to be able to use this website, including people who use screen readers, keyboards, voice control or magnification. We apply recognized accessibility standards to <?php echo esc($siteHost); ?> and keep improving it.</p>

    <h2 id="conformance">2. Conformance status</h2>
    <p>This site is designed to meet the Web Content Accessibility Guidelines (WCAG) 2.1 at Level AA. We believe it partially conforms, which means some content may not yet fully meet the standard. We are working to fix every known issue.</p>

    <h2 id="features">3. Accessibility features</h2>
    <ul>
      <li>Semantic HTML5 with header, navigation, main and footer landmarks.</li>
      <li>A &ldquo;Skip to main content&rdquo; link at the top of every page.</li>
      <li>Visible keyboard focus on links, buttons and form fields, and a menu, dialog and FAQ that work from the keyboard.</li>
      <li>Descriptive alt text on photographs; decorative images are hidden from screen readers.</li>
      <li>Text and button colors chosen for readable contrast.</li>
      <li>A responsive layout that works across screen sizes and when text is enlarged.</li>
      <li>Reduced motion: animation is switched off for visitors whose device asks for it.</li>
      <li>Every form field has a label, and the menu button reports whether it is open or closed.</li>
    </ul>

    <h2 id="known-issues">4. Known issues</h2>
    <ul>
      <li>The embedded Google Map on the Contact page is built by Google and may not meet every WCAG criterion. The same information is available as text: our phone number, email, hours and a directions link.</li>
      <li>Photographs of work and materials are described in alt text, but fine detail in a photo may not carry over. Ask us and we will describe it.</li>
    </ul>

    <h2 id="feedback">5. Feedback and reporting issues</h2>
    <p>If something on this site is hard or impossible to use, tell us the page, what you were trying to do and the device or assistive technology you use. We aim to reply within 5 business days.</p>

    <h2 id="alternatives">6. Other ways to reach us</h2>
    <p>You never have to use the website to place an order. Call <a href="tel:<?php echo esc($phoneE164); ?>"><?php echo esc(formatPhone($phone)); ?></a> during business hours and <?php echo esc($siteName); ?> will quote a price and set a delivery day by phone, or email <a href="mailto:<?php echo esc($email); ?>"><?php echo esc($email); ?></a>. We will give you any information from this site in another format on request.</p>

    <h2 id="changes">7. Changes to this statement</h2>
    <p>We review this statement when the site changes. The &ldquo;Last Updated&rdquo; date at the top shows the current version.</p>

    <h2 id="contact-us">8. Contact us</h2>
    <?php echo legal_contact_block(); ?>

    <?php echo legal_disclaimer('Accessibility Statement'); ?>
  </article>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
