<?php
/**
 * sitemap.php — dynamic sitemap (replaces static sitemap.xml and sitemap-images.xml). .htaccess rewrites /sitemap.xml to this file.
 * Pages come from config.php ($services, $serviceAreas) plus a short list of fixed pages; blog posts come from the $blogPosts registry
 * (includes/blog-data.php). Never hand-edit a URL in here: add the page to its registry. Per-URL image entries are embedded.
 * URLs are the trailing-slash directory form and must match each page's canonical exactly. thank-you and 404 are not listed (noindex / error).
 * Only pages that exist on disk are listed, so a registry entry without a built page never produces a dead sitemap URL.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.php';   // $spCards (service photos + alt)
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/area-page.php';      // $apAreas (area photos + alt)
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/blog-helpers.php';   // $blogPosts

$smRoot = rtrim((string) $_SERVER['DOCUMENT_ROOT'], '/');
$smBase = rtrim((string) $siteUrl, '/');

/** lastmod = the page file's modification date (the registry has no editorial date for non-blog pages). */
$smMod = function (string $relFile) use ($smRoot): string {
    $smT = @filemtime($smRoot . '/' . $relFile);
    return date('Y-m-d', $smT ?: time());
};
$smImg = fn(string $stem, string $alt) => ['src' => '/assets/images/' . $stem . '.jpg', 'caption' => $alt];

$smPages = [];
$smAdd = function (string $path, string $file, string $freq, string $prio, array $images = []) use (&$smPages, $smRoot, $smMod) {
    if (!is_file($smRoot . '/' . $file)) return;
    $smPages[] = ['path' => $path, 'lastmod' => $smMod($file), 'changefreq' => $freq, 'priority' => $prio, 'images' => $images];
};

$smAdd('/', 'index.php', 'weekly', '1.0', [$smImg('hero-rip-rap-v1', 'Close-up of rip rap rock for Hardrock Sand And Gravel in Sherman, TX')]);
$smAdd('/services/', 'services/index.php', 'monthly', '0.8');
foreach ($services as $smSvc) {
    $smCard = $spCards[$smSvc['slug']] ?? null;
    $smAdd('/services/' . $smSvc['slug'] . '/', 'services/' . $smSvc['slug'] . '/index.php', 'monthly', '0.8', $smCard ? [$smImg($smCard['photo'], $smCard['alt'])] : []);
}
$smAdd('/service-areas/', 'service-areas/index.php', 'monthly', '0.6');
foreach ($serviceAreas as $smArea) {
    $smSlug = getAreaSlug($smArea);
    $smRow = $apAreas[$smSlug] ?? null;
    $smAdd('/service-areas/' . $smSlug . '/', 'service-areas/' . $smSlug . '/index.php', 'monthly', '0.6', $smRow ? [$smImg($smRow['photo'], $smRow['alt'])] : []);
}
$smAdd('/about/', 'about/index.php', 'monthly', '0.6');
$smAdd('/contact/', 'contact/index.php', 'monthly', '0.6');
$smAdd('/faq/', 'faq/index.php', 'monthly', '0.6');
$smAdd('/blog/', 'blog/index.php', 'weekly', '0.6');
foreach ((array) $blogPosts as $smPost) {
    $smPath = blog_url($smPost['slug']);
    if (!is_file($smRoot . $smPath . 'index.php')) continue;
    $smPages[] = ['path' => $smPath, 'lastmod' => $smPost['dateISO'], 'changefreq' => 'monthly', 'priority' => '0.6',
                  'images' => [$smImg(blog_image_base($smPost['image']), $smPost['alt'])]];
}
foreach (['privacy-policy', 'terms', 'cookie-policy', 'accessibility'] as $smLegal) {
    $smAdd('/' . $smLegal . '/', $smLegal . '/index.php', 'yearly', '0.3');
}

$smX = fn(string $v) => htmlspecialchars($v, ENT_XML1 | ENT_QUOTES, 'UTF-8');

header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
<?php foreach ($smPages as $smPage): ?>
  <url>
    <loc><?php echo $smX($smBase . $smPage['path']); ?></loc>
    <lastmod><?php echo $smX($smPage['lastmod']); ?></lastmod>
    <changefreq><?php echo $smX($smPage['changefreq']); ?></changefreq>
    <priority><?php echo $smX($smPage['priority']); ?></priority>
<?php foreach ($smPage['images'] as $smImage): ?>
    <image:image>
      <image:loc><?php echo $smX($smBase . $smImage['src']); ?></image:loc>
      <image:caption><?php echo $smX($smImage['caption']); ?></image:caption>
    </image:image>
<?php endforeach; ?>
  </url>
<?php endforeach; ?>
</urlset>
