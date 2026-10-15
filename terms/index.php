<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup ------------------------------------------------------------------------------- */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/legal-page.php';

$pageTitle       = 'Terms of Service | HARDROCK Sand and Gravel, Sherman TX';
$pageDescription = 'The terms that apply to this website and to material orders, deliveries and site work from HARDROCK Sand and Gravel in Sherman, Denison and Grayson County, TX.';
$canonicalUrl    = $siteUrl . '/terms/';
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

$pageSchemas = [legal_schema('Terms of Service', '/terms/', $pageDescription)];

$tocSections = [
    'agreement' => 'Agreement to terms', 'website-use' => 'Using this website', 'quotes' => 'Estimates and quotes',
    'orders-delivery' => 'Orders and delivery', 'material-guidance' => 'Material and quantity guidance', 'site-work' => 'Site work',
    'warranties' => 'Warranties', 'payment' => 'Payment, changes and cancellation', 'liability' => 'Limitation of liability',
    'intellectual-property' => 'Intellectual property', 'governing-law' => 'Governing law', 'changes' => 'Changes', 'contact-us' => 'Contact us',
];

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/inner-page.css'; ?></style>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/legal-page.css'; ?></style>

<?php echo legal_hero_start('Terms of Service'); ?>
  <h1 id="legal-title">Terms of Service</h1>
  <?php echo legal_hero_end('The ground rules for using this site and for ordering sand, gravel, rock, dirt and site work from ' . $siteName . '.'); ?>

<section class="legal-body" aria-label="Terms of Service text">
  <article class="legal-prose content-narrow">

    <?php echo legal_toc($tocSections); ?>

    <h2 id="agreement">1. Agreement to terms</h2>
    <p>By using <?php echo esc($siteHost); ?> or by ordering material or work from <?php echo esc($companyName); ?> (&ldquo;HARDROCK&rdquo;, &ldquo;we&rdquo;, &ldquo;us&rdquo;), you agree to these Terms of Service and to our <a href="/privacy-policy/">Privacy Policy</a>. If you do not agree, please do not use the site or place an order.</p>

    <h2 id="website-use">2. Using this website</h2>
    <ul>
      <li>You may use this site to learn about HARDROCK&rsquo;s materials and services and to contact us.</li>
      <li>You may not use it for unlawful purposes, try to reach non-public systems, copy or scrape its content without written permission, send false information through a form, or use automated tools to submit forms or pull data.</li>
    </ul>

    <h2 id="quotes">3. Estimates and quotes</h2>
    <p>HARDROCK gives prices by phone because the number depends on the material, the quantity and the delivery address. A price is based on the information you give us. If the material, the amount, the address, the access or the scope of a job changes, the price may change too. A quote is not an order until HARDROCK confirms it with you.</p>

    <h2 id="orders-delivery">4. Orders and delivery</h2>
    <ul>
      <li><strong>Delivery day.</strong> HARDROCK sets a delivery day when it confirms your order. Weather, ground conditions, truck availability and material supply can move that day, and we will tell you if it does.</li>
      <li><strong>Drop location and access.</strong> You are responsible for telling us where the load should go and for making sure a loaded truck can reach it safely: gate width, overhead lines, soft or wet ground, slopes, septic systems, buried lines and similar hazards. Call 811 before anything is dug or graded. We may decline or reschedule a delivery we judge unsafe or likely to damage property.</li>
      <li><strong>Property damage.</strong> Heavy trucks can mark lawns, driveways and soft ground. Tell us about anything that must be protected before the truck arrives.</li>
      <li><strong>Access problems.</strong> If the truck cannot reach the drop spot, HARDROCK will call you to agree on another spot or another day.</li>
    </ul>

    <h2 id="material-guidance">5. Material and quantity guidance</h2>
    <p>The quantity formulas, coverage figures and material suggestions on this website are general guides, not engineering specifications. Natural stone and soil vary in color, size and moisture, and loose material settles and compacts. For slabs, structural pads, drainage systems, septic work or anything covered by a plan or code, follow your engineer&rsquo;s or builder&rsquo;s written specification and confirm it with us before the order is loaded.</p>

    <h2 id="site-work">6. Site work</h2>
    <p>Driveways, house pads, ponds and land clearing are done on the scope, price and schedule that HARDROCK confirms with you for that job. Work that is not part of the confirmed scope, or conditions found once work begins (rock, water, buried items, soft ground), may change the price or schedule.</p>

    <h2 id="warranties">7. Warranties</h2>
    <p>Any warranty on workmanship is stated in writing for the specific job. Materials are natural products supplied as described at the time of order. Except where the law requires otherwise, this website and its content are provided &ldquo;as is&rdquo;, without warranties of any kind.</p>

    <h2 id="payment">8. Payment, changes and cancellation</h2>
    <p>Payment terms, deposits (if any), and the rules for changing or canceling an order or job are stated when HARDROCK confirms the order or job. Material that has already been loaded, delivered or special-ordered for you may not be refundable.</p>

    <h2 id="liability">9. Limitation of liability</h2>
    <p>To the fullest extent <?php echo esc($companyState); ?> law allows, HARDROCK&rsquo;s total liability for any claim connected with this website, an order or a job is limited to the amount you paid for the specific order or job that caused the claim. HARDROCK is not liable for indirect, incidental, special or consequential damages, including lost time, lost use of property or delays caused by weather, ground conditions or events outside our control.</p>

    <h2 id="intellectual-property">10. Intellectual property</h2>
    <p>The text, photographs, logos and design of this website belong to <?php echo esc($siteName); ?> or are used with permission, and are protected by copyright. Do not reproduce, distribute or adapt them without written permission.</p>

    <h2 id="governing-law">11. Governing law and disputes</h2>
    <p>These Terms are governed by the laws of the State of <?php echo esc($companyState); ?>, without regard to conflict-of-laws rules. Any dispute will be handled in the state or federal courts that serve <?php echo esc($companyCounty); ?> County, <?php echo esc($companyState); ?>.</p>

    <h2 id="changes">12. Changes to these terms</h2>
    <p>We may update these Terms at any time. The &ldquo;Last Updated&rdquo; date at the top shows the current version. Using the site after an update means you accept the revised Terms.</p>

    <h2 id="contact-us">13. Contact us</h2>
    <?php echo legal_contact_block(); ?>

    <?php echo legal_disclaimer('Terms of Service'); ?>
  </article>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
