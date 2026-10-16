<?php
/**
 * includes/config.php — single source of site-wide variables (Hardrock Sand And Gravel).
 * Every value below traces to build-plan.json or to the owner's confirmed facts (Dean Jones, VP Operations,
 * 2026-10-16 — see content-confirmations.json "confirmed"). Nothing here is invented; unknowns stay empty
 * and the templates omit anything empty.
 * UNKNOWN: logo, brand colors, social links, GA4 ID, review count. The yard street address is deliberately NOT
 * published: HARDROCK is delivery only (no customer pickup), so no yard address appears anywhere on the site.
 */

// ---- Identity ---------------------------------------------------------------------------------
$slug          = 'hardrock-sand-and-gravel';             // exact build directory name
$siteName      = 'Hardrock Sand And Gravel';             // as written in the business description / partner profile (plan company_name: "Hardrock Sand And Gravel")
$tagline       = '';                                     // none in build-plan
$industry      = 'Sand & gravel supplier';
$ownerName     = 'Dean Jones';

// ---- Contact (public NAP) ---------------------------------------------------------------------
$phone          = '903-420-0330';
$phoneRaw       = '9034200330';
$phoneE164      = '+19034200330';
$phoneSecondary = '';
$email          = 'dean@hardrocksandandgravel.com';
$contactEmail   = $email;
// Lead routing only (server-side, never rendered)
$leadNotificationEmail = 'dean@hardrocksandandgravel.com';
$leadNotificationPhone = '903-420-0330';

$addressPublic = false;                                  // owner 2026-10-16: delivery only, no customer pickup — never show a yard street address
$address = ['street' => '', 'city' => 'Sherman', 'state' => 'TX', 'zip' => ''];

// ---- Domain / URLs ----------------------------------------------------------------------------
// build-plan has no production_domain -> preview default "${slug}.pageone.cloud".
// (web_sources lists hardrocksandandgravel.com — swap it in here once confirmed as the launch domain.)
$domain  = 'hardrock-sand-and-gravel.pageone.cloud';
$siteUrl = 'https://' . $domain;
// $canonicalUrl is NOT set here — each page sets its own from $siteUrl + path before head.php.

// ---- SEO --------------------------------------------------------------------------------------
$primaryKeyword    = 'sand and gravel';
$secondaryKeywords = [
    'pea gravel', 'decomposed granite', 'gravel delivery sherman tx', 'mason sand', 'driveway gravel',
    'fill dirt', 'land clearing', 'road base', 'sand and gravel sherman tx', 'river rock',
];
$targetRadiusMiles = 25;                                 // build-plan seo.target_radius

// ---- Services (13 — one page each under /services/{slug}/) ------------------------------------
$services = [
    ['name' => 'Delivery', 'slug' => 'delivery',
     'description' => 'Bulk sand, gravel, rock and dirt delivered to homes and job sites in Grayson, Collin, Denton, Fannin and Cooke counties. Delivery only.',
     'keywords' => ['delivery sherman tx', 'gravel delivery sherman tx', 'sand delivery sherman tx']],
    ['name' => 'Driveways', 'slug' => 'driveways',
     'description' => 'Gravel driveways for homes and rural properties in Sherman and Grayson County.',
     'keywords' => ['driveways sherman tx', 'driveway gravel', 'gravel driveway sherman tx']],
    ['name' => 'House pads', 'slug' => 'house-pads',
     'description' => 'Building pads prepared with fill and base material for new slabs and homes in Grayson County.',
     'keywords' => ['house pads sherman tx', 'building pad', 'house pad fill']],
    ['name' => 'Ponds', 'slug' => 'ponds',
     'description' => 'Pond digging and pond work for rural and residential properties around Sherman.',
     'keywords' => ['ponds sherman tx', 'pond construction sherman tx', 'pond digging']],
    ['name' => 'Land clearing', 'slug' => 'land-clearing',
     'description' => 'Clearing brush and trees from lots and acreage ahead of building, driveways and pads.',
     'keywords' => ['land clearing sherman tx', 'land clearing', 'lot clearing grayson county']],
    ['name' => 'Pea gravel', 'slug' => 'pea-gravel',
     'description' => 'Small, rounded pea gravel for walkways, landscape beds, play areas and drainage.',
     'keywords' => ['pea gravel sherman tx', 'pea gravel', 'pea gravel delivery']],
    ['name' => 'Decomposed granite', 'slug' => 'decomposed-granite',
     'description' => 'Fine crushed decomposed granite and pink granite for paths, patios and xeriscape landscaping.',
     'keywords' => ['decomposed granite sherman tx', 'decomposed granite', 'dg gravel']],
    ['name' => 'Road base', 'slug' => 'road-base',
     'description' => 'Crushed road base that compacts firm under driveways, pads and parking areas.',
     'keywords' => ['road base sherman tx', 'road base', 'crushed base gravel']],
    ['name' => '57/67 rock', 'slug' => '57-67-rock',
     'description' => 'Crushed stone in #57 and #67 sizes for drainage, concrete and driveway surfaces.',
     'keywords' => ['57/67 rock sherman tx', '57 rock', '67 rock']],
    ['name' => 'Fill dirt', 'slug' => 'fill-dirt',
     'description' => 'Fill dirt for leveling, backfill and raising grade on residential and construction sites.',
     'keywords' => ['fill dirt sherman tx', 'fill dirt', 'fill dirt delivery']],
    ['name' => 'Mason sand', 'slug' => 'mason-sand',
     'description' => 'Fine mason sand for mortar, paver bedding and sandboxes.',
     'keywords' => ['mason sand sherman tx', 'mason sand', 'masonry sand']],
    ['name' => 'Rip rap', 'slug' => 'rip-rap',
     'description' => 'Large rip rap rock for erosion control on banks, pond edges and culverts.',
     'keywords' => ['rip rap sherman tx', 'rip rap', 'erosion control rock']],
    ['name' => 'River rock', 'slug' => 'river-rock',
     'description' => 'Smooth, rounded river rock for landscape beds, dry creek beds and drainage.',
     'keywords' => ['river rock sherman tx', 'river rock', 'landscape rock']],
];

