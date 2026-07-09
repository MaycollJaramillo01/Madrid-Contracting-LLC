<?php
require_once __DIR__ . '/text.php';

header('Content-Type: application/xml; charset=UTF-8');

$siteUrl = rtrim((string) ($BaseURL ?? ''), '/') . '/';
$lastmod = date('Y-m-d');

$pages = [
  ['loc' => $siteUrl, 'changefreq' => 'weekly', 'priority' => '1.0'],
  ['loc' => $siteUrl . 'about.php', 'changefreq' => 'monthly', 'priority' => '0.8'],
  ['loc' => $siteUrl . 'services.php', 'changefreq' => 'weekly', 'priority' => '0.95'],
  ['loc' => $siteUrl . 'projects.php', 'changefreq' => 'monthly', 'priority' => '0.75'],
  ['loc' => $siteUrl . 'reviews.php', 'changefreq' => 'monthly', 'priority' => '0.7'],
  ['loc' => $siteUrl . 'contact.php', 'changefreq' => 'monthly', 'priority' => '0.9'],
];

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
<?php foreach ($pages as $page): ?>
  <url>
    <loc><?php echo htmlspecialchars($page['loc'], ENT_XML1, 'UTF-8'); ?></loc>
    <lastmod><?php echo htmlspecialchars($lastmod, ENT_XML1, 'UTF-8'); ?></lastmod>
    <changefreq><?php echo htmlspecialchars($page['changefreq'], ENT_XML1, 'UTF-8'); ?></changefreq>
    <priority><?php echo htmlspecialchars($page['priority'], ENT_XML1, 'UTF-8'); ?></priority>
    <?php if (!empty($BrandLogo)): ?>
    <image:image>
      <image:loc><?php echo htmlspecialchars($siteUrl . ltrim((string) $BrandLogo, '/'), ENT_XML1, 'UTF-8'); ?></image:loc>
      <image:title><?php echo htmlspecialchars($Company ?? 'Madrid Contracting', ENT_XML1, 'UTF-8'); ?></image:title>
    </image:image>
    <?php endif; ?>
  </url>
<?php endforeach; ?>
</urlset>
