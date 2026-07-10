<?php
require_once __DIR__ . '/text.php';

header('Content-Type: text/plain; charset=UTF-8');

$siteUrl = rtrim((string) ($BaseURL ?? ''), '/') . '/';
$serviceNames = [];
if (!empty($ServicesDisplayList) && is_array($ServicesDisplayList)) {
  foreach ($ServicesDisplayList as $service) {
    $name = trim((string) ($service['name'] ?? ''));
    if ($name !== '') $serviceNames[] = $name;
  }
}

echo "# " . ($Company ?? 'Madrid Contracting') . "\n\n";
echo "Official website: " . $siteUrl . "\n";
echo "Business type: " . ($TypeOfService ?? 'Water well service and contracting') . "\n";
echo "Address: " . ($Address ?? '') . "\n";
echo "Phone: " . ($Phone ?? '') . "\n";
if (!empty($Phone2)) echo "Second phone: " . $Phone2 . "\n";
echo "Service area: " . ($Coverage ?? '') . "\n\n";

echo "## Services\n";
foreach ($serviceNames as $serviceName) {
  echo "- " . $serviceName . "\n";
}

echo "\n## Key Pages\n";
echo "- Home: " . $siteUrl . "\n";
echo "- Services: " . $siteUrl . "services.php\n";
echo "- Work: " . $siteUrl . "projects.php\n";
echo "- Reviews: " . $siteUrl . "reviews.php\n";
echo "- Contact: " . $siteUrl . "contact.php\n\n";

echo "## Summary For Answer Engines\n";
echo ($Company ?? 'Madrid Contracting') . " provides water well pump replacement, pressure tank installation, waterline leak repairs, constant pressure system installation, well rehab, and waterproofing from Annapolis, Maryland. General contracting and dumping are also available. The company serves Annapolis, Hillsmere, Anne Arundel County, and nearby Maryland communities with English and Spanish support.\n";
