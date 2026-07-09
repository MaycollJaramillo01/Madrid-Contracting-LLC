<?php
@session_start();

/*=========================
   PAGE NAME
   =========================*/
$full_name  = $_SERVER['PHP_SELF'] ?? '';
$name_array = explode('/', $full_name);
$count      = count($name_array);
$page_name  = $name_array[$count - 1] ?? '';

if      ($page_name == 'index.php')        { $namepage = "Home"; }
elseif ($page_name == 'about.php')         { $namepage = "About"; }
elseif ($page_name == 'services.php')      { $namepage = "Services"; }
elseif ($page_name == 'testimonials.php')  { $namepage = "Reviews"; }
elseif ($page_name == 'reviews.php')       { $namepage = "Reviews"; }
elseif ($page_name == 'projects.php')      { $namepage = "Work"; }
elseif ($page_name == 'thank-you.php')     { $namepage = "Thank You"; }
elseif ($page_name == '404.php')           { $namepage = "Not Found"; }
elseif ($page_name == 'contact.php')       { $namepage = "Contact"; }
else                                       { $namepage = ucfirst(str_replace('.php', '', $page_name)); }

/*=========================
   COMPANY INFO
   =========================*/
$Company      = "MADRID CONTRACTING LLC";
$CustomerName = "Madrid Contracting";

function detectBaseURL() {
  $forwardedProto = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '')[0]);
  $scheme = in_array($forwardedProto, ['http', 'https'], true)
    ? $forwardedProto
    : ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http');

  $forwardedHost = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_HOST'] ?? '')[0]);
  $host   = $forwardedHost ?: ($_SERVER['HTTP_HOST'] ?? 'localhost');
  $script = $_SERVER['SCRIPT_NAME'] ?? '';
  $dir    = rtrim(str_replace('\\', '/', dirname($script)), '/.');
  $path   = $dir ? $dir . '/' : '/';
  return $scheme . '://' . $host . $path;
}

$BaseURL   = rtrim(detectBaseURL(), '/') . '/';
$Domain    = $BaseURL;
$MAVEN     = "go-maven.com";
$Address   = "307 Hillsmere Dr, Annapolis, MD 21403";
$StreetAddress = "307 Hillsmere Dr";
$AddressLocality = "Annapolis";
$AddressRegion = "MD";
$PostalCode = "21403";
$AddressCountry = "US";
$BusinessLatitude = "";
$BusinessLongitude = "";
$PhoneName = "Main Line";
$Phone2Name = "Second Line";

$Phone     = "+1 (410) 353-7255";
$Phone2    = "+1 (443) 510-9027";

function telRef($p) {
  $clean = str_replace(str_split('()-/\\:?"<>|., '), '', $p);
  return "tel:" . $clean;
}
$PhoneRef  = telRef($Phone);
$PhoneRef2 = telRef($Phone2 ?? '');

function slugify($text) {
  $text = strtolower(trim($text));
  $text = preg_replace('/[^a-z0-9]+/i', '-', $text);
  return trim($text, '-') ?: 'service';
}

$whatsapp_num = preg_replace('/\D+/', '', $Phone);
if (strpos($whatsapp_num, '1') !== 0) { $whatsapp_num = '1' . $whatsapp_num; }
$whatsapp = "https://api.whatsapp.com/send?phone=$whatsapp_num&text=Hello%20MADRID%20CONTRACTING%20LLC,%20I%20need%20water%20well%20or%20contracting%20service.";

$Mail    = "";
$MailRef = "";

/*=========================
   STOCK IMAGES
   =========================*/
function localAssetUrl($relativePath) {
  $relativePath = trim(str_replace('\\', '/', (string) $relativePath), '/');
  if ($relativePath === '') return '';

  $absolutePath = __DIR__ . '/' . $relativePath;
  if (!is_file($absolutePath)) return '';

  $segments = array_map('rawurlencode', explode('/', $relativePath));
  $url = implode('/', $segments);
  $version = (string) @filemtime($absolutePath);
  return ($version !== '' && $version !== '0') ? $url . '?v=' . $version : $url;
}

$BrandLogo = localAssetUrl('assets/img/logo-horizontal.png');
if ($BrandLogo === '') $BrandLogo = localAssetUrl('assets/img/logo.png');

$AboutVideo = localAssetUrl('assets/videos/1.mp4');

$LocalProjectPhotos = [
  'hero1' => 'assets/img/photos/WhatsApp Image 2026-07-09 at 9.30.25 AM.jpeg',
  'hero2' => 'assets/img/photos/WhatsApp Image 2026-07-09 at 9.30.26 AM.jpeg',
  'hero3' => 'assets/img/photos/WhatsApp Image 2026-07-09 at 9.30.25 AM (1).jpeg',
  'about' => 'assets/img/photos/WhatsApp Image 2026-07-09 at 9.30.26 AM (1).jpeg',
  'water-pump-replacement' => 'assets/img/photos/WhatsApp Image 2026-07-09 at 9.30.25 AM.jpeg',
  'pressure-tank-installation' => 'assets/img/photos/WhatsApp Image 2026-07-09 at 9.30.26 AM.jpeg',
  'waterline-leak-repairs' => 'assets/img/photos/WhatsApp Image 2026-07-09 at 9.30.26 AM (1).jpeg',
  'constant-pressure-system-installation' => 'assets/img/photos/WhatsApp Image 2026-07-09 at 9.30.26 AM (2).jpeg',
  'well-rehab' => 'assets/img/photos/WhatsApp Image 2026-07-09 at 9.30.26 AM (3).jpeg',
  'waterproofing' => 'assets/img/photos/WhatsApp Image 2026-07-09 at 9.30.26 AM (4).jpeg',
  'general-contracting' => 'assets/img/photos/WhatsApp Image 2026-07-09 at 9.30.26 AM (5).jpeg',
  'dumping' => 'assets/img/photos/WhatsApp Image 2026-07-09 at 9.30.26 AM (6).jpeg',
  'gallery1' => 'assets/img/photos/WhatsApp Image 2026-07-09 at 9.30.25 AM.jpeg',
  'gallery2' => 'assets/img/photos/WhatsApp Image 2026-07-09 at 9.30.26 AM.jpeg',
  'gallery3' => 'assets/img/photos/WhatsApp Image 2026-07-09 at 9.30.26 AM (1).jpeg',
  'gallery4' => 'assets/img/photos/WhatsApp Image 2026-07-09 at 9.30.26 AM (2).jpeg'
];