// ---- Service areas ----------------------------------------------------------------------------
// $serviceAreas = the areas with a page on disk (nav, footer, hub cards, sitemap). Do not add an entry without building its page.
$serviceAreas = ['Sherman, TX', 'Denison, TX', 'Grayson County, TX'];
// Owner-confirmed delivery area (2026-10-16): five Texas counties, no Oklahoma. Used for schema areaServed and service-area copy only — no pages.
$serviceCounties = ['Grayson County, TX', 'Collin County, TX', 'Denton County, TX', 'Fannin County, TX', 'Cooke County, TX'];
$serviceCountiesText = 'Grayson, Collin, Denton, Fannin and Cooke counties';

// ---- Owner-confirmed business facts (Dean Jones, VP Operations, 2026-10-16) — the ONLY source for these claims ----
$deliveryOnly        = true;                               // no customer pickup, no yard visits, no published yard address
$pricingUnits        = 'by the ton and by the yard';       // material is priced per ton and per cubic yard
$fullLoad            = '20 yards or 20 tons';              // one full load
$sameDayNote         = 'Same-day delivery is sometimes possible';   // "sometimes" — never a promise
$separateDeliveries  = true;                               // two materials normally go out as separate deliveries so they do not contaminate each other
$siteVisitBeforeQuote = true;                              // driveways, pads, ponds, clearing: always a site visit (elevation + soil type) before a quote
$contractorTerms     = 'Net 30';                           // contractor accounts available on Net 30 terms
$insuranceSummary    = '$1M general liability and umbrella insurance';
$credentials         = ['Veteran & Woman Owned Business', 'HUB (Historically Underutilized Business)'];   // no certification numbers
// Equipment and hauling are subcontracted / rented: never claim "our trucks", "our crew", "our fleet" or "our equipment" anywhere on the site.

// ---- Hours (build-plan business_hours: Mon-Thu 6-5, Fri 9-5, Sat 9-2, Sun closed) ---------------
$hours = [
    ['day' => 'Monday',    'short' => 'Mon', 'opens' => '06:00', 'closes' => '17:00', 'label' => '6:00 AM – 5:00 PM'],
    ['day' => 'Tuesday',   'short' => 'Tue', 'opens' => '06:00', 'closes' => '17:00', 'label' => '6:00 AM – 5:00 PM'],
    ['day' => 'Wednesday', 'short' => 'Wed', 'opens' => '06:00', 'closes' => '17:00', 'label' => '6:00 AM – 5:00 PM'],
    ['day' => 'Thursday',  'short' => 'Thu', 'opens' => '06:00', 'closes' => '17:00', 'label' => '6:00 AM – 5:00 PM'],
    ['day' => 'Friday',    'short' => 'Fri', 'opens' => '09:00', 'closes' => '17:00', 'label' => '9:00 AM – 5:00 PM'],
    ['day' => 'Saturday',  'short' => 'Sat', 'opens' => '09:00', 'closes' => '14:00', 'label' => '9:00 AM – 2:00 PM'],
    ['day' => 'Sunday',    'short' => 'Sun', 'opens' => null,    'closes' => null,    'label' => 'Closed'],
];
// Compact one-line form for the v8 components that expect a string
$businessHours = implode(', ', array_map(static fn ($h) => $h['short'] . ' ' . $h['label'], $hours));

