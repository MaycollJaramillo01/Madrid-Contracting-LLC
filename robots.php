<?php
require_once __DIR__ . '/text.php';

header('Content-Type: text/plain; charset=UTF-8');

$siteUrl = rtrim((string) ($BaseURL ?? ''), '/') . '/';

echo "User-agent: *\n";
echo "Allow: /\n";
echo "Disallow: /api/\n";
echo "Disallow: /utils/\n";
echo "Disallow: /send-mail.php\n";
echo "\n";
echo "Sitemap: " . $siteUrl . "sitemap.xml\n";