$StockImages = [
  'hero1' => localAssetUrl($LocalProjectPhotos['hero1']),
  'hero2' => localAssetUrl($LocalProjectPhotos['hero2']),
  'hero3' => localAssetUrl($LocalProjectPhotos['hero3']),
  'about' => localAssetUrl($LocalProjectPhotos['about']),
  'water-pump-replacement' => localAssetUrl($LocalProjectPhotos['water-pump-replacement']),
  'pressure-tank-installation' => localAssetUrl($LocalProjectPhotos['pressure-tank-installation']),
  'waterline-leak-repairs' => localAssetUrl($LocalProjectPhotos['waterline-leak-repairs']),
  'constant-pressure-system-installation' => localAssetUrl($LocalProjectPhotos['constant-pressure-system-installation']),
  'well-rehab' => localAssetUrl($LocalProjectPhotos['well-rehab']),
  'waterproofing' => localAssetUrl($LocalProjectPhotos['waterproofing']),
  'general-contracting' => localAssetUrl($LocalProjectPhotos['general-contracting']),
  'dumping' => localAssetUrl($LocalProjectPhotos['dumping']),
  'gallery1' => localAssetUrl($LocalProjectPhotos['gallery1']),
  'gallery2' => localAssetUrl($LocalProjectPhotos['gallery2']),
  'gallery3' => localAssetUrl($LocalProjectPhotos['gallery3']),
  'gallery4' => localAssetUrl($LocalProjectPhotos['gallery4'])
];

function stockImage($key) {
  global $StockImages;
  $key = trim((string) $key);
  return $StockImages[$key] ?? ($StockImages['hero1'] ?? '');
}

/*=========================
   GENERAL MESSAGES
   =========================*/
$Services       = "Water pump replacement, pressure tank installation, waterline leak repairs, constant pressure systems, well rehab, waterproofing, general contracting, and dumping.";
$Estimates      = "Call for Service";
$Payment        = "Call for payment options";
$Experience     = "15+ Years";
$CompanyAge     = "3 Years in Business";
$Schedule       = "Call to schedule service or request urgent support.";
$Coverage       = "Serving Annapolis, Hillsmere, Anne Arundel County, and nearby Maryland communities.";
$LicenseNote    = $CompanyAge;
$BilingualNote  = "English and Spanish Support";
$TypeOfService  = "Water Well Service and Contracting";

/*=========================
   BRAND COLORS
   =========================*/
$BrandColors = [
  'primary'       => '#0D1B2A',
  'primary_rgb'   => '13, 27, 42',
  'secondary'     => '#415A77',
  'secondary_rgb' => '65, 90, 119',
  'accent'        => '#D4AF37',
  'accent_rgb'    => '212, 175, 55',
  'neutral'       => '#F7F3E9',
  'white'         => '#FFFFFF'
];

/*=========================
   SERVICE AREAS
   =========================*/
$Areas = [
  "Annapolis, MD",
  "Hillsmere, Annapolis, MD",
  "Anne Arundel County, MD",
  "Edgewater, MD",
  "Mayo, MD",
  "Riva, MD",
  "Parole, MD",
  "Arnold, MD",
  "Severna Park, MD",
  "Davidsonville, MD",
  "Crofton, MD",
  "Crownsville, MD",
  "And nearby Maryland communities"
];

/*=========================
   MAP AND SOCIAL
   =========================*/
$GoogleMap = '<iframe src="https://maps.google.com/maps?q=307%20Hillsmere%20Dr%2C%20Annapolis%2C%20MD%2021403&t=&z=12&ie=UTF8&iwloc=&output=embed" width="100%" height="450" style="border:0;" allowfullscreen loading="lazy"></iframe>';
$facebook  = "";
$instagram = "";
$google = "";
$tiktok = "";
$messenger = "";

$DirectoryLinks = [
  'bbb' => 'reviews.php',
  'buildzoom' => 'reviews.php',
  'thumbtack' => 'reviews.php',
  'homeadvisor' => 'reviews.php'
];

$GoogleReviews = 'reviews.php';

$DirectoryReviewItems = [
  [
    'name' => 'Residential Well Client',
    'city' => 'Annapolis, MD',
    'stars' => 5,
    'text' => 'Madrid Contracting helped diagnose a pump issue and explained the replacement clearly before starting the work.',
    'source' => 'Customer Feedback',
    'url' => ''
  ],
  [
    'name' => 'Homeowner',
    'city' => 'Edgewater, MD',
    'stars' => 5,
    'text' => 'The team handled a pressure tank installation with clean work and direct communication.',
    'source' => 'Customer Feedback',
    'url' => ''
  ],
  [
    'name' => 'Property Manager',
    'city' => 'Anne Arundel County, MD',
    'stars' => 5,
    'text' => 'They repaired a waterline leak and helped coordinate the surrounding contracting work.',
    'source' => 'Customer Feedback',
    'url' => ''
  ],
  [
    'name' => 'Local Client',
    'city' => 'Severna Park, MD',
    'stars' => 5,
    'text' => 'Reliable support for well rehab and waterproofing questions.',
    'source' => 'Customer Feedback',
    'url' => ''
  ]
];

$GoogleReviewItems = $DirectoryReviewItems;

$ReviewSourceSummaries = [
  [
    'source' => 'Customer Feedback',
    'rating' => '5.0/5',
    'count' => 4,
    'label' => 'Recent water well and contracting feedback',
    'url' => ''
  ],
  [
    'source' => 'Service Follow-Up',
    'rating' => '5.0/5',
    'count' => 4,
    'label' => 'Follow-up notes after completed work',
    'url' => ''
  ]
];

$DetailedReviewItems = [];
foreach ($DirectoryReviewItems as $index => $review) {
  $review['date'] = ['June 2026', 'May 2026', 'April 2026', 'March 2026'][$index] ?? '2026';
  $DetailedReviewItems[] = $review;
}

/*=========================
   SEO AND BRANDING
   =========================*/
$Phrase = [
  "Water Well Services in Annapolis, Maryland",
  "Water Pump Replacement and Pressure Tank Installation",
  "Waterline Leak Repairs",
  "Constant Pressure System Installation",
  "General Contracting and Dumping"
];

$Home = [
  "MADRID CONTRACTING LLC provides water well service, pump replacement, pressure tank installation, leak repair, well rehab, waterproofing, general contracting, and dumping from Annapolis, Maryland.",
  "The company has 3 years in business backed by 15 years of hands-on experience in water well maintenance and service."
];

$About = [
  "MADRID CONTRACTING LLC is based at 307 Hillsmere Dr, Annapolis, MD 21403 and serves homeowners and properties across nearby Maryland communities.",
  "Our work focuses on practical water well solutions, clear communication, and reliable contracting support when a project needs more than a single repair."
];