// ---- Brand ------------------------------------------------------------------------------------
// build-plan design.colors carries no values and assets.logo is null: these mirror the scaffold tokens in
// framework.css :root. Replace both together once a logo is analysed.
$colors = ['primary' => '#1f2428', 'secondary' => '#5a6570', 'accent' => '#c8461a'];
$yearEstablished = 2016;                                  // GBP: "Established in Sherman Texas in 2016"
$yearsInBusiness = (int) date('Y') - $yearEstablished;    // 10 in 2026

// Factual description for schema / AEO (build-plan content.description)
$businessDescription = 'Hardrock Sand And Gravel is a veteran and woman owned sand and gravel supplier based in Sherman, TX, in business since 2016, delivering to Grayson, Collin, Denton, Fannin and Cooke counties. Delivery only, no customer pickup. Services include delivery, pea gravel, decomposed granite, pink granite, 57 rock and 67 rock.';

// ---- Google Business Profile ------------------------------------------------------------------
$gbp = [
    'place_id'      => 'ChIJjwJvgixjTIYRxDk93hKN_tA',
    'share_url'     => 'https://share.google/vbihzgRkTRG3GBJaH',
    'url'           => 'https://www.google.com/maps/place/?q=place_id:ChIJjwJvgixjTIYRxDk93hKN_tA',   // schema hasMap
    'directions'    => 'https://www.google.com/maps/dir/?api=1&destination=place_id:ChIJjwJvgixjTIYRxDk93hKN_tA',
    'review_url'    => 'https://search.google.com/local/writereview?placeid=ChIJjwJvgixjTIYRxDk93hKN_tA',
    'embed_src'     => 'https://maps.google.com/maps?q=place_id:ChIJjwJvgixjTIYRxDk93hKN_tA&output=embed',
    'reviews_count' => null,                              // UNKNOWN — no review data in build-plan: no ratings, never AggregateRating
];
$geo = null;                                              // integrations.geo is null

// ---- Social / analytics -----------------------------------------------------------------------
// Extra schema sameAs profiles (GBP CID + Facebook), merged into LocalBusiness sameAs
$schemaSameAs = [
    'https://www.google.com/maps?cid=15059629316150999492',
    'https://www.facebook.com/p/Hardrock-Sand-and-Gravel-61594075584700',
];
// SEO indexing switch: false on staging (noindex meta + X-Robots-Tag). Set to true at launch.
$allowIndexing = false;

$socialLinks       = [];                                  // none provided — footer renders icons only for platforms the client uses
$googleAnalyticsId = 'G-XXXXXXXXXX';                      // placeholder until the client's GA4 measurement ID is set

// ---- Forms ------------------------------------------------------------------------------------
$formAction      = 'https://db.pageone.cloud/functions/v1/leads/hardrock-sand-and-gravel';   // build-plan form_action, verbatim
// HMAC secret for the spam-shield `_ft` field. Blank in the repo: injected by ~/crm/scripts/patch-leads-spamshield.py
// at promote time. p1-form-helpers.php skips the shield when empty.
$leadsFormSecret = '';

// ---- v8 components (written exactly as build-plan integrations holds them) ---------------------
$estimateTool   = [];   // integrations.estimate_tool.authorized is false
$bookingWindows = [];   // integrations.booking.authorized is false
$textUsNumber   = '';   // integrations.text_us_number is null (accepts_sms false) -> two-button sticky bar
$financing      = [];   // integrations.financing is null
$serviceZips    = [];   // integrations.service_zips not provided

$cssVersion = '6';      // the SINGLE framework.css cache-bust; bump here on every framework.css / critical.css change

// ---- Legal pages (Phase 5) ----------------------------------------------------------------------
// Intake did not collect business entity type or state of formation. The entity suffix stays empty (legal pages omit it
// rather than guess "LLC"); governing law uses the state the business operates in (Sherman, Grayson County, TX).
$companyEntityType = '';          // UNKNOWN — set to e.g. 'LLC' once confirmed, then the legal pages append it to the name
$companyState      = 'Texas';
$companyCounty     = 'Grayson';
$legalUpdated      = 'October 15, 2026';   // fixed date of the last substantive edit to the four legal pages — change it when the text changes

// ---- Lead attribution (first-touch cookie + p1_attribution_fields()) — must stay last, before any output ----
require_once __DIR__ . '/attribution.php';
