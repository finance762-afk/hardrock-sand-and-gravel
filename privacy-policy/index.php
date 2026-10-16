<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/legal-page.php';

$pageTitle       = 'Privacy Policy | Hardrock Sand And Gravel, Sherman TX';
$pageDescription = 'How Hardrock Sand And Gravel in Sherman, TX collects, uses and protects the information you share through its website, estimate forms, calls and texts.';
$canonicalUrl    = $siteUrl . '/privacy-policy/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$currentPage     = 'legal';
$pageType        = 'other';
$headerDark      = true;

$companyName       = legal_company_name();
$companyEmail      = $email;
$companyPhone      = formatPhone($phone);
$companyPhoneE164  = $phoneE164;
$companyAddress    = legal_address();

$pageSchemas = [legal_schema('Privacy Policy', '/privacy-policy/', $pageDescription)];

$tocSections = [
    'introduction' => 'Introduction', 'information-we-collect' => 'Information we collect', 'how-we-use' => 'How we use it',
    'how-we-share' => 'Who receives it', 'your-rights' => 'Your privacy rights', 'sms-phone-email' => 'Texts, calls and email',
    'retention' => 'How long we keep it', 'security' => 'Security', 'children' => 'Children', 'third-party-links' => 'Third-party links',
    'changes' => 'Changes', 'contact-us' => 'Contact us',
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/inner-page.css'; ?></style>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/legal-page.css'; ?></style>

<?php echo legal_hero_start('Privacy Policy'); ?>
  <h1 id="legal-title">Privacy Policy</h1>
  <?php echo legal_hero_end('What ' . $siteName . ' collects when you visit this site or ask for an estimate, and what happens to it.'); ?>

<section class="legal-body" aria-label="Privacy Policy text">
  <article class="legal-prose content-narrow">

    <?php echo legal_toc($tocSections); ?>

    <h2 id="introduction">1. Introduction</h2>
    <p>This Privacy Policy explains how <?php echo esc($companyName); ?> (&ldquo;HARDROCK&rdquo;, &ldquo;we&rdquo;, &ldquo;us&rdquo;, &ldquo;our&rdquo;) collects, uses and protects personal information when you visit <?php echo esc(parse_url($siteUrl, PHP_URL_HOST)); ?>, send us an estimate request, or call, email or text us about sand, gravel, rock, fill dirt or site work in Sherman, Denison and Grayson County, Texas.</p>

    <h2 id="information-we-collect">2. Information we collect</h2>
    <ul>
      <li><strong>Information you give us:</strong> your name, phone number, email address, the material or service you want, your project details and delivery or job address, and anything else you type into a form, an email or a text.</li>
      <li><strong>Your consent choices:</strong> whether you ticked the email and text boxes, whether you accepted the Privacy Policy and Terms, the version of the consent wording shown, and the page you submitted from.</li>
      <li><strong>Visit and attribution details:</strong> on your first page view we set a first-party cookie that records the page you landed on, the site that referred you, any campaign tags in the link (UTM values or a Google Ads click ID), a random session ID and a device type (phone, tablet or desktop). We attach these to a form you submit so we know which page produced the request.</li>
      <li><strong>Automatically collected:</strong> IP address, browser and device type, pages viewed and timestamps, from our hosting provider&rsquo;s server logs and from Google Analytics 4 once it is switched on for this site.</li>
      <li><strong>Spam-protection data:</strong> a signed timestamp and an interaction flag that tell our form handler a person, not a bot, submitted the form.</li>
    </ul>
    <p>See our <a href="/cookie-policy/">Cookie Policy</a> for the cookies involved.</p>

    <h2 id="how-we-use">3. How we use your information</h2>
    <ul>
      <li>Answer your request, quote a price, confirm a delivery or job, and schedule the work.</li>
      <li>Call, email or text you about that request. Marketing emails and marketing texts are sent only if you ticked the matching box.</li>
      <li>Understand which pages of this website bring in requests, and improve the site.</li>
      <li>Keep business, tax and dispute records, and meet legal obligations.</li>
      <li>Prevent spam and abuse of our forms.</li>
    </ul>

    <h2 id="how-we-share">4. Who receives your information</h2>
    <ul>
      <li><strong>We do not sell personal information</strong>, and we do not share it for cross-context behavioral advertising.</li>
      <li><strong>Page One Insights, LLC</strong>, the company that built and hosts this website. Estimate and contact forms are received by its lead-handling service, which stores the submission, filters spam and emails it to <?php echo esc($siteName); ?>. A copy goes to Page One Insights&rsquo; customer service team so lead delivery and your consent record can be verified.</li>
      <li><strong>Hosting and infrastructure providers</strong> that run the servers behind the site.</li>
      <li><strong>Google</strong>: Google Analytics 4 (site usage), Google Maps (the map on the Contact page) and Google Business Profile (reviews and directions links).</li>
      <li><strong>Suppliers and subcontractors</strong>, only when needed to deliver your order or finish your job.</li>
      <li><strong>Legal and safety:</strong> where <?php echo esc($companyState); ?> or federal law requires it, or to protect rights and safety.</li>
      <li><strong>Business transfers:</strong> if the business or its assets are sold or merged, records may transfer to the new owner.</li>
    </ul>

    <h2 id="your-rights">5. Your privacy rights</h2>

    <h3 id="state-rights"><?php echo esc($companyState); ?> and other state residents</h3>
    <p>Residents of <?php echo esc($companyState); ?>, Colorado, Connecticut, Utah, Virginia and other states with comprehensive privacy laws may have the right to confirm whether we hold personal information about them, to access it, correct it, delete it, and receive a copy. You may also appeal if we decline a request. We apply these rights to every visitor who asks, wherever you live.</p>
    <p><strong>How to ask:</strong> email <a href="mailto:<?php echo esc($companyEmail); ?>"><?php echo esc($companyEmail); ?></a> or call <a href="tel:<?php echo esc($companyPhoneE164); ?>"><?php echo esc($companyPhone); ?></a>. We may need to confirm it is you before acting on the request. We respond within 45 days. If we turn a request down, reply to that message to appeal and we will review it again; you can also contact the <?php echo esc($companyState); ?> Attorney General&rsquo;s office.</p>

    <h3 id="ccpa-rights">California residents (CCPA / CPRA) and &ldquo;Do Not Sell or Share&rdquo;</h3>
    <p>If you are a California resident you have these rights under the California Consumer Privacy Act as amended by the CPRA:</p>
    <ul>
      <li>The right to know what personal information we collect, use and disclose.</li>
      <li>The right to delete personal information we collected from you, with legal exceptions.</li>
      <li>The right to correct inaccurate personal information.</li>
      <li>The right to opt out of the sale or sharing of your personal information. <?php echo esc($siteName); ?> does not sell or share personal information, so there is nothing to switch off, but you can send an opt-out request and we will record it.</li>
      <li>The right to limit the use of sensitive personal information. We do not use it beyond providing what you asked for.</li>
      <li>The right not to be treated differently for using these rights.</li>
    </ul>
    <p>Send requests to the email or phone above. When you opt out, we will confirm in writing that your request was honored.</p>

    <h2 id="sms-phone-email">6. Texts, phone calls and email</h2>
    <p>When you submit a form you may tick three separate boxes. Each is optional except the last, none is pre-checked, and consent to texts or marketing email is not a condition of buying anything.</p>
    <ul>
      <li><strong>Email updates (optional):</strong> permission for <?php echo esc($siteName); ?> to send emails about services, promotions and news. Unsubscribe from any email, or write to <a href="mailto:<?php echo esc($companyEmail); ?>"><?php echo esc($companyEmail); ?></a>.</li>
      <li><strong>Text messages (optional):</strong> permission to text the number you gave. Message frequency varies and message and data rates may apply. Reply STOP to unsubscribe or HELP for help. We honor any reasonable way you tell us to stop.</li>
      <li><strong>Privacy Policy and Terms (required):</strong> confirms you have read this policy and our <a href="/terms/">Terms of Service</a>.</li>
    </ul>
    <p>We may call or email you in reply to the request you sent, using the details you gave us. Text-message opt-in data is not shared with third parties for their marketing.</p>

    <h2 id="retention">7. How long we keep it</h2>
    <p>We keep estimate requests, order records and related messages for as long as needed to serve you, handle any follow-up question or dispute, and meet tax and legal record-keeping rules. When a record is no longer needed, we delete it or strip the personal details. You can ask us to delete your information at any time, subject to those legal limits.</p>

    <h2 id="security">8. Security</h2>
    <p>Form submissions travel over an encrypted (HTTPS) connection, and the lead-handling service and hosting accounts are access-controlled. No website or system is perfectly secure, so we cannot promise absolute security, but we work to limit risk.</p>

    <h2 id="children">9. Children&rsquo;s privacy</h2>
    <p>This website is for adults ordering materials and site work. It is not directed to children under 13 and we do not knowingly collect their information. If you believe a child has sent us information, contact us and we will delete it.</p>

    <h2 id="third-party-links">10. Third-party links</h2>
    <p>This site links to other sites, such as our Google Business Profile and Google Maps directions. Those sites have their own privacy practices, which we do not control. Read their policies before sharing information there.</p>

    <h2 id="changes">11. Changes to this policy</h2>
    <p>We update this policy when our practices or the law change. The &ldquo;Last Updated&rdquo; date at the top shows the latest version, and material changes will be noted on this page.</p>

    <h2 id="contact-us">12. Contact us</h2>
    <p>For privacy questions or to use your rights:</p>
    <?php echo legal_contact_block(); ?>

    <?php echo legal_disclaimer('Privacy Policy'); ?>
  </article>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