$Mission = "To keep Maryland homes and properties supplied, protected, and maintained through dependable water well service and contracting support.";
$Vision  = "To be a trusted Annapolis-based contractor for water well systems, waterproofing, and property service work.";

/*=========================
   SERVICES
   =========================*/
$serviceDefinitions = [
  [
    'name' => 'Water Pump Replacement',
    'description' => 'Replacement service for failing or worn water well pumps, with clear diagnosis and careful installation.',
    'category' => 'Water Well Services',
    'image' => stockImage('water-pump-replacement'),
    'bullets' => ['Pump troubleshooting', 'Replacement planning', 'Well system compatibility', 'Clean installation']
  ],
  [
    'name' => 'Pressure Tank Installation',
    'description' => 'Pressure tank installation for well systems that need better storage, cycling control, and dependable pressure.',
    'category' => 'Water Well Services',
    'image' => stockImage('pressure-tank-installation'),
    'bullets' => ['Tank sizing support', 'Pressure switch coordination', 'System checks', 'Clean connections']
  ],
  [
    'name' => 'Waterline Leak Repairs',
    'description' => 'Waterline leak repair for damaged, leaking, or compromised supply lines around homes and properties.',
    'category' => 'Water Well Services',
    'image' => stockImage('waterline-leak-repairs'),
    'bullets' => ['Leak location support', 'Line repair', 'Property protection', 'Service restoration']
  ],
  [
    'name' => 'Constant Pressure System Installation',
    'description' => 'Constant pressure system installation for smoother water pressure and improved well system performance.',
    'category' => 'Water Well Services',
    'image' => stockImage('constant-pressure-system-installation'),
    'bullets' => ['Pressure control upgrades', 'System installation', 'Performance checks', 'Home water support']
  ],
  [
    'name' => 'Well Rehab',
    'description' => 'Well rehab service for systems that need maintenance, performance recovery, or service planning.',
    'category' => 'Water Well Services',
    'image' => stockImage('well-rehab'),
    'bullets' => ['Well system evaluation', 'Maintenance planning', 'Performance recovery', 'Service recommendations']
  ],
  [
    'name' => 'Waterproofing',
    'description' => 'Waterproofing support for areas affected by moisture, seepage, or water intrusion concerns.',
    'category' => 'Water Well Services',
    'image' => stockImage('waterproofing'),
    'bullets' => ['Moisture protection', 'Water intrusion support', 'Preventive planning', 'Contracting execution']
  ],
  [
    'name' => 'General Contracting',
    'description' => 'General contracting support for property work connected to repairs, maintenance, and service projects.',
    'category' => 'Contracting Support',
    'image' => stockImage('general-contracting'),
    'bullets' => ['Project coordination', 'Repair support', 'Property maintenance', 'Clear scope planning']
  ],
  [
    'name' => 'Dumping',
    'description' => 'Dumping support for cleanup, debris removal, and hauling needs related to contracting work.',
    'category' => 'Contracting Support',
    'image' => stockImage('dumping'),
    'bullets' => ['Debris hauling', 'Jobsite cleanup', 'Property cleanout support', 'Simple scheduling']
  ]
];

$SN = $SD = $ExSD = [];
foreach ($serviceDefinitions as $idx => $definition) {
  $serviceId = $idx + 1;
  $SN[$serviceId] = $definition['name'];
  $SD[$serviceId] = $definition['description'];
}

$OtherServices = [
  "General Contracting",
  "Dumping"
];

$ServicesByCategory = [
  [
    'label' => 'Water Well Services',
    'summary_slug' => 'water-pump-replacement',
    'service_slugs' => [
      'water-pump-replacement',
      'pressure-tank-installation',
      'waterline-leak-repairs',
      'constant-pressure-system-installation',
      'well-rehab',
      'waterproofing'
    ]
  ],
  [
    'label' => 'Contracting Support',
    'summary_slug' => 'general-contracting',
    'service_slugs' => [
      'general-contracting',
      'dumping'
    ]
  ]
];

$Badges = [
  $CompanyAge,
  $Experience,
  $Coverage,
  $BilingualNote
];

$ExAbout = substr($About[0], 0, 145) . '...';
$ExHome  = substr($Home[0],  0, 95)  . '...';
for ($i = 1; $i <= count($SN); $i++) {
  if (isset($SD[$i])) $ExSD[$i] = substr($SD[$i], 0, 120) . '...';
}

$ServicesList = [];
foreach ($serviceDefinitions as $idx => $definition) {
  $id = $idx + 1;
  $slug = slugify($definition['name']);
  $ServicesList[$slug] = [
    'id'          => $id,
    'name'        => $definition['name'],
    'description' => $definition['description'],
    'excerpt'     => substr($definition['description'], 0, 120) . '...',
    'slug'        => $slug,
    'file'        => 'services.php',
    'url'         => 'services.php#' . $slug,
    'image'       => $definition['image'],
    'category_label' => $definition['category'],
    'category_slug'  => slugify($definition['category'])
  ];
}

$OtherServicesLandingSlugs = ['general-contracting', 'dumping'];
$PrimaryServiceSlugs = [
  'water-pump-replacement',
  'pressure-tank-installation',
  'waterline-leak-repairs',
  'constant-pressure-system-installation',
  'well-rehab',
  'waterproofing'
];
$AllowedServiceSlugs = array_merge($PrimaryServiceSlugs, $OtherServicesLandingSlugs);
foreach (array_keys($ServicesList) as $serviceSlug) {
  if (!in_array($serviceSlug, $AllowedServiceSlugs, true)) unset($ServicesList[$serviceSlug]);
}

$serviceCategoryMap = [];
foreach ($ServicesByCategory as $category) {
  $categoryLabel = trim((string) ($category['label'] ?? 'General'));
  $categorySlug = trim((string) ($category['summary_slug'] ?? ''));
  if ($categorySlug === '') $categorySlug = slugify($categoryLabel);
  $allSlugs = [];
  if (!empty($category['summary_slug'])) $allSlugs[] = trim((string) $category['summary_slug']);
  foreach (($category['service_slugs'] ?? []) as $serviceSlug) {
    $serviceSlug = trim((string) $serviceSlug);
    if ($serviceSlug !== '') $allSlugs[] = $serviceSlug;
  }
  foreach (array_unique($allSlugs) as $serviceSlug) {
    $serviceCategoryMap[$serviceSlug] = [
      'category_slug' => slugify($categoryLabel),
      'category_label' => $categoryLabel
    ];
  }
}

foreach ($ServicesList as $serviceSlug => &$serviceData) {
  if (isset($serviceCategoryMap[$serviceSlug])) {
    $serviceData['category_slug'] = $serviceCategoryMap[$serviceSlug]['category_slug'];
    $serviceData['category_label'] = $serviceCategoryMap[$serviceSlug]['category_label'];
  }
}
unset($serviceData);

