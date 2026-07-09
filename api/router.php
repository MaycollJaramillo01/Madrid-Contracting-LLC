<?php
declare(strict_types=1);

$publicPhpRoutes = [
    'index.php',
    'about.php',
    'services.php',
    'service-page.php',
    'other-services.php',
    'projects.php',
    'reviews.php',
    'testimonials.php',
    'contact.php',
    'send-mail.php',
    'thank-you.php',
    'business-card.php',
    'bussiness-card.php',
    'robots.php',
    'sitemap.php',
    'llms.php',
    'utils/captcha.php',
];

$requestUri = (string)($_SERVER['REQUEST_URI'] ?? '/');
$path = parse_url($requestUri, PHP_URL_PATH);
$path = is_string($path) ? $path : '/';
$path = '/' . ltrim($path, '/');
$requested = trim($path, '/');

if ($requested === '') {
    $requested = 'index.php';
}

$requested = str_replace('\\', '/', $requested);
$requested = preg_replace('#/+#', '/', $requested) ?? $requested;

$projectRoot = dirname(__DIR__);
$requestedFile = $projectRoot . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $requested);
if (
    is_file($requestedFile)
    && (
        str_starts_with($requested, 'assets/')
        || str_starts_with($requested, 'data/')
    )
) {
    return false;
}

$specialRoutes = [
    'robots.txt' => 'robots.php',
    'sitemap.xml' => 'sitemap.php',
    'llms.txt' => 'llms.php',
];

if (isset($specialRoutes[$requested])) {
    $requested = $specialRoutes[$requested];
}

if (!str_contains($requested, '.')) {
    $extensionless = $requested . '.php';
    if (in_array($extensionless, $publicPhpRoutes, true)) {
        $requested = $extensionless;
    }
}

if (!in_array($requested, $publicPhpRoutes, true)) {
    http_response_code(404);
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'Not Found';
    exit;
}

$targetFile = $projectRoot . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $requested);

if (!is_file($targetFile)) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'Invalid route target';
    exit;
}

chdir($projectRoot);
$_SERVER['SCRIPT_NAME'] = '/' . $requested;
$_SERVER['PHP_SELF'] = '/' . $requested;
$_SERVER['SCRIPT_FILENAME'] = $targetFile;

require $targetFile;
