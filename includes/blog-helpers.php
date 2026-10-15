<?php
/**
 * includes/blog-helpers.php — shared pieces for /blog/, the blog posts and the homepage "From the Blog" section.
 * Everything here reads the $blogPosts registry (includes/blog-data.php); no post list is written anywhere else.
 * Helper-local variables are prefixed ($bl…) — pages own $svc, $area, $c, $card.
 * Pair with includes/blog.css and includes/service-page.css (answer blocks, tables, FAQ band, closing CTA).
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/blog-data.php';

if (!function_exists('blog_post')) {
    /** Registry row for a slug, or null. */
    function blog_post(string $slug): ?array {
        global $blogPosts;
        foreach ((array) $blogPosts as $blRow) if (($blRow['slug'] ?? '') === $slug) return $blRow;
        return null;
    }
}

if (!function_exists('blog_image_base')) {
    /** '/assets/images/gravel-driveway-rural-960.webp' -> 'gravel-driveway-rural' (the stem pictureTag() expects). */
    function blog_image_base(string $path): string {
        return preg_replace('/(-(480|960|1600))?\.(webp|avif|jpe?g)$/', '', basename($path));
    }
}

if (!function_exists('blog_url')) {
    function blog_url(string $slug): string { return '/blog/' . $slug . '/'; }
}

if (!function_exists('blog_card')) {
    /** One editorial card: image, category badge, title, excerpt, date + read time, Read Article CTA. $sizes feeds the <picture>. */
    function blog_card(array $post, string $sizes = '(max-width: 640px) 100vw, (max-width: 1000px) 50vw, 360px', string $extra = ''): string {
        return '<a class="blog-card' . ($extra !== '' ? ' ' . esc($extra) : '') . '" href="' . esc(blog_url($post['slug'])) . '">'
             . '<div class="blog-card__image">' . pictureTag(blog_image_base($post['image']), $post['alt'], $sizes) . '</div>'
             . '<div class="blog-card__body">'
             . '<span class="blog-card__category">' . esc($post['category']) . '</span>'
             . '<h3 class="blog-card__title">' . esc($post['title']) . '</h3>'
             . '<p class="blog-card__excerpt">' . esc($post['excerpt']) . '</p>'
             . '<div class="blog-card__meta"><time datetime="' . esc($post['dateISO']) . '">' . esc($post['date']) . '</time> · ' . esc($post['readtime']) . '</div>'
             . '<span class="blog-card__cta">Read Article<span class="sr-only">: ' . esc($post['title']) . '</span> &rarr;</span>'
             . '</div></a>';
    }
}

if (!function_exists('blog_related')) {
    /** Related Articles: up to $n other posts, same category first, then newest. */
    function blog_related(string $currentSlug, int $n = 3): array {
        global $blogPosts;
        $blCur = blog_post($currentSlug);
        $blOthers = array_values(array_filter((array) $blogPosts, fn($blP) => $blP['slug'] !== $currentSlug));
        usort($blOthers, fn($a, $b) => (($b['category'] === ($blCur['category'] ?? '')) <=> ($a['category'] === ($blCur['category'] ?? ''))) ?: strcmp($b['dateISO'], $a['dateISO']));
        return array_slice($blOthers, 0, $n);
    }
}

if (!function_exists('blog_breadcrumb')) {
    /** Visible breadcrumb on the dark hero: Home › Blog [› title]. */
    function blog_breadcrumb(string $title = ''): string {
        $blOut = '<nav class="breadcrumb sp-breadcrumb" aria-label="Breadcrumb"><ol><li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>';
        if ($title === '') return $blOut . '<li aria-current="page">Blog</li></ol></nav>';
        return $blOut . '<li><a href="/blog/">Blog</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li><li aria-current="page">' . esc($title) . '</li></ol></nav>';
    }
}

if (!function_exists('blog_breadcrumb_schema')) {
    /** BreadcrumbList node (no @context): Home › Blog [› post]. */
    function blog_breadcrumb_schema(string $title = '', string $slug = ''): array {
        global $siteUrl;
        $blBase = rtrim((string) $siteUrl, '/');
        $blItems = [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $blBase . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => $blBase . '/blog/'],
        ];
        if ($slug !== '') $blItems[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $title, 'item' => $blBase . blog_url($slug)];
        return ['@type' => 'BreadcrumbList', 'itemListElement' => $blItems];
    }
}

if (!function_exists('blog_post_schema')) {
    /**
     * @graph for one post: BlogPosting (author and publisher = the homepage #organization, never an invented person),
     * BreadcrumbList; the post appends its own FAQPage node mirroring the visible FAQ. $keywords is a comma-separated string describing THIS post.
     */
    function blog_post_schema(array $post, string $description, string $keywords): array {
        global $siteUrl;
        $blBase = rtrim((string) $siteUrl, '/');
        $blUrl  = $blBase . blog_url($post['slug']);
        $blOrg  = ['@id' => $blBase . '/#organization'];
        return ['@context' => 'https://schema.org', '@graph' => [
            [
                '@type' => 'BlogPosting', '@id' => $blUrl . '#post', 'headline' => $post['title'], 'description' => $description,
                'image' => $blBase . '/assets/images/' . blog_image_base($post['image']) . '.jpg',
                'datePublished' => $post['dateISO'], 'dateModified' => $post['dateISO'], 'keywords' => $keywords,
                'author' => $blOrg, 'publisher' => $blOrg, 'mainEntityOfPage' => $blUrl, 'url' => $blUrl, 'inLanguage' => 'en-US',
                'isPartOf' => ['@type' => 'Blog', '@id' => $blBase . '/blog/#blog', 'name' => 'HARDROCK Sand and Gravel Blog', 'url' => $blBase . '/blog/'],
            ],
            blog_breadcrumb_schema($post['title'], $post['slug']),
        ]];
    }
}