$ServicesDisplayList = array_values($ServicesList);
usort($ServicesDisplayList, static function ($a, $b) {
  return (int) ($a['id'] ?? 0) <=> (int) ($b['id'] ?? 0);
});

$ServiceDetails = [];
$ServiceFeatures = [];
foreach ($serviceDefinitions as $idx => $definition) {
  $slug = slugify($definition['name']);
  $ServiceDetails[$slug] = [
    'kicker' => $definition['category'],
    'headline' => $definition['name'],
    'paragraphs' => [
      $definition['description'],
      'MADRID CONTRACTING LLC brings 15 years of water well service and maintenance experience to each job, with straightforward scheduling from Annapolis, Maryland.'
    ],
    'bullets' => $definition['bullets'],
    'image' => $definition['image']
  ];
  $ServiceFeatures[$idx + 1] = array_map(static function ($bullet) {
    return ['title' => $bullet, 'desc' => 'Handled with practical field experience and clear communication.', 'icon' => 'fa-check'];
  }, $definition['bullets']);
}

/*=========================
  COPY / UI TEXT
  =========================*/
$WhyChoose = [
  'eyebrow' => 'Water Well Service You Can Trust',
  'title_pre' => 'Why Choose',
  'intro' => 'Madrid Contracting combines 3 years in business with 15 years of experience in water well maintenance, service, and related contracting.',
  'cards' => [
    ['title' => 'Experienced Service', 'text' => 'Support for pumps, tanks, pressure systems, leaks, well rehab, and waterproofing.'],
    ['title' => 'Local Annapolis Base', 'text' => 'Based at 307 Hillsmere Dr, Annapolis, MD 21403.'],
    ['title' => 'Need Help?', 'text' => 'Call Madrid Contracting to discuss your property and water system needs.', 'btn' => ['href' => $PhoneRef, 'text' => 'Call Now']]
  ],
];

function paymentList($txt) {
  return array_map('trim', explode(',', $txt));
}
$PaymentMethods = paymentList($Payment);

$ExperienceYears = (int) filter_var($Experience, FILTER_SANITIZE_NUMBER_INT);
if ($ExperienceYears <= 0) $ExperienceYears = 1;

$NavCopy = [
  'home' => 'Home',
  'about' => 'About',
  'services' => 'Services',
  'projects' => 'Work',
  'reviews' => 'Reviews',
  'contact' => 'Contact',
  'other_services' => 'Additional Services',
  'cta' => 'Call Now',
  'cta_mobile' => 'Call Now',
  'explore_service' => 'Explore Service',
  'view_services' => 'View Services',
  'contact_today' => 'Contact Us Today',
  'leave_review' => 'Leave a Review',
  'read_reviews' => 'Read Reviews'
];

$LanguageCopy = [
  'label' => 'Language',
  'english' => 'English',
  'spanish' => 'Espanol'
];

$HeaderCopy = [
  'menu_close' => 'Close Menu',
  'menu_toggle' => 'Toggle Menu',
  'social_titles' => [
    'facebook' => 'Facebook',
    'messenger' => 'Messenger',
    'google' => 'Google Reviews',
    'instagram' => 'Instagram',
    'tiktok' => 'TikTok',
    'whatsapp' => 'WhatsApp'
  ]
];

$FooterCopy = [
  'desc' => 'Water well service, waterproofing, general contracting, and dumping from Annapolis, Maryland.',
  'titles' => ['company' => 'Company', 'services' => 'Services', 'contact' => 'Contact Us'],
  'labels' => ['location' => 'Location', 'phone' => 'Phone', 'hours' => 'Scheduling'],
  'copyright_suffix' => 'All Rights Reserved.'
];

$PageHeroCopy = [
  'default' => ['title' => 'Water Well Services', 'desc' => 'Pump replacement, pressure tanks, waterline leak repairs, constant pressure systems, well rehab, and waterproofing.', 'bg' => stockImage('hero1')],
  'projects' => ['title' => 'Our Work', 'desc' => 'Water well service and contracting support for Maryland properties.', 'bg' => stockImage('hero2')],
  'about' => ['title' => 'About ' . $Company, 'desc' => 'Annapolis-based contracting company with 15 years of water well service experience.', 'bg' => stockImage('hero3')],
  'contact' => ['title' => 'Request Service', 'desc' => 'Call Madrid Contracting for water well, waterproofing, contracting, or dumping support.', 'bg' => stockImage('hero1')],
  'reviews' => ['title' => 'Customer Reviews', 'desc' => 'Feedback from water well and contracting clients across Maryland.', 'bg' => stockImage('hero2')],
  'other' => ['title' => 'Additional Services', 'desc' => 'General contracting and dumping support for property projects.', 'bg' => stockImage('hero3')]
];

$HomeHeroCopy = [
  'headline' => $Company,
  'title' => 'Water Well Service and Contracting',
  'sub' => 'Water pump replacement, pressure tank installation, waterline leak repair, constant pressure systems, well rehab, waterproofing, general contracting, and dumping.',
  'cta_primary' => 'Call Main Line',
  'cta_secondary' => 'Call Second Line',
  'cta_primary_href' => $PhoneRef,
  'cta_secondary_href' => $PhoneRef2,
  'prev_label' => 'Previous slide',
  'next_label' => 'Next slide',
  'slide_alt_prefix' => 'Madrid Contracting Service',
  'thumb_alt_prefix' => 'Service Thumbnail',
  'slide_statuses' => [$CompanyAge, $Experience . ' Experience', 'Annapolis, Maryland'],
  'slide_descriptions' => [
    $Home[0],
    $Home[1],
    'Call ' . $Phone . ' or ' . $Phone2 . ' to discuss your water well or contracting service.'
  ],
  'slides' => [
    ['src' => stockImage('hero1'), 'alt' => 'Contractor inspecting water system equipment'],
    ['src' => stockImage('hero2'), 'alt' => 'Construction and repair worksite'],
    ['src' => stockImage('hero3'), 'alt' => 'Water and utility service work']
  ]
];

