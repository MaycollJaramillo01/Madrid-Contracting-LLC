<?php
$defaultPageName = $namepage ?? ($NavCopy['home'] ?? '');
$currentScriptName = basename($_SERVER['SCRIPT_NAME'] ?? '') ?: 'index.php';
$pageSeoKey = $currentScriptName === 'index.php' ? 'home' : preg_replace('/\.php$/', '', $currentScriptName);

$defaultSeoTitles = [
    'home' => sprintf('%s | Water Well Service & Contracting in Annapolis, MD', $Company ?? 'Madrid Contracting'),
    'about' => sprintf('About %s | Annapolis Water Well Contractor', $Company ?? 'Madrid Contracting'),
    'services' => sprintf('Water Well Services in Annapolis, MD | %s', $Company ?? 'Madrid Contracting'),
    'projects' => sprintf('Water Well & Contracting Work in Maryland | %s', $Company ?? 'Madrid Contracting'),
    'reviews' => sprintf('Customer Reviews | %s Annapolis, MD', $Company ?? 'Madrid Contracting'),
    'contact' => sprintf('Request Water Well Service in Annapolis, MD | %s', $Company ?? 'Madrid Contracting'),
    'thank-you' => sprintf('Thank You | %s', $Company ?? 'Madrid Contracting')
];

$defaultSeoDescriptions = [
    'home' => sprintf('%s provides water well pump replacement, pressure tank installation, waterline leak repairs, constant pressure system installation, well rehab, and waterproofing. General contracting and dumping are also available across Anne Arundel, Calvert, Prince George\'s, Howard, Baltimore, Charles, and Saint Mary\'s counties.', $Company ?? 'Madrid Contracting'),
    'about' => sprintf('Learn about %s, an Annapolis-based water well service and contracting company serving Maryland properties with pump, tank, leak, pressure, rehab, waterproofing, and property support.', $Company ?? 'Madrid Contracting'),
    'services' => 'Water well services in Annapolis, MD: water well pump replacement, pressure tank installation, waterline leak repairs, constant pressure system installation, well rehab, and waterproofing. General contracting and dumping are also available.',
    'projects' => 'See field work and service photos from Madrid Contracting water well service, waterproofing, contracting, and property support across Central Maryland counties.',
    'reviews' => 'Read customer feedback for Madrid Contracting water well service and contracting support across Central Maryland.',
    'contact' => 'Call Madrid Contracting to schedule water well service, pressure tank installation, waterline repair, waterproofing, general contracting, or dumping in Annapolis, MD.',
    'thank-you' => sprintf('Thank you for contacting %s. Our team will follow up about your water well or contracting request.', $Company ?? 'Madrid Contracting')
];

$PageTitle = $PageTitle ?? ($defaultSeoTitles[$pageSeoKey] ?? sprintf('%s | %s', $Company ?? '', $defaultPageName));
$PageDescription = $PageDescription ?? ($defaultSeoDescriptions[$pageSeoKey] ?? ($ExHome ?? ($Home[0] ?? '')));
$canonicalPath = basename($_SERVER['SCRIPT_NAME'] ?? '') ?: '';
$canonicalSlug = ($canonicalPath !== '' && $canonicalPath !== 'index.php') ? ltrim($canonicalPath, '/') : '';
$PageCanonical = $PageCanonical ?? rtrim($BaseURL ?? '', '/') . ($canonicalSlug !== '' ? '/' . $canonicalSlug : '/');

if (!function_exists('siteAbsoluteUrl')) {
    function siteAbsoluteUrl($url) {
        global $BaseURL;
        $url = trim((string) $url);
        if ($url === '') return '';
        if (preg_match('/^(https?:)?\/\//i', $url)) return $url;
        if (preg_match('/^(tel|mailto):/i', $url)) return $url;
        return rtrim((string) ($BaseURL ?? ''), '/') . '/' . ltrim($url, '/');
    }
}

