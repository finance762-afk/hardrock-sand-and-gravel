<?php
/**
 * includes/head.php — doctype, <head>, SEO, OG, fonts, critical CSS, favicons, schema; opens <body>.
 *
 * Reads (all optional, set by the page BEFORE including this file):
 *   $pageTitle, $pageDescription, $canonicalUrl, $ogImage (absolute or /path), $ogType, $noindex (bool),
 *   $heroPreload ['srcset' => '…avif 480w, …', 'sizes' => '100vw'], $pageSchemas (list of arrays / JSON strings),
 *   $pageType, $schemaImage, $bodyClass.
 * Defaults come from config.php: "<Primary keyword> in <City>, <ST> | <Site name>".
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

$headCity  = $address['city'] ?? '';
$headState = $address['state'] ?? '';
$headKw    = str_replace(' And ', ' and ', ucwords((string) $primaryKeyword));

$headTitle = $pageTitle ?? ($headKw . ' in ' . $headCity . ', ' . $headState . ' | ' . $siteName);
$headDesc  = $pageDescription
    ?? ($siteName . ' supplies ' . $primaryKeyword . ' in ' . $headCity . ', ' . $headState . ': pea gravel, 57/67 rock, road base, fill dirt and delivery. Call ' . formatPhone($phone) . ' for pricing.');
$headCanon = $canonicalUrl ?? requestCanonical();
$headImage = $ogImage ?? '/assets/images/og-default-v1.jpg';
if ($headImage !== '' && $headImage[0] === '/') $headImage = rtrim($siteUrl, '/') . $headImage;
$headType  = $ogType ?? 'website';
$pageType  = $pageType ?? p1_page_type_from_path(strtok((string) ($_SERVER['REQUEST_URI'] ?? '/'), '?') ?: '/');
$headCss   = '?v=' . ($cssVersion ?? '1');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php echo generateMetaTags($headTitle, $headDesc, $headCanon); ?>
<?php if (!empty($noindex)): ?>
<meta name="robots" content="noindex,nofollow">
<?php else: ?>
<meta name="robots" content="index,follow,max-image-preview:large">
<?php endif; ?>
<meta name="theme-color" content="<?php echo esc($colors['primary'] ?? '#1f2428'); ?>">

<!-- Open Graph -->
<meta property="og:type" content="<?php echo esc($headType); ?>">
<meta property="og:title" content="<?php echo esc($headTitle); ?>">
<meta property="og:description" content="<?php echo esc($headDesc); ?>">
<meta property="og:url" content="<?php echo esc($headCanon); ?>">
<meta property="og:image" content="<?php echo esc($headImage); ?>">
<meta property="og:site_name" content="<?php echo esc($siteName); ?>">
<meta property="og:locale" content="en_US">

<!-- Fonts: self-hosted (v6.2). Only the above-the-fold heading face is preloaded; @font-face lives in framework.css -->
<link rel="preload" href="/assets/fonts/barlow-condensed.woff2" as="font" type="font/woff2" crossorigin>

<!-- Critical CSS inline; framework.css loads non-blocking (v6.3) -->
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/critical.css'; ?></style>
<link rel="preload" href="/assets/css/framework.css<?php echo $headCss; ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="/assets/css/framework.css<?php echo $headCss; ?>"></noscript>
<?php if (!empty($heroPreload['srcset'])): ?>
<link rel="preload" as="image" type="image/avif" imagesrcset="<?php echo esc($heroPreload['srcset']); ?>" imagesizes="<?php echo esc($heroPreload['sizes'] ?? '100vw'); ?>" fetchpriority="high">
<?php endif; ?>

<!-- Favicons (monogram until the logo file arrives; regenerate from the logo then, under a new filename) -->
<link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg">
<link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon-16x16.png">

<!-- Google Analytics 4 — placeholder. Set $googleAnalyticsId in config.php, then uncomment (defer, never async):
<script defer src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc($googleAnalyticsId); ?>"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?php echo esc($googleAnalyticsId); ?>');</script>
-->

<?php
// Homepage carries the full LocalBusiness + WebSite graph; every other page references it by @id (…/#organization).
if ($pageType === 'home') {
    echo jsonLd([
        '@context' => 'https://schema.org',
        '@graph' => [
            generateLocalBusinessSchema(),
            ['@type' => 'WebSite', '@id' => rtrim($siteUrl, '/') . '/#website', 'url' => rtrim($siteUrl, '/') . '/', 'name' => $siteName, 'publisher' => ['@id' => rtrim($siteUrl, '/') . '/#organization'], 'inLanguage' => 'en-US'],
        ],
    ]);
}
?>
<?php foreach ((array) ($pageSchemas ?? []) as $headSchema): /* written inline (not via jsonLd()) so the <script> tag is visible in this template */ ?>
<script type="application/ld+json">
<?php echo is_string($headSchema) ? $headSchema : json_encode($headSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_PRETTY_PRINT); ?>

</script>
<?php endforeach; ?>
</head>
<body<?php echo !empty($bodyClass) ? ' class="' . esc($bodyClass) . '"' : ''; ?>>