$HomeAboutCopy = [
  'eyebrow' => 'Annapolis Water Well Service',
  'title' => 'Water systems,',
  'title_strong' => 'handled with experience.',
  'description' => 'MADRID CONTRACTING LLC has 3 years in business and 15 years of field experience in water well maintenance, service, and contracting support.',
  'badge_label' => 'Years Experience',
  'images' => [
    'back' => ['src' => stockImage('about'), 'alt' => 'Water well service technician at work'],
    'front' => ['src' => stockImage('hero2'), 'alt' => 'Contracting worksite']
  ],
  'features' => [
    ['icon' => 'fa-water', 'title' => 'Water Well Service', 'text' => 'Pump, tank, pressure, leak, and rehab support.'],
    ['icon' => 'fa-gauge-high', 'title' => 'Pressure Systems', 'text' => 'Installation for constant pressure systems and tanks.'],
    ['icon' => 'fa-house-flood-water', 'title' => 'Waterproofing', 'text' => 'Support for moisture and water intrusion concerns.'],
    ['icon' => 'fa-helmet-safety', 'title' => 'Contracting Support', 'text' => 'General contracting and dumping available.']
  ],
  'cta' => 'Learn About Us'
];

$AboutHeroCopy = [
  'eyebrow' => 'About ' . $Company,
  'title' => 'An Annapolis contractor focused on water well service',
  'desc' => $About[0],
  'cta_primary' => 'Our Story',
  'cta_primary_href' => '#story',
  'cta_secondary_prefix' => 'Call',
  'meta' => [$CompanyAge, $Experience, $Coverage, $BilingualNote],
  'list' => [
    ['label' => 'Service area', 'value' => $Coverage],
    ['label' => 'Scheduling', 'value' => $Schedule],
    ['label' => 'Core services', 'value' => $TypeOfService],
    ['label' => 'Base', 'value' => $Address]
  ]
];

$AboutStoryCopy = [
  'eyebrow' => 'Our Story',
  'title' => 'Built around water well service and practical property work',
  'points' => [
    ['title' => '3 years in business', 'text' => $CompanyAge],
    ['title' => '15 years experience', 'text' => 'Hands-on maintenance and service experience for water wells.'],
    ['title' => 'Local service', 'text' => 'Based in Annapolis, Maryland.']
  ],
  'actions' => ['primary_text' => 'Request service', 'primary_href' => $PhoneRef, 'secondary_prefix' => 'Call'],
  'stats' => ['years_label' => 'Years of Experience', 'services_label' => 'Service lines', 'areas_label' => 'Areas served', 'areas_separator' => ', ', 'areas_preview_count' => 5]
];

$AboutCredentialsCopy = [
  'eyebrow' => 'Why work with us',
  'title' => 'Experienced help for wells, water pressure, and property needs',
  'intro' => 'Every service call is handled with direct communication, practical planning, and field experience.',
  'list' => [
    ['label' => 'Contact', 'value' => $Phone . ' | ' . $Phone2],
    ['label' => 'Experience', 'value' => $Experience],
    ['label' => 'Core services', 'value' => $TypeOfService],
    ['label' => 'Coverage', 'value' => $Coverage],
    ['text' => $CompanyAge . ' | ' . $BilingualNote]
  ],
  'cta' => ['title' => 'Need water well service?', 'desc' => 'Call for pump, tank, leak, pressure, well rehab, waterproofing, contracting, or dumping support.', 'primary_text' => 'Call Now', 'primary_href' => $PhoneRef, 'secondary_prefix' => 'Call']
];

$AboutServicesSummaryCopy = ['eyebrow' => 'Services', 'title' => 'How we help', 'desc' => $TypeOfService . ' across Annapolis and nearby Maryland communities.', 'link_label' => 'Learn more'];
$ServicesListCopy = ['eyebrow' => 'Scope', 'title' => 'Services we provide', 'desc' => $Services, 'link_label' => 'Learn more'];
$BrandsCopy = ['tagline' => 'Serving Annapolis and nearby Maryland communities'];

$HomeServicesCopy = [
  'eyebrow' => 'Our Services',
  'title' => 'Water Well Work',
  'title_strong' => 'And Contracting Support',
  'desc' => $Services,
  'link_label' => 'Contact',
  'more_title' => 'Need a water system checked?',
  'more_desc' => 'Call Madrid Contracting and tell us what is happening with your pump, tank, waterline, pressure, well, or property.',
  'more_button' => 'Call for Service',
  'more_href' => $PhoneRef
];

$HomeMaintenanceCopy = [
  'tagline' => 'Reliable Field Service',
  'title' => 'Pump, Tank,',
  'title_strong' => 'Pressure, Repair',
  'desc' => 'From well equipment to waterproofing and cleanup support, Madrid Contracting keeps property service practical and direct.',
  'cards' => [
    ['icon' => 'fa-water', 'title' => 'Pump and Tank Work', 'text' => 'Water pump replacement and pressure tank installation.', 'action' => 'See Details'],
    ['icon' => 'fa-screwdriver-wrench', 'title' => 'Leak Repairs', 'text' => 'Waterline leak repairs and service restoration support.', 'action' => 'See Details'],
    ['icon' => 'fa-gauge-high', 'title' => 'Constant Pressure', 'text' => 'Constant pressure system installation for better performance.', 'action' => 'See Details'],
    ['icon' => 'fa-truck-ramp-box', 'title' => 'Contracting and Dumping', 'text' => 'General contracting and dumping available when the job needs more support.', 'action' => 'See Details']
  ],
  'foundation' => [
    ['icon' => 'fa-briefcase', 'title' => $CompanyAge, 'subtitle' => 'Local company'],
    ['icon' => 'fa-star', 'title' => $Experience, 'subtitle' => 'Water well experience'],
    ['icon' => 'fa-location-dot', 'title' => 'Annapolis', 'subtitle' => 'Maryland service base']
  ]
];

$WhyCopy = [
  'badge' => 'Trusted Water Well Service',
  'title_prefix' => 'Why Clients Choose',
  'description' => 'The work is focused on accurate service, practical repair planning, and clear communication before and during the job.',
  'stats' => [
    ['value' => '3', 'label' => 'Years in Business'],
    ['value' => $ExperienceYears . '+', 'label' => 'Years Experience'],
    ['value' => count($ServicesList) . '+', 'label' => 'Service Lines']
  ],
  'service_area_label' => 'Coverage and Service Base',
  'features' => [
    ['icon' => 'fa-comments', 'title' => 'Clear Communication', 'text' => 'Call either service line to describe your water system or property issue.'],
    ['icon' => 'fa-toolbox', 'title' => 'Practical Repairs', 'text' => 'Support for pumps, tanks, leaks, pressure systems, well rehab, and waterproofing.'],
    ['icon' => 'fa-house-chimney', 'title' => 'Property Support', 'text' => 'General contracting and dumping are also available.'],
    ['icon' => 'fa-location-dot', 'title' => 'Annapolis Based', 'text' => $Address]
  ],
  'cta_label' => 'Call Now'
];

$MissionCopy = ['mission_title' => 'Our Mission', 'vision_title' => 'Our Vision'];