$seoCompany = trim((string) ($Company ?? 'Madrid Contracting'));
$seoDescription = trim((string) $PageDescription);
$seoCanonical = siteAbsoluteUrl($PageCanonical);
$seoSiteUrl = rtrim((string) ($BaseURL ?? $seoCanonical), '/') . '/';
$seoBusinessId = $seoSiteUrl . '#localbusiness';
$seoWebsiteId = $seoSiteUrl . '#website';
$seoLogo = siteAbsoluteUrl($BrandLogo ?? 'assets/img/logo.png');
$seoImage = siteAbsoluteUrl($PageHeroCopy[$pageSeoKey]['bg'] ?? ($PageHeroCopy['default']['bg'] ?? (function_exists('stockImage') ? stockImage('hero1') : ($BrandLogo ?? ''))));
$seoPhone = trim((string) ($Phone ?? ''));
$seoPhone2 = trim((string) ($Phone2 ?? ''));
$seoKeywords = array_values(array_unique(array_filter(array_merge(
    [
        'water well service Annapolis MD',
        'water well pump replacement Annapolis',
        'pressure tank installation Maryland',
        'waterline leak repair Annapolis',
        'constant pressure system installation',
        'well rehab Maryland',
        'waterproofing Annapolis MD',
        'general contracting Annapolis',
        'dumping service Annapolis MD'
    ],
    is_array($Areas ?? null) ? $Areas : []
))));

$seoSocialProfiles = array_values(array_filter([
    trim((string) ($facebook ?? '')),
    trim((string) ($instagram ?? '')),
    trim((string) ($google ?? '')),
    trim((string) ($tiktok ?? ''))
]));

$seoServiceItems = [];
if (!empty($ServicesDisplayList) && is_array($ServicesDisplayList)) {
    foreach ($ServicesDisplayList as $serviceIndex => $service) {
        if (!is_array($service)) continue;
        $serviceName = trim((string) ($service['name'] ?? ''));
        if ($serviceName === '') continue;
        $seoServiceItems[] = [
            '@type' => 'Offer',
            'position' => $serviceIndex + 1,
            'itemOffered' => [
                '@type' => 'Service',
                'name' => $serviceName,
                'description' => trim((string) ($service['description'] ?? $service['excerpt'] ?? '')),
                'serviceType' => $serviceName,
                'areaServed' => array_map(static function ($area) {
                    return ['@type' => 'Place', 'name' => $area];
                }, is_array($Areas ?? null) ? $Areas : []),
                'provider' => ['@id' => $seoBusinessId],
                'url' => siteAbsoluteUrl($service['url'] ?? 'services.php')
            ]
        ];
    }
}

$seoFaqItems = [];
if (!empty($FaqCopy['items']) && is_array($FaqCopy['items'])) {
    foreach ($FaqCopy['items'] as $item) {
        $question = trim((string) ($item['q'] ?? ''));
        $answer = trim((string) ($item['a'] ?? ''));
        if ($question === '' || $answer === '') continue;
        $seoFaqItems[] = [
            '@type' => 'Question',
            'name' => $question,
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $answer
            ]
        ];
    }
}

$seoGraph = [
    [
        '@type' => 'HomeAndConstructionBusiness',
        '@id' => $seoBusinessId,
        'name' => $seoCompany,
        'alternateName' => $CustomerName ?? $seoCompany,
        'url' => $seoSiteUrl,
        'logo' => $seoLogo,
        'image' => array_values(array_filter([$seoImage, $seoLogo])),
        'description' => $seoDescription,
        'telephone' => $seoPhone,
        'priceRange' => '$$',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $StreetAddress ?? $Address ?? '',
            'addressLocality' => $AddressLocality ?? 'Annapolis',
            'addressRegion' => $AddressRegion ?? 'MD',
            'postalCode' => $PostalCode ?? '21403',
            'addressCountry' => $AddressCountry ?? 'US'
        ],
        'areaServed' => array_map(static function ($area) {
            return ['@type' => 'Place', 'name' => $area];
        }, is_array($Areas ?? null) ? $Areas : []),
        'knowsAbout' => [
            'Water well pump replacement',
            'Pressure tank installation',
            'Waterline leak repairs',
            'Constant pressure systems',
            'Well rehab',
            'Waterproofing',
            'General contracting',
            'Dumping'
        ],
        'contactPoint' => array_values(array_filter([
            [
                '@type' => 'ContactPoint',
                'telephone' => $seoPhone,
                'contactType' => 'customer service',
                'areaServed' => 'US-MD',
                'availableLanguage' => ['English', 'Spanish']
            ],
            $seoPhone2 !== '' ? [
                '@type' => 'ContactPoint',
                'telephone' => $seoPhone2,
                'contactType' => 'customer service',
                'areaServed' => 'US-MD',
                'availableLanguage' => ['English', 'Spanish']
            ] : null
        ])),
        'sameAs' => $seoSocialProfiles
    ],
    [
        '@type' => 'WebSite',
        '@id' => $seoWebsiteId,
        'url' => $seoSiteUrl,
        'name' => $seoCompany,
        'publisher' => ['@id' => $seoBusinessId],
        'inLanguage' => 'en-US'
    ],
    [
        '@type' => 'WebPage',
        '@id' => $seoCanonical . '#webpage',
        'url' => $seoCanonical,
        'name' => $PageTitle,
        'description' => $seoDescription,
        'isPartOf' => ['@id' => $seoWebsiteId],
        'about' => ['@id' => $seoBusinessId],
        'primaryImageOfPage' => $seoImage !== '' ? ['@type' => 'ImageObject', 'url' => $seoImage] : null,
        'inLanguage' => 'en-US',
        'speakable' => [
            '@type' => 'SpeakableSpecification',
            'cssSelector' => ['h1', '.lead', '.section-title p']
        ]
    ],
    [
        '@type' => 'OfferCatalog',
        '@id' => $seoCanonical . '#services',
        'name' => 'Madrid Contracting services',
        'itemListElement' => $seoServiceItems
    ],
    [
        '@type' => 'BreadcrumbList',
        '@id' => $seoCanonical . '#breadcrumbs',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => $seoSiteUrl
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $defaultPageName,
                'item' => $seoCanonical
            ]
        ]
    ]
];

