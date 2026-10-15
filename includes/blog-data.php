<?php
/**
 * includes/blog-data.php — single source of truth for all blog post metadata (blog-standard.md §1).
 * Newest post FIRST. Every consumer (blog index, homepage preview, related articles, sitemap.php) reads this array.
 * Never hardcode post lists elsewhere. Adding a post = one entry here + one /blog/{slug}/index.php.
 * Images are existing files under /assets/images/ (the -960.webp variants; blog-helpers.php derives the AVIF/WebP/JPG set from the stem).
 * Titles are 60 characters or fewer with no brand suffix. Both launch posts are dated the build date; the rest of the cluster
 * (see build-plan.json seo keywords) is grown after launch from the design-portal Blogs tab.
 */

$blogPosts = [
    [
        'slug'     => 'how-much-gravel-for-a-driveway-sherman-tx',
        'title'    => 'How Much Gravel Does a Driveway Need in Sherman, TX?',
        'excerpt'  => 'The cubic-yard formula, three worked driveway examples and the base-plus-top-rock layers a Grayson County clay lot needs before you order.',
        'image'    => '/assets/images/gravel-driveway-rural-960.webp',
        'alt'      => 'New tan gravel drive running across open pasture, with a green tractor at the left edge and fence posts in the distance',
        'date'     => 'October 15, 2026',
        'dateISO'  => '2026-10-15',
        'category' => 'Driveway Guides',
        'readtime' => '6 min read',
    ],
    [
        'slug'     => 'fix-gravel-driveway-after-heavy-rain-grayson-county',
        'title'    => 'Fixing a Gravel Driveway After Heavy Rain in Grayson County',
        'excerpt'  => 'How to dry out, patch and re-base a rutted gravel drive, and where rip rap over filter fabric keeps the next storm from taking it again.',
        'image'    => '/assets/images/rip-rap-slope-filter-fabric-960.webp',
        'alt'      => 'Two workers laying black filter fabric on a graded slope beside a pile of rip rap',
        'date'     => 'October 15, 2026',
        'dateISO'  => '2026-10-15',
        'category' => 'Wet-Weather Care',
        'readtime' => '6 min read',
    ],
];