$ProcessCopy = [
  'title' => 'How We Work',
  'title_strong' => 'From Call To Service',
  'desc' => 'The process keeps water well and contracting service clear from first call to completed work.',
  'steps' => [
    ['icon' => 'fa-phone', 'title' => 'Call Us', 'text' => 'Tell us your location and what is happening with the system or property.'],
    ['icon' => 'fa-clipboard-check', 'title' => 'Confirm Scope', 'text' => 'We discuss the service needed and the practical next step.'],
    ['icon' => 'fa-screwdriver-wrench', 'title' => 'Complete Service', 'text' => 'We handle the repair, installation, rehab, waterproofing, contracting, or dumping support.'],
    ['icon' => 'fa-check-circle', 'title' => 'Review Work', 'text' => 'We communicate what was completed and any follow-up needed.']
  ]
];

$FaqCopy = [
  'title' => 'Frequently Asked Questions',
  'items' => [
    ['q' => 'What services do you offer?', 'a' => $Services],
    ['q' => 'Where are you located?', 'a' => $Address],
    ['q' => 'How much experience do you have?', 'a' => 'MADRID CONTRACTING LLC has 3 years in business and 15 years of experience in water well maintenance and service.'],
    ['q' => 'Do you offer general contracting and dumping?', 'a' => 'Yes. General contracting and dumping are also available.']
  ]
];

$AreasCopy = [
  'title' => 'Serving',
  'title_strong' => 'Annapolis, Maryland',
  'subtitle' => $Coverage,
  'cta_label' => 'Request Service in Your Area',
  'map_overlay' => 'Annapolis Service Base',
  'license_pills' => [$CompanyAge, $Experience, 'Water Well Service', 'Contracting Support']
];

$CtaCopy = [
  'badge' => $Experience . ' Experience',
  'title' => 'Need Water Well',
  'title_strong' => 'Service?',
  'paragraph' => $Company . ' provides pump replacement, pressure tank installation, leak repairs, constant pressure systems, well rehab, waterproofing, general contracting, and dumping.',
  'features' => [$CompanyAge, $Experience, 'Annapolis Based'],
  'button' => 'Call for Service',
  'card_title' => 'Speak With Madrid Contracting',
  'card_subtitle' => 'Water well and contracting support',
  'row_call_label' => 'Call for service',
  'row_license_label' => 'Experience',
  'row_license_title' => $Experience,
  'row_service_label' => 'Service Area',
  'whatsapp_button' => 'WhatsApp Us',
  'book_button' => 'Start Request'
];

$ContactFormCopy = [
  'eyebrow' => 'Request Service',
  'title' => "Tell Us What",
  'title_strong' => 'You Need.',
  'desc' => 'Send your location and service details. For urgent service, call directly.',
  'method_labels' => ['call' => 'Call or Text', 'hours' => 'Scheduling'],
  'form_labels' => ['name' => 'Name', 'phone' => 'Phone', 'email' => 'Email', 'service' => 'Service', 'message' => 'Service Details'],
  'placeholders' => ['service' => 'Select service type', 'service_other' => 'Other / Custom Request', 'message' => 'Describe the pump, tank, waterline, well, waterproofing, contracting, or dumping need...'],
  'submit' => 'Send Service Request',
  'honeypot_label' => 'Leave this field empty'
];

$MapCopy = ['title' => 'Locate', 'title_strong' => 'Madrid Contracting', 'labels' => ['location' => 'Service Base', 'call' => 'Phone', 'hours' => 'Scheduling']];

$TestimonialsCopy = ['title' => 'Client Feedback', 'title_strong' => 'From Service Calls', 'desc' => 'Read customer feedback from water well and contracting service calls across Maryland.', 'button_label' => 'Read More Reviews', 'button_href' => 'reviews.php', 'fallback_name' => 'Client'];

$TrustedDirectoriesCopy = [
  'eyebrow' => 'Customer Feedback',
  'title' => 'Service Highlights',
  'desc' => 'Feedback from clients who needed water well and contracting support.',
  'cards' => [
    ['icon' => 'fa-award', 'subtitle' => 'Water Wells', 'title' => 'Pump and Tank Work', 'text' => 'Feedback from water system service calls.', 'url' => 'reviews.php', 'tags' => ['Pump Work', 'Tank Installation']],
    ['icon' => 'fa-water', 'subtitle' => 'Repairs', 'title' => 'Waterline Repairs', 'text' => 'Comments from leak repair and service restoration jobs.', 'url' => 'reviews.php', 'tags' => ['Leak Repair', 'Service']],
    ['icon' => 'fa-house-flood-water', 'subtitle' => 'Protection', 'title' => 'Waterproofing', 'text' => 'Support for water intrusion and moisture concerns.', 'url' => 'reviews.php', 'tags' => ['Waterproofing', 'Property']],
    ['icon' => 'fa-helmet-safety', 'subtitle' => 'Support', 'title' => 'Contracting', 'text' => 'General contracting and dumping support for property projects.', 'url' => 'reviews.php', 'tags' => ['Contracting', 'Dumping']]
  ]
];

$ReviewsPageCopy = [
  'hero_title' => 'Customer Reviews',
  'hero_subtitle' => 'See what Maryland clients say about working with us.',
  'hero_image' => stockImage('hero2'),
  'list_eyebrow' => 'Reviews',
  'list_title' => 'What Our Customers Say',
  'list_desc' => 'Recent feedback from water well and contracting customers.',
  'list_cta' => 'Leave a Review'
];

$ReviewFormCopy = [
  'title' => 'Share Your Experience',
  'subtitle' => 'We value your feedback and would like to hear about your service.',
  'success_title' => 'Thank You',
  'success_message' => 'Your review has been submitted successfully.',
  'error_title' => 'Error',
  'captcha_error' => 'Incorrect security code. Please try again.',
  'labels' => ['name' => 'Your Name', 'city' => 'City / Location', 'rating' => 'Rating', 'rating_hint' => '(Select stars)', 'review' => 'Your Review', 'security' => 'Security Check', 'refresh' => 'Refresh', 'captcha' => 'Enter the code shown above'],
  'captcha_alt' => 'Captcha image',
  'placeholders' => ['name' => '', 'city' => 'e.g. Annapolis, MD', 'review' => 'Tell us how we did...'],
  'submit' => 'Submit Review'
];

$GalleryHeroCopy = ['eyebrow' => 'Our Work', 'title' => 'Madrid Contracting in the Field', 'desc' => 'Water well service and property support from ' . $Company . '.', 'cta_text' => 'Call Now', 'cta_href' => $PhoneRef];