if (!empty($seoFaqItems)) {
    $seoGraph[] = [
        '@type' => 'FAQPage',
        '@id' => $seoCanonical . '#faq',
        'mainEntity' => $seoFaqItems
    ];
}

$seoSchema = [
    '@context' => 'https://schema.org',
    '@graph' => $seoGraph
];

// Aseguramos variables de redes sociales
$fb_url = $facebook ?? '';
$insta_url = $instagram ?? '';
$goo_url = $google ?? '';
$tik_url = $tiktok ?? '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($PageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($seoDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="<?php echo htmlspecialchars($seoCompany, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars(implode(', ', $seoKeywords), ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="geo.region" content="US-MD">
    <meta name="geo.placename" content="<?php echo htmlspecialchars(($AddressLocality ?? 'Annapolis') . ', ' . ($AddressRegion ?? 'MD'), ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="coverage" content="<?php echo htmlspecialchars($Coverage ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="theme-color" content="<?php echo htmlspecialchars($BrandColors['primary'] ?? '#0D1B2A', ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_US">
    <meta property="og:site_name" content="<?php echo htmlspecialchars($seoCompany, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($PageTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($seoDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($seoCanonical, ENT_QUOTES, 'UTF-8'); ?>">
    <?php if ($seoImage !== ''): ?><meta property="og:image" content="<?php echo htmlspecialchars($seoImage, ENT_QUOTES, 'UTF-8'); ?>"><?php endif; ?>
    <meta property="business:contact_data:street_address" content="<?php echo htmlspecialchars($StreetAddress ?? $Address ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="business:contact_data:locality" content="<?php echo htmlspecialchars($AddressLocality ?? 'Annapolis', ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="business:contact_data:region" content="<?php echo htmlspecialchars($AddressRegion ?? 'MD', ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="business:contact_data:postal_code" content="<?php echo htmlspecialchars($PostalCode ?? '21403', ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="business:contact_data:country_name" content="<?php echo htmlspecialchars($AddressCountry ?? 'US', ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="business:contact_data:phone_number" content="<?php echo htmlspecialchars($seoPhone, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($PageTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($seoDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <?php if ($seoImage !== ''): ?><meta name="twitter:image" content="<?php echo htmlspecialchars($seoImage, ENT_QUOTES, 'UTF-8'); ?>"><?php endif; ?>
    <link rel="canonical" href="<?php echo htmlspecialchars($seoCanonical, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="icon" type="image/png" href="<?php echo htmlspecialchars($BrandLogo ?? 'assets/img/logo.png', ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="apple-touch-icon" href="<?php echo htmlspecialchars($BrandLogo ?? 'assets/img/logo.png', ENT_QUOTES, 'UTF-8'); ?>">
    <script type="application/ld+json"><?php echo json_encode($seoSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
    
    <link rel="stylesheet" href="assets/css/style.css">
    
    <style>
        <?php echo $BrandCSSVars; ?>

        .site-header {
            background: #ffffff;
            border-bottom: 1px solid rgba(31, 42, 54, 0.14);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .site-header + main {
            margin: 0;
            padding: 0;
        }

        .site-header + main > :first-child {
            margin-top: 0 !important;
        }

        .header-main {
            padding: 6px 0;
            background: #ffffff;
            border-bottom: 1px solid rgba(31, 42, 54, 0.1);
        }

        .header-container {
            display: grid;
            grid-template-columns: auto minmax(0, 1fr) auto;
            align-items: center;
            gap: 20px;
            min-height: 136px;
            max-width: min(1680px, 97vw);
            width: 100%;
            margin: 0 auto;
            padding-left: clamp(14px, 2vw, 34px);
            padding-right: clamp(14px, 2vw, 34px);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            flex-shrink: 0;
            max-width: 460px;
            min-width: 0;
        }

        .brand-mark {
            width: 54px;
            height: 54px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--brand-primary);
            color: var(--brand-accent);
            border: 1px solid rgba(var(--brand-accent-rgb), 0.45);
            border-radius: 8px;
            font-family: 'Oswald', sans-serif;
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 0;
            flex: 0 0 auto;
        }

        .brand-wordmark {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .brand-wordmark strong {
            color: var(--brand-primary);
            font-family: 'Oswald', sans-serif;
            font-size: clamp(1.05rem, 1.45vw, 1.4rem);
            line-height: 1;
            letter-spacing: 0;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .brand-wordmark span {
            margin-top: 4px;
            color: var(--brand-secondary);
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .logo-img {
            height: 132px;
            min-height: 132px;
            max-height: 146px;
            max-width: 360px;
            width: auto;
            display: block;
            object-fit: contain;
            transition: all 0.3s ease;
        }

        .site-logo-img {
            flex: 0 0 auto;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .brand-title {
            font-weight: 800;
            letter-spacing: 0.5px;
            color: #ffffff;
            font-size: 1rem;
            text-transform: uppercase;
        }

        .brand-sub {
            font-size: 0.7rem;
            letter-spacing: 3px;
            color: var(--brand-primary);
            text-transform: uppercase;
            margin-top: 4px;
        }

        .main-nav {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-nav ul {
            display: flex;
            align-items: center;
            gap: 20px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        /* Prevent global text animation from hiding header links */
        .site-header .main-nav .text-animate,
        .site-header .main-nav .text-animate.is-visible {
            opacity: 1 !important;
            transform: none !important;
            animation: none !important;
        }

        .main-nav > ul > li > a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            line-height: 1;
            min-height: 40px;
            text-decoration: none;
            color: var(--brand-secondary);
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.2s ease;
        }

        .dropdown-arrow {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 0.72rem;
            transform: translateY(-1px);
            margin-left: 2px;
        }

        .main-nav > ul > li > a:hover,
        .main-nav > ul > li > a:focus {
            color: var(--brand-primary);
        }

        .has-dropdown {
            position: relative;
        }

        .dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 220px;
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            padding: 8px 0;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.08);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.2s ease;
            z-index: 10;
        }

        .has-dropdown:hover .dropdown,
        .has-dropdown:focus-within .dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .has-dropdown.open > a .dropdown-arrow {
            transform: rotate(180deg);
        }

        .dropdown--services {
            min-width: min(760px, 84vw);
            padding: 14px;
            display: grid;
            grid-template-columns: repeat(2, minmax(230px, 1fr));
            gap: 10px;
            max-height: min(68vh, 480px);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .dropdown--services::-webkit-scrollbar {
            width: 8px;
        }

        .dropdown--services::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 999px;
        }

        .dropdown-services__all,
        .dropdown-services__other {
            grid-column: 1 / -1;
            list-style: none;
        }

        .dropdown-services__all > a,
        .dropdown-services__other > a {
            display: block;
            padding: 9px 12px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.83rem;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            background: rgba(31, 42, 54, 0.04);
        }

        .dropdown-group {
            list-style: none;
            border: 1px solid rgba(31, 42, 54, 0.08);
            border-radius: 10px;
            padding: 10px 12px;
            background: #fff;
        }

        .dropdown-group__title {
            display: block;
            margin: 0 0 6px;
            color: #1c1c1c;
            font-size: 0.74rem;
            font-weight: 800;
            letter-spacing: 1.1px;
            text-transform: uppercase;
        }

        .dropdown-group__list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .dropdown-group__list li {
            list-style: none;
        }

        .dropdown .dropdown-group__list li a {
            display: block;
            padding: 6px 0;
            border-radius: 6px;
            font-size: 0.87rem;
            line-height: 1.35;
        }

        .dropdown .dropdown-group__list li a:hover {
            padding-left: 4px;
        }

        .dropdown li a {
            display: block;
            padding: 10px 16px;
            color: #1f1f1f;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .dropdown li a:hover {
            background: rgba(0, 0, 0, 0.04);
            color: var(--brand-primary);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            justify-self: end;
        }

        /* --- REDES SOCIALES ESTILOS (Global) --- */
        .header-socials {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .social-icon-link {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: rgba(31, 42, 54, 0.06);
            color: var(--brand-secondary);
            display: flex; /* Flex para centrar el icono */
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1rem;
            flex-shrink: 0; /* Evita que se aplasten */
            border: 1px solid rgba(31, 42, 54, 0.2);
        }

        .social-icon-link:hover {
            background-color: var(--brand-primary);
            color: #ffffff;
            transform: translateY(-2px);
        }

        .btn-estimate {
            background: var(--brand-accent);
            color: var(--brand-secondary);
            padding: 10px 20px;
            border-radius: 999px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.72rem;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
            white-space: nowrap;
        }

        .btn-estimate:hover,
        .btn-estimate:focus {
            transform: translateY(-1px);
            color: var(--brand-secondary);
            box-shadow: 0 16px 30px rgba(0, 0, 0, 0.18);
        }

        .language-switcher {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px;
            border-radius: 999px;
            background: #0b0b0d;
            border: 1px solid rgba(var(--brand-accent-rgb), 0.45);
        }

        .language-switcher button {
            border: 0;
            border-radius: 999px;
            padding: 8px 12px;
            background: transparent;
            color: #fff;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.02em;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            line-height: 1;
        }

        .language-switcher button.active,
        .language-switcher button:hover {
            background: var(--brand-accent);
            color: #050505;
        }

        .lang-flag {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            background: #fff;
            box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.14);
            flex: 0 0 auto;
        }

        .lang-label {
            white-space: nowrap;
        }

        .mobile-toggle {
            display: none;
            width: 44px;
            height: 44px;
            border: 1px solid rgba(31, 42, 54, 0.28);
            border-radius: 10px;
            background: #ffffff;
            align-items: center;
            justify-content: center;
            gap: 4px;
            flex-direction: column;
        }

        .mobile-toggle span {
            width: 22px;
            height: 2px;
            background: var(--brand-secondary);
            display: block;
            border-radius: 2px;
        }

        .mobile-menu-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            z-index: 999;
        }

        body.nav-open .mobile-menu-overlay {
            display: block;
        }

        body.nav-open .floating-actions {
            display: none !important;
        }

        .menu-close {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--brand-secondary);
        }

        @media (max-width: 991px) {
            .header-main {
                padding: 10px 0;
            }

            .brand {
                max-width: min(315px, calc(100vw - 92px));
            }

            .logo-img {
                width: min(285px, 66vw);
                height: auto;
                min-height: 0;
                max-height: 92px;
            }

            .header-container {
                grid-template-columns: minmax(0, 1fr) auto;
                min-height: 96px;
                gap: 12px;
            }

            .brand-text {
                display: none;
            }

            .main-nav {
                position: fixed;
                top: 0;
                right: 0;
                width: 85%;
                height: 100vh;
                background: #ffffff;
                padding: 28px 20px;
                transition: transform 0.3s ease;
                transform: translateX(110%);
                flex-direction: column;
                align-items: flex-start;
                justify-content: flex-start;
                gap: 24px;
                z-index: 1000;
                overflow-y: auto;
            }

            .main-nav.is-open {
                transform: translateX(0);
            }

            .menu-close {
                display: inline-flex;
                align-self: flex-end;
            }

            .main-nav ul {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
                gap: 0;
                background: transparent;
                height: auto;
                min-height: 0;
                padding: 0;
                overflow: visible;
            }

            .main-nav ul li {
                width: 100%;
            }

            /* Estilos generales para enlaces del menÃº */
            .main-nav ul li > a {
                display: block;
                padding: 14px 4px;
                width: 100%;
                border-bottom: 1px solid rgba(31, 42, 54, 0.14);
                color: var(--brand-secondary) !important;
                opacity: 1 !important;
            }

            .dropdown li a {
                color: var(--brand-secondary);
            }

            .dropdown li a:hover {
                background: rgba(31, 42, 54, 0.06);
                color: var(--brand-primary);
            }

            .dropdown {
                position: static;
                opacity: 1;
                visibility: visible;
                transform: none;
                border: none;
                box-shadow: none;
                padding: 0;
                display: none;
                width: 100%;
            }

            .has-dropdown.open .dropdown {
                display: block;
            }

            .dropdown li a {
                padding-left: 16px;
            }

            .dropdown--services {
                min-width: 100%;
                display: block;
                padding: 2px 0;
                border: none;
            }

            .dropdown-services__all > a,
            .dropdown-services__other > a {
                border-radius: 0;
                background: transparent;
                padding: 10px 0;
                font-size: 0.82rem;
            }

            .dropdown-group {
                border: none;
                border-top: 1px solid rgba(31, 42, 54, 0.14);
                border-radius: 0;
                padding: 10px 0 8px;
                background: transparent;
            }

            .dropdown-group__title {
                margin-bottom: 4px;
                font-size: 0.72rem;
                color: var(--brand-primary);
            }

            .dropdown-group__list li a {
                padding: 9px 0 9px 10px;
                font-size: 0.9rem;
            }

            .header-actions .btn-estimate,
            .header-actions .header-socials {
                display: none;
            }

            .mobile-toggle {
                display: inline-flex;
            }

            .mobile-cta {
                margin-top: 20px;
                display: flex;
                flex-direction: column;
                gap: 20px;
                width: 100%;
                /* Importante: quitamos borde inferior del contenedor CTA */
                border-bottom: none !important; 
            }

            /* CorrecciÃ³n para que el botÃ³n de estimado no herede estilos de enlace de menÃº */
            .mobile-cta a.btn-estimate {
                width: 100%;
                text-align: center;
                display: flex; 
                border-bottom: none;
                padding: 14px;
            }

            .mobile-cta .language-switcher {
                margin: 0 auto 4px;
            }

            /* --- CORRECCIÃ“N DE REDES SOCIALES EN MÃ“VIL --- */
            .mobile-socials {
                display: flex;
                justify-content: center;
                gap: 15px;
                margin-top: 10px;
                padding-bottom: 20px;
            }

            /* Forzamos estilos para los iconos dentro del menÃº mÃ³vil para sobreescribir los estilos generales de 'a' */
            .mobile-socials .social-icon-link {
                display: inline-flex !important; /* Sobreescribe display: block */
                width: 36px !important;         /* Restaura el ancho */
                border-bottom: none !important; /* Quita la l\u00ednea de abajo */
                padding: 0 !important;          /* Quita el padding de men\u00fa */
                background-color: rgba(31, 42, 54, 0.06);
                color: var(--brand-secondary) !important;
                border: 1px solid rgba(31, 42, 54, 0.2) !important;
            }
        }

        @media (max-width: 575px) {
            .brand {
                max-width: min(255px, calc(100vw - 84px));
            }

            .brand-mark {
                width: 46px;
                height: 46px;
                font-size: 1rem;
            }

            .brand-wordmark strong {
                font-size: 0.98rem;
            }

            .brand-wordmark span {
                font-size: 0.58rem;
                letter-spacing: 0.09em;
            }

            .logo-img {
                width: min(235px, 62vw);
                max-height: 82px;
            }

            .header-container {
                min-height: 90px;
                padding-left: 12px;
                padding-right: 12px;
            }

            .mobile-toggle {
                width: 42px;
                height: 42px;
            }
        }
    </style>
</head>
<?php
$bodyClassAttr = trim((string) ($BodyClass ?? ''));
?>
<body<?php echo $bodyClassAttr !== '' ? ' class="' . htmlspecialchars($bodyClassAttr, ENT_QUOTES, 'UTF-8') . '"' : ''; ?>>

<header class="site-header">
    <div class="header-main">
        <div class="container header-container">
            <?php
            $companyParts = preg_split('/\s+/', trim($Company ?? ''));
            $brandLine1 = implode(' ', array_slice($companyParts, 0, 2));
            $brandLine2 = implode(' ', array_slice($companyParts, 2));
            $brandLogoUrl = trim((string) ($BrandLogo ?? ''));
            ?>
            <a href="<?php echo $BaseURL; ?>" class="brand">
                <?php if ($brandLogoUrl !== ''): ?>
                    <img class="logo-img site-logo-img" src="<?php echo htmlspecialchars($brandLogoUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($Company, ENT_QUOTES, 'UTF-8'); ?>">
                <?php else: ?>
                    <span class="brand-mark" aria-hidden="true">MC</span>
                    <span class="brand-wordmark">
                        <strong><?php echo htmlspecialchars($Company, ENT_QUOTES, 'UTF-8'); ?></strong>
                        <span><?php echo htmlspecialchars($TypeOfService ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
                    </span>
                <?php endif; ?>
            </a>

            <nav class="main-nav" id="mainNav" aria-label="<?php echo htmlspecialchars($AriaCopy['primary_nav'] ?? ''); ?>">
                <button class="menu-close d-lg-none" aria-label="<?php echo htmlspecialchars($HeaderCopy['menu_close'] ?? ''); ?>">
                    <i class="fa-solid fa-xmark"></i>
                </button>

                <ul>
                    <li><a href="<?php echo $BaseURL; ?>"><?php echo $NavCopy['home'] ?? ''; ?></a></li>
                    <li><a href="about.php"><?php echo $NavCopy['about'] ?? ''; ?></a></li>
                    <li><a href="services.php"><?php echo htmlspecialchars($NavCopy['services'] ?? 'Services', ENT_QUOTES, 'UTF-8'); ?></a></li>
                    <li><a href="projects.php"><?php echo $NavCopy['projects'] ?? ''; ?></a></li>
                    
                    <li><a href="contact.php"><?php echo $NavCopy['contact'] ?? ''; ?></a></li>
                    
                    <li class="mobile-cta d-lg-none">
                        <a href="<?php echo $PhoneRef; ?>" class="btn-estimate"><?php echo $NavCopy['cta_mobile'] ?? ''; ?></a>
                        <div class="language-switcher" aria-label="<?php echo htmlspecialchars($LanguageCopy['label'] ?? 'Language', ENT_QUOTES, 'UTF-8'); ?>">
                            <button type="button" data-lang="en" aria-label="<?php echo htmlspecialchars($LanguageCopy['english'] ?? 'English', ENT_QUOTES, 'UTF-8'); ?>">
                                <span class="lang-flag" aria-hidden="true">🇺🇸</span>
                                <span class="lang-label"><?php echo htmlspecialchars($LanguageCopy['english'] ?? 'English', ENT_QUOTES, 'UTF-8'); ?></span>
                            </button>
                            <button type="button" data-lang="es" aria-label="<?php echo htmlspecialchars($LanguageCopy['spanish'] ?? 'Espanol', ENT_QUOTES, 'UTF-8'); ?>">
                                <span class="lang-flag" aria-hidden="true">🇪🇸</span>
                                <span class="lang-label"><?php echo htmlspecialchars($LanguageCopy['spanish'] ?? 'Espanol', ENT_QUOTES, 'UTF-8'); ?></span>
                            </button>
                        </div>
                        
                        <div class="mobile-socials">
                            <?php if(!empty($fb_url)): ?>
                                <a href="<?php echo $fb_url; ?>" target="_blank" class="social-icon-link"><i class="fab fa-facebook-f"></i></a>
                            <?php endif; ?>
                            <?php if(!empty($messenger)): ?>
                                <a href="<?php echo $messenger; ?>" target="_blank" class="social-icon-link"><i class="fab fa-facebook-messenger"></i></a>
                            <?php endif; ?>
                            <?php if(!empty($insta_url)): ?>
                                <a href="<?php echo $insta_url; ?>" target="_blank" class="social-icon-link"><i class="fab fa-instagram"></i></a>
                            <?php endif; ?>
                            <?php if(!empty($goo_url)): ?>
                                <a href="<?php echo $goo_url; ?>" target="_blank" class="social-icon-link"><i class="fab fa-google"></i></a>
                            <?php endif; ?>
                            <?php if(!empty($tik_url)): ?>
                                <a href="<?php echo $tik_url; ?>" target="_blank" class="social-icon-link"><i class="fab fa-tiktok"></i></a>
                            <?php endif; ?>
                            <?php if(!empty($whatsapp)): ?>
                                <a href="<?php echo $whatsapp; ?>" target="_blank" class="social-icon-link"><i class="fab fa-whatsapp"></i></a>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="header-actions">
                <div class="header-socials d-none d-lg-flex">
                    <?php if(!empty($fb_url)): ?>
                        <a href="<?php echo $fb_url; ?>" target="_blank" class="social-icon-link" title="<?php echo htmlspecialchars($HeaderCopy['social_titles']['facebook'] ?? ''); ?>"><i class="fab fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($messenger)): ?>
                        <a href="<?php echo $messenger; ?>" target="_blank" class="social-icon-link" title="<?php echo htmlspecialchars($HeaderCopy['social_titles']['messenger'] ?? ''); ?>"><i class="fab fa-facebook-messenger"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($goo_url)): ?>
                        <a href="<?php echo $goo_url; ?>" target="_blank" class="social-icon-link" title="<?php echo htmlspecialchars($HeaderCopy['social_titles']['google'] ?? ''); ?>"><i class="fab fa-google"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($insta_url)): ?>
                        <a href="<?php echo $insta_url; ?>" target="_blank" class="social-icon-link" title="<?php echo htmlspecialchars($HeaderCopy['social_titles']['instagram'] ?? ''); ?>"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($tik_url)): ?>
                        <a href="<?php echo $tik_url; ?>" target="_blank" class="social-icon-link" title="<?php echo htmlspecialchars($HeaderCopy['social_titles']['tiktok'] ?? ''); ?>"><i class="fab fa-tiktok"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($whatsapp)): ?>
                        <a href="<?php echo $whatsapp; ?>" target="_blank" class="social-icon-link" title="<?php echo htmlspecialchars($HeaderCopy['social_titles']['whatsapp'] ?? ''); ?>"><i class="fab fa-whatsapp"></i></a>
                    <?php endif; ?>
                </div>

                <div class="language-switcher d-none d-lg-inline-flex" aria-label="<?php echo htmlspecialchars($LanguageCopy['label'] ?? 'Language', ENT_QUOTES, 'UTF-8'); ?>">
                    <button type="button" data-lang="en" aria-label="<?php echo htmlspecialchars($LanguageCopy['english'] ?? 'English', ENT_QUOTES, 'UTF-8'); ?>">
                        <span class="lang-flag" aria-hidden="true">🇺🇸</span>
                        <span class="lang-label"><?php echo htmlspecialchars($LanguageCopy['english'] ?? 'English', ENT_QUOTES, 'UTF-8'); ?></span>
                    </button>
                    <button type="button" data-lang="es" aria-label="<?php echo htmlspecialchars($LanguageCopy['spanish'] ?? 'Espanol', ENT_QUOTES, 'UTF-8'); ?>">
                        <span class="lang-flag" aria-hidden="true">🇪🇸</span>
                        <span class="lang-label"><?php echo htmlspecialchars($LanguageCopy['spanish'] ?? 'Espanol', ENT_QUOTES, 'UTF-8'); ?></span>
                    </button>
                </div>

                <a href="<?php echo $PhoneRef; ?>" class="btn-estimate"><?php echo $NavCopy['cta'] ?? ''; ?></a>
                
                <button class="mobile-toggle" type="button" aria-label="<?php echo htmlspecialchars($HeaderCopy['menu_toggle'] ?? ''); ?>" aria-controls="mainNav" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
        <div class="mobile-menu-overlay"></div>
    </div>
</header>
<div id="google_translate_element" aria-hidden="true"></div>
<script>
    window.googleTranslateElementInit = function () {
        if (!window.google || !google.translate) return;
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,es',
            autoDisplay: false
        }, 'google_translate_element');
    };

    (function () {
        const buttons = document.querySelectorAll('.language-switcher [data-lang]');
        const current = /googtrans=\/en\/es/.test(document.cookie) ? 'es' : 'en';

        buttons.forEach((button) => {
            button.classList.toggle('active', button.dataset.lang === current);
            button.addEventListener('click', () => {
                const lang = button.dataset.lang === 'es' ? 'es' : 'en';
                const value = '/en/' + lang;
                document.cookie = 'googtrans=' + value + ';path=/';

                const parts = window.location.hostname.split('.');
                if (parts.length > 1) {
                    document.cookie = 'googtrans=' + value + ';path=/;domain=.' + parts.slice(-2).join('.');
                }

                window.location.reload();
            });
        });
    }());
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<main>
    




