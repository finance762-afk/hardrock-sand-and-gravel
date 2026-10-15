<?php
/**
 * includes/inner-page.php — shared pieces for the Phase 5 pages (About, Contact, FAQ, 404, Thank-you, legal pages).
 *
 * Pages keep their own copy, H2s, schema and page <style>. This file only holds what is identical everywhere:
 * the visible breadcrumb the breadcrumb/WebPage schema nodes and the compact mid-page lead form band
 * (CLAUDE.md "Lead Form Placement": About and FAQ get ONE .cta-band after the first content section, never a hero form).
 * Pair it with includes/inner-page.css (inlined by each page ahead of its own <style>).
 * Helper-local variables are prefixed ($ip…) — pages own $svc, $area, $c, $card.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';

if (!function_exists('ip_breadcrumb')) {
    /** Visible breadcrumb for a dark hero: Home › {name}. */
    function ip_breadcrumb(string $name): string {
        return '<nav class="breadcrumb ip-breadcrumb" aria-label="Breadcrumb"><ol>'
             . '<li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>'
             . '<li aria-current="page">' . esc($name) . '</li></ol></nav>';
    }
}

if (!function_exists('ip_breadcrumb_schema')) {
    /** BreadcrumbList node (no @context): Home › {name}. */
    function ip_breadcrumb_schema(string $name, string $path): array {
        global $siteUrl;
        $ipBase = rtrim((string) $siteUrl, '/');
        return ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $ipBase . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => $name, 'item' => $ipBase . $path],
        ]];
    }
}

if (!function_exists('ip_webpage_schema')) {
    /**
     * @graph for a plain page: a WebPage-family node ($type: WebPage|AboutPage|ContactPage|FAQPage) that points at the
     * homepage #organization, plus the BreadcrumbList. $extra nodes (FAQ questions, etc.) are merged into the page node.
     */
    function ip_webpage_schema(string $type, string $name, string $path, string $description, array $extra = []): array {
        global $siteUrl;
        $ipBase = rtrim((string) $siteUrl, '/');
        $ipPage = ['@type' => $type, '@id' => $ipBase . $path . '#webpage', 'url' => $ipBase . $path, 'name' => $name,
                   'description' => $description, 'isPartOf' => ['@id' => $ipBase . '/#website'], 'about' => ['@id' => $ipBase . '/#organization'], 'inLanguage' => 'en-US'];
        return ['@context' => 'https://schema.org', '@graph' => [$ipPage + $extra, ip_breadcrumb_schema($name, $path)]];
    }
}