$ProjectsIntroCopy = [
  'label' => 'Our Work',
  'title_line1' => 'Water Well',
  'title_line2' => 'Service.',
  'outline_line1' => 'Contracting',
  'outline_line2' => 'Support.',
  'desc' => 'At ' . $Company . ', service is handled with water well experience, practical planning, and clear communication.',
  'stats' => [
    ['value' => $ExperienceYears . '+', 'label' => 'Years Experience'],
    ['value' => count($ServicesList) . '+', 'label' => 'Service Lines'],
    ['value' => count($Areas), 'label' => 'Areas Served']
  ]
];

$ProjectsBeforeAfterCopy = ['eyebrow' => 'Service', 'title' => 'Before & After', 'desc' => 'Examples of property service, repair planning, and contracting support.', 'before_label' => 'Before', 'after_label' => 'After'];
$ProjectsStatsCopy = ['items' => [
  ['icon' => 'fa-briefcase', 'value' => '3', 'label' => 'Years in Business'],
  ['icon' => 'fa-star', 'value' => $ExperienceYears . '+', 'label' => 'Years Experience'],
  ['icon' => 'fa-screwdriver-wrench', 'value' => count($ServicesList) . '+', 'label' => 'Service Lines'],
  ['icon' => 'fa-map-location-dot', 'value' => count($Areas), 'label' => 'Areas Served']
]];

$ProjectsGalleryCopy = ['eyebrow' => 'Service Gallery', 'title' => 'Selected Work &', 'title_strong' => 'Service Support', 'videos_label' => 'Videos', 'empty' => 'Work images coming soon.', 'image_title' => 'Service Photo', 'video_title' => 'Service Video'];
$ServiceHeroCopy = ['badge' => 'Water Well Service', 'cta_primary' => 'Call Now', 'cta_secondary' => 'Explore Service'];
$ServiceIntroCopy = [
  'eyebrow' => 'Our Method',
  'title' => 'How We Deliver',
  'title_strong' => 'Water Well Service',
  'desc' => 'We keep the process direct so you know what to expect from call to completion.',
  'steps' => [
    ['icon' => 'fa-comments', 'title' => 'Call', 'text' => 'We start by confirming your location and service need.'],
    ['icon' => 'fa-clipboard-check', 'title' => 'Plan', 'text' => 'We review the issue and discuss the right next step.'],
    ['icon' => 'fa-screwdriver-wrench', 'title' => 'Service', 'text' => 'We complete the repair, installation, waterproofing, contracting, or dumping support.']
  ]
];

$ServiceDetailsCopy = ['badge_title' => 'Madrid Contracting Standard', 'badge_subtitle' => 'Service Focused', 'title_prefix' => 'Professional', 'button' => 'Call Now'];
$ServiceFaqCopy = [
  'eyebrow' => 'Common Questions',
  'title' => 'Info About Our',
  'title_strong' => 'Service Process',
  'items' => [
    ['icon' => 'fa-water', 'question' => 'Do you replace water pumps?', 'answer' => 'Yes. Water pump replacement is one of the core services.'],
    ['icon' => 'fa-gauge-high', 'question' => 'Do you install pressure tanks and constant pressure systems?', 'answer' => 'Yes. We install pressure tanks and constant pressure systems.'],
    ['icon' => 'fa-screwdriver-wrench', 'question' => 'Do you repair waterline leaks?', 'answer' => 'Yes. We provide waterline leak repairs.'],
    ['icon' => 'fa-map', 'question' => 'What areas do you serve?', 'answer' => $Coverage]
  ],
  'footer' => 'Have a different question? Contact our team directly'
];

$ServiceCtaCopy = [
  'tag' => 'Need Help?',
  'title' => "Let's Get Your",
  'title_strong' => 'Service Scheduled',
  'paragraph' => 'Call for %s from Annapolis, Maryland and nearby communities.',
  'subject_fallback' => 'service',
  'features' => [$CompanyAge, $Experience, 'Water Well Service'],
  'primary' => 'Call Now',
  'secondary_prefix' => 'Call'
];

$OtherServicesCopy = ['label' => 'Additional Help', 'title' => 'More Ways We Can Help', 'title_strong' => 'With Property Work', 'item_note' => 'Professional water well and contracting support.', 'cta_title' => 'Have a specific request?', 'cta_text' => 'From well service to contracting and dumping, call and tell us what you need.', 'cta_button' => $Estimates, 'page_desc' => 'Additional contracting support tailored to your property situation.'];
$FounderCopy = ['title' => 'A Note from', 'title_strong' => 'The Owner', 'quote' => 'At ' . $Company . ', our work is about practical service, clear communication, and reliable help for water wells and property needs.', 'role' => 'Owner', 'image_alt' => $CustomerName];

$AriaCopy = [
  'call' => 'Click to call',
  'primary_nav' => 'Primary navigation',
  'whatsapp' => 'WhatsApp',
  'messenger' => 'Messenger',
  'facebook' => 'Facebook',
  'instagram' => 'Instagram',
  'google' => 'Google Maps',
  'tiktok' => 'TikTok',
  'email' => 'Email'
];

$TestimonialsPageCopy = ['eyebrow' => $NavCopy['reviews'] ?? 'Reviews', 'title' => 'What Customers Say', 'desc' => 'Trusted feedback from water well and contracting clients across Maryland.', 'card_title' => 'Read Customer Reviews', 'card_desc' => 'See feedback from service customers.', 'card_button' => $NavCopy['read_reviews'] ?? 'Read Reviews', 'card_link' => 'reviews.php'];
$ThankYouCopy = ['title' => 'Thank You', 'description' => 'Thank you for contacting ' . $Company . '. We will be in touch shortly.', 'eyebrow' => 'Thank You', 'headline' => 'We received your request', 'body' => 'Thank you for contacting ' . $Company . '. Our team will reach out soon to confirm your service details.', 'cta_call' => 'Click to Call', 'cta_home' => 'Back to Home'];
$LabelsCopy = ['service_areas' => 'Service Areas', 'call' => 'Call', 'email' => 'Email'];

/*=========================
   CSS VARIABLES
   =========================*/
$BrandCSSVars = sprintf(
  ':root{--brand-primary:%s;--brand-secondary:%s;--brand-white:%s;--brand-accent:%s;--brand-neutral:%s;--brand-primary-rgb:%s;--brand-secondary-rgb:%s;--brand-accent-rgb:%s;}',
  $BrandColors["primary"],
  $BrandColors["secondary"],
  $BrandColors["white"],
  $BrandColors["accent"],
  $BrandColors["neutral"],
  $BrandColors["primary_rgb"],
  $BrandColors["secondary_rgb"],
  $BrandColors["accent_rgb"]
);

$BrandCSSVars .= <<<CSS
:root{
  --site-surface:#ffffff;
  --site-surface-soft:color-mix(in srgb, var(--brand-neutral) 86%, #fff 14%);
  --site-ink:var(--brand-primary);
  --site-ink-soft:rgba(var(--brand-primary-rgb),0.76);
  --site-panel:#ffffff;
  --site-panel-soft:rgba(255,255,255,0.80);
  --site-line:rgba(var(--brand-primary-rgb),0.14);
  --site-dark:#0D1B2A;
  --site-dark-2:#15263A;
  --site-dark-3:#233A56;
  --site-dark-line:rgba(var(--brand-accent-rgb),0.28);
  --site-dark-text:#ffffff;
  --site-dark-muted:rgba(255,255,255,0.74);
  --site-accent-soft:rgba(var(--brand-accent-rgb),0.16);
}
body{
  background:
    radial-gradient(circle at 10% 8%, rgba(var(--brand-accent-rgb),0.15), transparent 28%),
    linear-gradient(180deg, var(--brand-neutral) 0%, #ffffff 100%);
}
#hero-4.hero4{
  background: linear-gradient(130deg, var(--brand-primary) 0%, var(--brand-secondary) 58%, #1b2c42 100%) !important;
}
#hero-4 .hero4__slides::after{
  background: linear-gradient(to bottom, rgba(var(--brand-primary-rgb),0.78) 0%, rgba(var(--brand-primary-rgb),0.5) 42%, rgba(var(--brand-primary-rgb),0.88) 100%) !important;
}
#hero-4 .hero4__content{
  background: linear-gradient(145deg, rgba(var(--brand-primary-rgb),0.94), rgba(var(--brand-secondary-rgb),0.78)) !important;
  border: 1px solid rgba(var(--brand-accent-rgb),0.55) !important;
}
#hero-4 .hero4__content::before{
  background: radial-gradient(120% 140% at 0% 0%, rgba(var(--brand-accent-rgb),0.24), transparent 62%) !important;
}
#hero-4 .hero4__btn--primary,
.section-about-arch .btn-arch,
.section-remodel-why .btn-gold,
.cta-premium-section .btn-cta-primary,
.section-contact-premium .btn-submit-arch{
  background: var(--brand-accent) !important;
  color: var(--brand-primary) !important;
  border-color: var(--brand-accent) !important;
}
#hero-4 .hero4__btn--ghost,
#hero-4 .hero4__thumb.active,
#hero-4 .hero4__arrow:hover{
  border-color: var(--brand-accent) !important;
}
.section-about-arch,
.section-services-premium,
.section-maint-pro,
.mission-vision-section,
.faq-section{
  background: linear-gradient(180deg, #ffffff 0%, var(--brand-neutral) 100%) !important;
}
.section-remodel-why,
.section-process,
.section-areas,
.cta-premium-section,
.section-contact-premium,
.section-map-contact{
  background: linear-gradient(135deg, var(--brand-primary) 0%, #12263c 100%) !important;
}
.section-about-arch .arch-eyebrow,
.section-services-premium .sv-eyebrow,
.section-maint-pro .tagline,
.section-remodel-why .sub-badge,
.section-process .step-icon,
.section-areas .license-pill,
.section-areas .city-icon,
.cta-premium-section .cta-badge,
.section-contact-premium .ct-eyebrow,
.section-map-contact .info-icon,
.section-remodel-why .why-header h2 strong,
.section-process .process-header h2 span,
.section-areas .areas-content h2 strong,
.cta-premium-section .cta-content h2 strong,
.section-map-contact .contact-card h3 span{
  color: var(--brand-accent) !important;
  border-color: rgba(var(--brand-accent-rgb),0.6) !important;
}
.section-about-arch .arch-eyebrow::before,
.section-services-premium .sv-eyebrow::before,
.section-services-premium .sv-eyebrow::after,
.section-contact-premium .ct-eyebrow::before{
  background: var(--brand-accent) !important;
}
.section-about-arch .content-arch h2 strong,
.section-services-premium .sv-header h2 strong,
.section-maint-pro .pro-header h2 strong{
  color: var(--brand-primary) !important;
}
.section-services-premium .sv-card,
.section-maint-pro .maint-card-dark,
.section-remodel-why .feature-card,
.section-process .process-step,
.section-areas .map-frame-wrapper,
.section-contact-premium .ct-form-wrapper,
.cta-premium-section .contact-glass-card,
.section-map-contact .contact-card{
  border-radius: 12px !important;
}
.section-services-premium .sv-card:hover,
.section-maint-pro .maint-card-dark:hover,
.section-remodel-why .feature-card:hover,
.section-process .process-step:hover{
  box-shadow: 0 22px 48px rgba(var(--brand-primary-rgb),0.28) !important;
}
.section-about-arch .btn-arch,
.section-remodel-why .btn-gold,
.section-areas .btn-area,
.cta-premium-section .btn-cta-primary,
.section-contact-premium .btn-submit-arch,
.section-services-premium .btn-sv-accent{
  border-radius: 999px !important;
}
.section-about-arch .btn-arch:hover,
.section-remodel-why .btn-gold:hover,
.cta-premium-section .btn-cta-primary:hover,
.section-contact-premium .btn-submit-arch:hover{
  background: color-mix(in srgb, var(--brand-accent) 84%, #fff 16%) !important;
  color: var(--brand-primary) !important;
}
.section-areas .btn-area{
  border-color: var(--brand-accent) !important;
  color: var(--brand-accent) !important;
}
.section-areas .btn-area:hover{
  background: var(--brand-accent) !important;
  color: var(--brand-primary) !important;
}
.section-contact-premium .form-control-arch:focus{
  border-bottom-color: var(--brand-accent) !important;
}
.section-map-contact .map-background iframe{
  filter: grayscale(45%) contrast(0.92) !important;
}
.language-switcher{
  display:inline-flex;
  align-items:center;
  gap:6px;
  padding:5px;
  border-radius:999px;
  background:var(--brand-primary);
  border:1px solid rgba(var(--brand-accent-rgb),0.45);
}
.language-switcher button{
  border:0;
  border-radius:999px;
  padding:8px 10px;
  background:transparent;
  color:#fff;
  font-size:12px;
  font-weight:800;
  letter-spacing:.04em;
  cursor:pointer;
}
.language-switcher button.active,
.language-switcher button:hover{
  background:var(--brand-accent);
  color:var(--brand-primary);
}
.goog-te-banner-frame,
.skiptranslate iframe{
  display:none !important;
}
body{
  top:0 !important;
}
#google_translate_element{
  width:0;
  height:0;
  overflow:hidden;
  position:absolute;
  pointer-events:none;
}
CSS;
?>
