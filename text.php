<?php
@session_start();

/*=========================
   PAGE NAME (Routing simple)
   =========================*/
$full_name  = $_SERVER['PHP_SELF'] ?? '';
$name_array = explode('/', $full_name);
$count      = count($name_array);
$page_name  = $name_array[$count - 1] ?? '';

if      ($page_name == 'index.php')        { $namepage = "Home"; }
elseif ($page_name == 'about.php')        { $namepage = "About"; }
elseif ($page_name == 'services.php')     { $namepage = "Services"; }
elseif ($page_name == 'testimonials.php') { $namepage = "Reviews"; }
elseif ($page_name == 'reviews.php')      { $namepage = "Reviews"; }
elseif ($page_name == 'projects.php')     { $namepage = "Projects"; }
elseif ($page_name == 'thank-you.php')    { $namepage = "Thank You"; }
elseif ($page_name == '404.php')          { $namepage = "Not Found"; }
elseif ($page_name == 'contact.php')      { $namepage = "Contact"; }
else                                      { $namepage = ucfirst(str_replace('.php', '', $page_name)); }

/*=========================
   INFO GENERAL - FAMILIA TOWING
   =========================*/
$Company      = "Familia Towing";
$CustomerName = "Familia";

function detectBaseURL() {
  $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
  $host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
  $script = $_SERVER['SCRIPT_NAME'] ?? '';
  $dir    = rtrim(str_replace('\\', '/', dirname($script)), '/.');
  $path   = $dir ? $dir . '/' : '/';
  return $scheme . '://' . $host . $path;
}

$BaseURL   = rtrim(detectBaseURL(), '/') . '/';
$Domain    = $BaseURL;
$MAVEN     = "go-maven.com";
$Address   = "W.P.B., FL 33416";
$PhoneName = "Spanish";
$Phone2Name = "English";

$Phone     = "+1 (561) 396-0659";
$Phone2    = "+1 (561) 215-4377";

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
$whatsapp = "https://api.whatsapp.com/send?phone=$whatsapp_num&text=Hello%20Familia%20Towing!%20I%20need%20towing%20or%20roadside%20assistance.";

$Mail    = "info@familiatowing.com";
$MailRef = "mailto:" . $Mail;

/*=========================
   GENERAL MESSAGES
   =========================*/
$Services       = "Local and long distance towing, junk car buying, jump starts, and lockout service";
$Estimates      = "Fast Assistance";
$Payment        = "Cash, Zelle, Card";
$Experience     = "2+ Years";
$Schedule       = "Office hours: 6:00 AM to 6:00 PM. Emergency towing available 24/7.";
$Coverage       = "We cover West Palm Beach, Jupiter, Boca Raton, and all Palm Beach County.";
$LicenseNote    = "Reliable 24 Hour Service";
$BilingualNote  = "English and Spanish Spoken";
$TypeOfService  = "Towing and Roadside Assistance";

/*=========================
   BRAND COLORS
   =========================*/
$BrandColors = [
  'primary'       => '#0B0B0D',
  'primary_rgb'   => '11, 11, 13',
  'secondary'     => '#181818',
  'secondary_rgb' => '24, 24, 24',
  'accent'        => '#FF7A00',
  'accent_rgb'    => '255, 122, 0',
  'neutral'       => '#F7F4EF',
  'white'         => '#FFFFFF'
];

/*=========================
   SERVICE AREAS
   =========================*/
$Areas = [
  "West Palm Beach, FL",
  "W.P.B., FL 33416",
  "Jupiter, FL",
  "Boca Raton, FL",
  "Palm Beach County, FL",
  "Lake Worth Beach, FL",
  "Boynton Beach, FL",
  "Delray Beach, FL",
  "Palm Beach Gardens, FL",
  "Royal Palm Beach, FL",
  "Wellington, FL",
  "Riviera Beach, FL",
  "Greenacres, FL",
  "Lantana, FL",
  "And nearby communities"
];

/*=========================
   MAPA Y REDES SOCIALES
   =========================*/
$GoogleMap = '<iframe src="https://maps.google.com/maps?q=West%20Palm%20Beach%2C%20FL%2033416&t=&z=11&ie=UTF8&iwloc=&output=embed" width="100%" height="450" style="border:0;" allowfullscreen loading="lazy"></iframe>';
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
    'name' => 'Verified Driver',
    'city' => 'West Palm Beach, FL',
    'stars' => 5,
    'text' => 'Familia Towing answered quickly and helped with a local tow when my car stopped running.',
    'source' => 'Website Review',
    'url' => ''
  ],
  [
    'name' => 'Roadside Customer',
    'city' => 'Jupiter, FL',
    'stars' => 5,
    'text' => 'They helped with a jump start and explained everything clearly in English and Spanish.',
    'source' => 'Website Review',
    'url' => ''
  ],
  [
    'name' => 'Palm Beach Client',
    'city' => 'Boca Raton, FL',
    'stars' => 5,
    'text' => 'Reliable service for long distance towing. The driver arrived prepared and handled the vehicle carefully.',
    'source' => 'Website Review',
    'url' => ''
  ],
  [
    'name' => 'Local Customer',
    'city' => 'Lake Worth Beach, FL',
    'stars' => 5,
    'text' => 'Fast lockout help and fair communication from start to finish.',
    'source' => 'Website Review',
    'url' => ''
  ]
];

$GoogleReviewItems = $DirectoryReviewItems;

$ReviewSourceSummaries = [
  [
    'source' => 'Website Reviews',
    'rating' => '5.0/5',
    'count' => 4,
    'label' => 'Based on recent customer feedback',
    'url' => ''
  ],
  [
    'source' => 'Roadside Follow-Up',
    'rating' => '5.0/5',
    'count' => 4,
    'label' => 'Customer service follow-up responses',
    'url' => ''
  ]
];

$DetailedReviewItems = [
  [
    'name' => 'Verified Driver',
    'city' => 'West Palm Beach, FL',
    'stars' => 5,
    'text' => 'Familia Towing answered quickly and helped with a local tow when my car stopped running.',
    'source' => 'Website Review',
    'date' => 'April 2026',
    'url' => ''
  ],
  [
    'name' => 'Roadside Customer',
    'city' => 'Jupiter, FL',
    'stars' => 5,
    'text' => 'They helped with a jump start and explained everything clearly in English and Spanish.',
    'source' => 'Website Review',
    'date' => 'March 2026',
    'url' => ''
  ],
  [
    'name' => 'Palm Beach Client',
    'city' => 'Boca Raton, FL',
    'stars' => 5,
    'text' => 'Reliable service for long distance towing. The driver arrived prepared and handled the vehicle carefully.',
    'source' => 'Website Review',
    'date' => 'February 2026',
    'url' => ''
  ],
  [
    'name' => 'Local Customer',
    'city' => 'Lake Worth Beach, FL',
    'stars' => 5,
    'text' => 'Fast lockout help and fair communication from start to finish.',
    'source' => 'Website Review',
    'date' => 'January 2026',
    'url' => ''
  ]
];

/*=========================
   SEO & BRANDING SLOGANS
   =========================*/
$Phrase = [
  "24 Hour Towing Service in Palm Beach County",
  "Local and Long Distance Towing",
  "We Buy Junk Cars",
  "Jump Start Vehicles and Locked Car Services",
  "English and Spanish Spoken"
];

/*=========================
   HOME / ABOUT
   =========================*/
$Home = [
  "Familia Towing provides local and long distance towing, junk car buying, jump starts, and locked car services across West Palm Beach, Jupiter, Boca Raton, and Palm Beach County.",
  "With more than 2 years of experience, our bilingual team responds with dependable 24 hour roadside support and clear communication."
];

$About = [
  "Familia Towing is a local towing and roadside assistance company serving drivers throughout Palm Beach County.",
  "We cover West Palm Beach, Jupiter, Boca Raton, and nearby areas with English and Spanish support, fast dispatch, and practical help when your vehicle cannot move."
];

$Mission = "To provide dependable towing and roadside assistance with fast response, safe handling, and clear bilingual communication.";
$Vision  = "To be a trusted towing company across Palm Beach County for local drivers who need reliable help day or night.";

/*=========================
   SERVICES SECTION
   =========================*/
$SN = $SD = $ExSD = [];

$SN[1] = "Local Towing";
$SD[1] = "Local towing for cars and light vehicles throughout West Palm Beach and nearby Palm Beach County areas.";

$SN[2] = "Long Distance Towing";
$SD[2] = "Long distance towing handled with careful loading, safe transport, and direct communication.";

$SN[3] = "We Buy Junk Cars";
$SD[3] = "We buy junk cars and help remove unwanted vehicles with straightforward scheduling.";

$SN[4] = "Jump Start Vehicles";
$SD[4] = "Battery jump start assistance when your vehicle will not start at home, work, or on the road.";

$SN[5] = "Locked Car Services";
$SD[5] = "Vehicle lockout help when keys are locked inside and you need access quickly.";

$SN[6] = "Roadside Assistance";
$SD[6] = "Roadside assistance for drivers who need fast help before the next step is decided.";

$SN[7] = "24 Hour Towing";
$SD[7] = "Emergency towing support available 24/7, with office hours from 6:00 AM to 6:00 PM.";

$OtherServices = [
  "Roadside Assistance",
  "24 Hour Towing"
];

$ServicesByCategory = [
  [
    'label' => 'Towing Services',
    'summary_slug' => 'local-towing',
    'service_slugs' => [
      'local-towing',
      'long-distance-towing',
      'we-buy-junk-cars',
      'jump-start-vehicles',
      'locked-car-services',
    ]
  ],
  [
    'label' => 'Roadside Help',
    'summary_slug' => 'roadside-assistance',
    'service_slugs' => [
      'roadside-assistance',
      '24-hour-towing'
    ]
  ]
];

$Badges = [
  $Estimates,
  $Experience,
  $Coverage,
  $LicenseNote,
  $BilingualNote
];

$ExAbout = substr($About[0], 0, 145) . '...';
$ExHome  = substr($Home[0],  0, 95)  . '...';
for ($i = 1; $i <= count($SN); $i++) {
  if (isset($SD[$i])) $ExSD[$i] = substr($SD[$i], 0, 120) . '...';
}

$ServicesList = [];
for ($i = 1; $i <= count($SN); $i++) {
  if (empty($SN[$i])) continue;
  $slug = slugify($SN[$i]);
  $ServicesList[$slug] = [
    'id'          => $i,
    'name'        => $SN[$i],
    'description' => $SD[$i] ?? '',
    'excerpt'     => $ExSD[$i] ?? '',
    'slug'        => $slug,
    'file'        => 'services.php',
    'url'         => 'services.php#' . $slug
  ];
}

$OtherServicesLandingSlugs = [
  'roadside-assistance',
  '24-hour-towing'
];

$PrimaryServiceSlugs = [
  'local-towing',
  'long-distance-towing',
  'we-buy-junk-cars',
  'jump-start-vehicles',
  'locked-car-services'
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
      'category_slug' => $categorySlug,
      'category_label' => $categoryLabel
    ];
  }
}

foreach ($ServicesList as $serviceSlug => &$serviceData) {
  if (isset($serviceCategoryMap[$serviceSlug])) {
    $serviceData['category_slug'] = $serviceCategoryMap[$serviceSlug]['category_slug'];
    $serviceData['category_label'] = $serviceCategoryMap[$serviceSlug]['category_label'];
  } else {
    $serviceData['category_slug'] = 'general';
    $serviceData['category_label'] = 'General';
  }
}
unset($serviceData);

$ServicesDisplayList = array_values($ServicesList);
usort($ServicesDisplayList, static function ($a, $b) {
  return (int) ($a['id'] ?? 0) <=> (int) ($b['id'] ?? 0);
});

$ServiceDetails = [
  'local-towing' => [
    'kicker' => 'Local Towing',
    'headline' => 'Fast towing help near West Palm Beach',
    'paragraphs' => [
      'We provide local towing for drivers in West Palm Beach and nearby Palm Beach County communities.',
      'Our team focuses on safe loading, clear updates, and dependable arrival.'
    ],
    'bullets' => ['Cars and light vehicles', 'Local transport', 'Safe vehicle handling', 'English and Spanish support']
  ],
  'long-distance-towing' => [
    'kicker' => 'Long Distance Towing',
    'headline' => 'Safe transport beyond your local area',
    'paragraphs' => [
      'When your vehicle needs to move farther, Familia Towing coordinates long distance towing with careful handling.',
      'We keep communication direct so you know the pickup and delivery details.'
    ],
    'bullets' => ['Longer transport routes', 'Careful loading', 'Route coordination', 'Clear updates']
  ],
  'we-buy-junk-cars' => [
    'kicker' => 'Junk Cars',
    'headline' => 'We buy junk cars and help clear space',
    'paragraphs' => [
      'If you have an unwanted vehicle, contact us for junk car buying and removal options.',
      'We make scheduling simple and keep the process straightforward.'
    ],
    'bullets' => ['Junk car buying', 'Unwanted vehicle removal', 'Simple scheduling', 'Local pickup support']
  ],
  'jump-start-vehicles' => [
    'kicker' => 'Jump Starts',
    'headline' => 'Battery help when your vehicle will not start',
    'paragraphs' => [
      'A dead battery can stop your day fast. We provide jump start assistance where your vehicle is located.',
      'If a jump start is not enough, we can help coordinate the next towing step.'
    ],
    'bullets' => ['Battery jump starts', 'Home, work, and roadside help', 'Fast dispatch', 'Next-step towing support']
  ],
  'locked-car-services' => [
    'kicker' => 'Lockout Service',
    'headline' => 'Help when your keys are locked inside',
    'paragraphs' => [
      'Locked out of your vehicle? Call Familia Towing for lockout assistance.',
      'We respond with practical help and bilingual communication.'
    ],
    'bullets' => ['Locked car help', 'Driver support', 'Bilingual service', 'Fast roadside response']
  ],
  'roadside-assistance' => [
    'kicker' => 'Roadside Assistance',
    'headline' => 'Practical roadside help when plans change',
    'paragraphs' => [
      'Roadside problems can happen anywhere. We help drivers with jump starts, lockouts, and towing coordination.',
      'Call the Spanish or English number for direct support.'
    ],
    'bullets' => ['Roadside support', 'Jump starts', 'Lockout help', 'Towing coordination']
  ],
  '24-hour-towing' => [
    'kicker' => '24 Hour Towing',
    'headline' => 'Emergency towing available day or night',
    'paragraphs' => [
      'Familia Towing provides 24/7 emergency towing support across Palm Beach County.',
      'Office hours are 6:00 AM to 6:00 PM, and emergency calls are available 24 hours.'
    ],
    'bullets' => ['24/7 emergency towing', 'Palm Beach County coverage', 'Fast response', 'Safe vehicle transport']
  ]
];

/*=========================
  COPY / UI TEXT
  =========================*/
$WhyChoose = [
  'eyebrow' => 'Roadside Help You Can Trust',
  'title_pre' => 'Why Choose',
  'intro' => 'With more than 2 years of towing experience, Familia Towing helps drivers with safe transport, quick roadside assistance, and bilingual communication.',
  'cards' => [
    ['title' => 'Fast Response', 'text' => 'Call for towing, jump starts, lockout service, and junk car help across Palm Beach County.'],
    ['title' => 'Bilingual Support', 'text' => $BilingualNote . '. Use the Spanish or English number shown on the site.'],
    ['title' => 'Need Help Now?', 'text' => 'Contact Familia Towing for 24 hour towing and roadside support.', 'btn' => ['href' => $PhoneRef, 'text' => 'Call Now']],
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
  'projects' => 'Fleet',
  'reviews' => 'Reviews',
  'contact' => 'Contact',
  'other_services' => 'Roadside Help',
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
  'desc' => 'Local and long distance towing, junk car buying, jump starts, and lockout service in Palm Beach County.',
  'titles' => ['company' => 'Company', 'services' => 'Services', 'contact' => 'Contact Us'],
  'labels' => ['location' => 'Location', 'phone' => 'Phone', 'hours' => 'Hours'],
  'copyright_suffix' => 'All Rights Reserved.'
];

$PageHeroCopy = [
  'default' => ['title' => 'Towing Services', 'desc' => 'Local towing, long distance towing, junk car buying, jump starts, locked car service, and 24 hour roadside support.', 'bg' => 'assets/img/hero/hero1.jpg'],
  'projects' => ['title' => 'Our Tow Truck', 'desc' => 'Dependable towing and roadside help across Palm Beach County.', 'bg' => 'assets/img/hero/hero2.jpg'],
  'about' => ['title' => 'About ' . $Company, 'desc' => 'Bilingual towing and roadside assistance serving West Palm Beach, Jupiter, Boca Raton, and Palm Beach County.', 'bg' => 'assets/img/hero/hero3.jpg'],
  'contact' => ['title' => 'Get Roadside Help', 'desc' => 'Call Familia Towing for towing, jump starts, lockouts, and junk car service.', 'bg' => 'assets/img/hero/hero1.jpg'],
  'reviews' => ['title' => 'Customer Reviews', 'desc' => 'Read feedback from drivers we have helped across Palm Beach County.', 'bg' => 'assets/img/hero/hero2.jpg'],
  'other' => ['title' => 'Roadside Help', 'desc' => 'Fast help for towing, jump starts, lockouts, and emergency calls.', 'bg' => 'assets/img/hero/hero3.jpg']
];

$HomeHeroCopy = [
  'headline' => $Company,
  'sub' => '24 hour towing, local and long distance service, junk car buying, jump starts, and locked car help in West Palm Beach, Jupiter, Boca Raton, and Palm Beach County.',
  'cta_primary' => 'Call Spanish Line',
  'cta_secondary' => 'Call English Line',
  'cta_primary_href' => $PhoneRef,
  'cta_secondary_href' => $PhoneRef2,
  'prev_label' => 'Previous slide',
  'next_label' => 'Next slide',
  'slide_alt_prefix' => 'Familia Towing Slide',
  'thumb_alt_prefix' => 'Towing Thumbnail'
];

$HomeAboutCopy = [
  'eyebrow' => 'Palm Beach County Towing',
  'title' => 'Fast Roadside Help,',
  'title_strong' => 'Handled Safely.',
  'description' => 'Familia Towing helps drivers with towing, jump starts, lockouts, long distance transport, and junk car removal.',
  'badge_label' => 'Years in Service',
  'images' => [
    'back' => ['src' => 'assets/img/truck.jpeg', 'alt' => 'Towing service truck'],
    'front' => ['src' => 'assets/img/truck.jpeg', 'alt' => 'Familia Towing truck']
  ],
  'features' => [
    ['icon' => 'fa-truck-pickup', 'title' => 'Local Towing', 'text' => 'West Palm Beach, Jupiter, Boca Raton, and nearby areas.'],
    ['icon' => 'fa-road', 'title' => 'Long Distance', 'text' => 'Vehicle transport with careful loading and communication.'],
    ['icon' => 'fa-comments', 'title' => 'Bilingual Support', 'text' => $BilingualNote],
    ['icon' => 'fa-clock', 'title' => '24 Hour Service', 'text' => $LicenseNote]
  ],
  'cta' => 'Learn About Us'
];

$AboutHeroCopy = [
  'eyebrow' => 'About ' . $Company,
  'title' => 'Reliable towing based in Palm Beach County',
  'desc' => $About[0],
  'cta_primary' => 'Our Story',
  'cta_primary_href' => '#story',
  'cta_secondary_prefix' => 'Call',
  'meta' => [$Experience, $Estimates, $LicenseNote, $BilingualNote],
  'list' => [
    ['label' => 'Service area', 'value' => $Coverage],
    ['label' => 'Schedule', 'value' => $Schedule],
    ['label' => 'Core services', 'value' => $TypeOfService],
    ['label' => 'Availability', 'value' => $LicenseNote]
  ]
];

$AboutStoryCopy = [
  'eyebrow' => 'Our Story',
  'title' => 'Built on fast response and safe vehicle handling',
  'points' => [
    ['title' => '24 hour support', 'text' => $LicenseNote],
    ['title' => 'Bilingual attention', 'text' => $BilingualNote],
    ['title' => 'Fast help', 'text' => $Estimates]
  ],
  'actions' => ['primary_text' => 'Request service', 'primary_href' => $PhoneRef, 'secondary_prefix' => 'Call'],
  'stats' => ['years_label' => 'Years of Experience', 'services_label' => 'Core services', 'areas_label' => 'Service areas', 'areas_separator' => ', ', 'areas_preview_count' => 5]
];

$AboutCredentialsCopy = [
  'eyebrow' => 'Why work with us',
  'title' => 'Reliable help when your vehicle cannot move',
  'intro' => 'Every call is handled with direct communication, bilingual support, and practical next steps.',
  'list' => [
    ['label' => 'Contact', 'value' => $Phone . ' | ' . $Phone2],
    ['label' => 'Availability', 'value' => $LicenseNote],
    ['label' => 'Core services', 'value' => $TypeOfService],
    ['label' => 'Coverage', 'value' => $Coverage],
    ['text' => $Estimates . ' | ' . $BilingualNote]
  ],
  'cta' => ['title' => 'Need towing now?', 'desc' => 'Call for towing, jump starts, lockouts, and junk car removal.', 'primary_text' => 'Call Now', 'primary_href' => $PhoneRef, 'secondary_prefix' => 'Call']
];

$AboutServicesSummaryCopy = ['eyebrow' => 'Services', 'title' => 'How we help', 'desc' => $TypeOfService . ' across Palm Beach County.', 'link_label' => 'Learn more'];
$ServicesListCopy = ['eyebrow' => 'Scope', 'title' => 'Towing services we provide', 'desc' => $Services, 'link_label' => 'Learn more'];
$BrandsCopy = ['tagline' => 'Trusted by Drivers Across Palm Beach County'];

$HomeServicesCopy = [
  'eyebrow' => 'Towing Services',
  'title' => 'Built for Drivers',
  'title_strong' => 'Who Need Help Fast',
  'desc' => 'Local towing, long distance towing, junk car buying, jump starts, locked car service, and 24 hour towing.',
  'link_label' => 'Contact',
  'more_title' => 'Need Roadside Help?',
  'more_desc' => 'Call Familia Towing and tell us your location, vehicle, and what happened.',
  'more_button' => 'Call for Service',
  'more_href' => $PhoneRef
];

$HomeMaintenanceCopy = [
  'tagline' => 'Reliable Tow Service',
  'title' => 'Tow, Unlock,',
  'title_strong' => 'Jump Start',
  'desc' => 'From roadside emergencies to junk car pickup, Familia Towing responds with practical vehicle help.',
  'cards' => [
    ['icon' => 'fa-truck', 'title' => 'Local & Long Distance', 'text' => 'Towing service for short local routes and longer vehicle transport.', 'action' => 'See Details'],
    ['icon' => 'fa-car-battery', 'title' => 'Jump Starts', 'text' => 'Battery jump start help when your vehicle will not turn on.', 'action' => 'See Details'],
    ['icon' => 'fa-key', 'title' => 'Lockout Service', 'text' => 'Locked car service when keys are inside the vehicle.', 'action' => 'See Details'],
    ['icon' => 'fa-recycle', 'title' => 'Junk Cars', 'text' => 'We buy junk cars and help clear unwanted vehicles.', 'action' => 'See Details']
  ],
  'foundation' => [
    ['icon' => 'fa-phone-volume', 'title' => '24/7 Calls', 'subtitle' => 'Emergency towing support'],
    ['icon' => 'fa-language', 'title' => 'Bilingual', 'subtitle' => 'English and Spanish'],
    ['icon' => 'fa-star', 'title' => $ExperienceYears . '+ Years', 'subtitle' => 'Field experience']
  ]
];

$WhyCopy = [
  'badge' => 'Trusted Towing Choice',
  'title_prefix' => 'Why Drivers Choose',
  'description' => 'Our towing service is built around fast response, safe vehicle handling, and bilingual communication.',
  'stats' => [
    ['value' => $ExperienceYears . '+', 'label' => 'Years in Service'],
    ['value' => count($ServicesList) . '+', 'label' => 'Services Offered'],
    ['value' => '24/7', 'label' => 'Emergency Towing']
  ],
  'service_area_label' => 'Coverage and Availability',
  'features' => [
    ['icon' => 'fa-comments', 'title' => 'Clear Communication', 'text' => $BilingualNote . '. Call the Spanish or English line.'],
    ['icon' => 'fa-truck-fast', 'title' => 'Fast Dispatch', 'text' => 'Share your location and vehicle issue so we can send the right help.'],
    ['icon' => 'fa-shield-alt', 'title' => 'Safe Handling', 'text' => 'We focus on careful loading and transport for every tow.'],
    ['icon' => 'fa-clock', 'title' => '24 Hour Support', 'text' => $Schedule]
  ],
  'cta_label' => 'Call Now'
];

$MissionCopy = ['mission_title' => 'Our Mission', 'vision_title' => 'Our Vision'];

$ProcessCopy = [
  'title' => 'How We Respond',
  'title_strong' => 'When You Call',
  'desc' => 'Our process keeps towing and roadside service simple from first call to final drop-off.',
  'steps' => [
    ['icon' => 'fa-phone', 'title' => 'Call Us', 'text' => 'Tell us your location, vehicle, and what kind of help you need.'],
    ['icon' => 'fa-location-dot', 'title' => 'Confirm Details', 'text' => 'We confirm pickup point, service type, and destination when needed.'],
    ['icon' => 'fa-truck-fast', 'title' => 'Dispatch Help', 'text' => 'Our driver heads to your location for towing or roadside assistance.'],
    ['icon' => 'fa-check-circle', 'title' => 'Complete Service', 'text' => 'We help finish the tow, jump start, lockout, or junk car pickup safely.']
  ]
];

$FaqCopy = [
  'title' => 'Frequently Asked Questions',
  'items' => [
    ['q' => 'Do you provide 24 hour service?', 'a' => 'Yes. Emergency towing support is available 24/7. Office hours are 6:00 AM to 6:00 PM.'],
    ['q' => 'Do you speak Spanish?', 'a' => 'Yes. Familia Towing speaks English and Spanish.'],
    ['q' => 'What areas do you cover?', 'a' => $Coverage],
    ['q' => 'Do you buy junk cars?', 'a' => 'Yes. We buy junk cars and help schedule removal for unwanted vehicles.']
  ]
];

$AreasCopy = [
  'title' => 'Serving',
  'title_strong' => 'Palm Beach County',
  'subtitle' => 'Coverage includes West Palm Beach, Jupiter, Boca Raton, and nearby communities.',
  'cta_label' => 'Request Service in Your Area',
  'map_overlay' => 'Active Towing Coverage',
  'license_pills' => ['24 Hour Service', 'English & Spanish', 'Local & Long Distance']
];

$CtaCopy = [
  'badge' => $ExperienceYears . '+ Years in Towing',
  'title' => 'Need Towing',
  'title_strong' => 'Right Now?',
  'paragraph' => $Company . ' provides local and long distance towing, junk car buying, jump starts, and locked car service across Palm Beach County.',
  'features' => ['24 Hour Service', 'Bilingual Team', 'Fast Assistance'],
  'button' => 'Call for Service',
  'card_title' => 'Speak With Familia Towing',
  'card_subtitle' => 'Fast response for towing and roadside calls',
  'row_call_label' => 'Call for towing',
  'row_license_label' => 'Availability',
  'row_license_title' => $LicenseNote,
  'row_service_label' => 'Coverage Area',
  'whatsapp_button' => 'WhatsApp Us',
  'book_button' => 'Start Request'
];

$ContactFormCopy = [
  'eyebrow' => 'Request Service',
  'title' => "Let's Get You",
  'title_strong' => 'Back on the Road.',
  'desc' => 'Send your location, vehicle details, and service needed. For emergencies, call directly.',
  'method_labels' => ['call' => 'Call or Text', 'hours' => 'Business Hours'],
  'form_labels' => ['name' => 'Name', 'phone' => 'Phone', 'email' => 'Email', 'service' => 'Service', 'message' => 'Service Details'],
  'placeholders' => ['service' => 'Select service type', 'service_other' => 'Other / Custom Request', 'message' => 'Describe your location, vehicle, and what happened...'],
  'submit' => 'Send Service Request',
  'honeypot_label' => 'Leave this field empty'
];

$MapCopy = ['title' => 'Locate', 'title_strong' => 'Familia Towing', 'labels' => ['location' => 'Service Base', 'call' => 'Phone', 'hours' => 'Hours']];

$TestimonialsCopy = ['title' => 'Driver Feedback', 'title_strong' => 'From Real Calls', 'desc' => 'Read customer feedback from towing and roadside assistance calls across Palm Beach County.', 'button_label' => 'Read More Reviews', 'button_href' => 'reviews.php', 'fallback_name' => 'Verified Client'];

$TrustedDirectoriesCopy = [
  'eyebrow' => 'Trusted Feedback Sources',
  'title' => 'Customer Service Highlights',
  'desc' => 'Explore feedback from drivers helped by Familia Towing.',
  'cards' => [
    ['icon' => 'fa-award', 'subtitle' => 'Website', 'title' => 'Website Reviews', 'text' => 'Read direct feedback from towing and roadside customers.', 'url' => 'reviews.php', 'tags' => ['Client Feedback', 'Verified Responses']],
    ['icon' => 'fa-phone', 'subtitle' => 'Follow-Up', 'title' => 'Service Follow-Up', 'text' => 'See customer satisfaction highlights after towing calls.', 'url' => 'reviews.php', 'tags' => ['Roadside Help', 'Service Quality']],
    ['icon' => 'fa-car', 'subtitle' => 'Drivers', 'title' => 'Driver Experiences', 'text' => 'Explore feedback from local towing, jump starts, and lockouts.', 'url' => 'reviews.php', 'tags' => ['Local Drivers', 'Fast Response']],
    ['icon' => 'fa-map', 'subtitle' => 'Coverage', 'title' => 'Palm Beach County', 'text' => 'Read comments from drivers across West Palm Beach, Jupiter, and Boca Raton.', 'url' => 'reviews.php', 'tags' => ['County Coverage', 'Trusted Service']]
  ]
];

$ReviewsPageCopy = [
  'hero_title' => 'Customer Reviews',
  'hero_subtitle' => 'See what drivers across Palm Beach County say about working with us.',
  'hero_image' => 'assets/img/stock/vision-crew.jpg',
  'list_eyebrow' => 'Reviews',
  'list_title' => 'What Our Customers Say',
  'list_desc' => 'Recent feedback from towing and roadside assistance customers.',
  'list_cta' => 'Leave a Review'
];

$ReviewFormCopy = [
  'title' => 'Share Your Experience',
  'subtitle' => 'We value your feedback and would love to hear about your service.',
  'success_title' => 'Thank You!',
  'success_message' => 'Your review has been submitted successfully.',
  'error_title' => 'Error!',
  'captcha_error' => 'Incorrect security code. Please try again.',
  'labels' => ['name' => 'Your Name', 'city' => 'City / Location', 'rating' => 'Rating', 'rating_hint' => '(Select stars)', 'review' => 'Your Review', 'security' => 'Security Check', 'refresh' => 'Refresh', 'captcha' => 'Enter the code shown above'],
  'captcha_alt' => 'Captcha image',
  'placeholders' => ['name' => '', 'city' => 'e.g. West Palm Beach, FL', 'review' => 'Tell us how we did...'],
  'submit' => 'Submit Review'
];

$GalleryHeroCopy = ['eyebrow' => 'Our Gallery', 'title' => 'Familia Towing in Action', 'desc' => 'Explore towing and roadside service moments from ' . $Company . ' across Palm Beach County.', 'cta_text' => 'Call Now', 'cta_href' => $PhoneRef];

$ProjectsIntroCopy = [
  'label' => 'Our Work',
  'title_line1' => 'Towing',
  'title_line2' => 'Support.',
  'outline_line1' => 'On The Road',
  'outline_line2' => 'Day Or Night.',
  'desc' => 'At ' . $Company . ', every call is handled with safe vehicle care and clear communication.',
  'stats' => [
    ['value' => $ExperienceYears . '+', 'label' => 'Years of Experience'],
    ['value' => count($ServicesList) . '+', 'label' => 'Services Offered'],
    ['value' => count($Areas), 'label' => 'Areas Served']
  ]
];

$ProjectsBeforeAfterCopy = ['eyebrow' => 'Service', 'title' => 'Before & After', 'desc' => 'See how roadside help gets drivers moving again.', 'before_label' => 'Before', 'after_label' => 'After'];
$ProjectsStatsCopy = ['items' => [
  ['icon' => 'fa-hourglass-half', 'value' => $ExperienceYears . '+', 'label' => 'Years of Service'],
  ['icon' => 'fa-truck', 'value' => count($ServicesList) . '+', 'label' => 'Towing Services'],
  ['icon' => 'fa-map-location-dot', 'value' => count($Areas), 'label' => 'Areas Served'],
  ['icon' => 'fa-clock', 'value' => '24/7', 'label' => 'Emergency Towing']
]];

$ProjectsGalleryCopy = ['eyebrow' => 'Service Gallery', 'title' => 'Selected Work &', 'title_strong' => 'Recent Calls', 'videos_label' => 'Videos', 'empty' => 'Projects coming soon.', 'image_title' => 'Service Photo', 'video_title' => 'Service Video'];
$ServiceHeroCopy = ['badge' => 'Towing Service', 'cta_primary' => 'Call Now', 'cta_secondary' => 'Explore Service'];
$ServiceIntroCopy = [
  'eyebrow' => 'Our Method',
  'title' => 'How We Deliver',
  'title_strong' => 'Roadside Help',
  'desc' => 'We keep the process simple so you know what to expect from call to completion.',
  'steps' => [
    ['icon' => 'fa-comments', 'title' => 'Call', 'text' => 'We start by confirming your location and service need.'],
    ['icon' => 'fa-map-location-dot', 'title' => 'Dispatch', 'text' => 'A driver heads your way with the right support.'],
    ['icon' => 'fa-truck', 'title' => 'Service', 'text' => 'We complete the tow, jump start, lockout, or junk car pickup.']
  ]
];

$ServiceDetailsCopy = ['badge_title' => 'Familia Towing Promise', 'badge_subtitle' => 'Service Focused', 'title_prefix' => 'Professional', 'button' => 'Call Now'];
$ServiceFaqCopy = [
  'eyebrow' => 'Common Questions',
  'title' => 'Info About Our',
  'title_strong' => 'Towing Service',
  'items' => [
    ['icon' => 'fa-hourglass-half', 'question' => 'How fast can you arrive?', 'answer' => 'Arrival time depends on your location and traffic. Call with your exact location for current availability.'],
    ['icon' => 'fa-file-invoice-dollar', 'question' => 'Do you buy junk cars?', 'answer' => 'Yes. ' . $Company . ' buys junk cars and helps schedule removal.'],
    ['icon' => 'fa-language', 'question' => 'Do you speak Spanish?', 'answer' => $BilingualNote . '.'],
    ['icon' => 'fa-map', 'question' => 'What areas do you serve?', 'answer' => $Coverage]
  ],
  'footer' => 'Have a different question? Contact our team directly'
];

$ServiceCtaCopy = [
  'tag' => 'Need Help?',
  'title' => "Let's Get Your",
  'title_strong' => 'Vehicle Moving',
  'paragraph' => 'Call for %s across West Palm Beach, Jupiter, Boca Raton, and Palm Beach County.',
  'subject_fallback' => 'service',
  'features' => ['24/7', 'Bilingual', $Experience],
  'primary' => 'Call Now',
  'secondary_prefix' => 'Call'
];

$OtherServicesCopy = ['label' => 'Additional Help', 'title' => 'More Ways We Can Help', 'title_strong' => 'On The Road', 'item_note' => 'Professional towing and roadside assistance.', 'cta_title' => 'Have a specific request?', 'cta_text' => 'From emergency towing to junk car pickup, call and tell us what you need.', 'cta_button' => $Estimates, 'page_desc' => 'Additional roadside help tailored to your vehicle situation.'];
$FounderCopy = ['title' => 'A Note from', 'title_strong' => 'The Owner', 'quote' => 'At ' . $Company . ', we believe towing is about trust, response, and safe vehicle care. Our goal is to help every driver with practical service and clear communication.', 'role' => 'Owner', 'image_alt' => $CustomerName];

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

$TestimonialsPageCopy = ['eyebrow' => $NavCopy['reviews'] ?? 'Reviews', 'title' => 'What Customers Say', 'desc' => 'Trusted feedback from drivers across Palm Beach County.', 'card_title' => 'Read Verified Reviews', 'card_desc' => 'See feedback from towing and roadside service customers.', 'card_button' => $NavCopy['read_reviews'] ?? 'Read Reviews', 'card_link' => 'reviews.php'];
$ThankYouCopy = ['title' => 'Thank You', 'description' => 'Thank you for contacting ' . $Company . '. We will be in touch shortly.', 'eyebrow' => 'Thank You', 'headline' => 'We received your request', 'body' => 'Thank you for contacting ' . $Company . '. Our team will reach out soon to confirm your towing or roadside service details.', 'cta_call' => 'Click to Call', 'cta_home' => 'Back to Home'];
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
  --site-surface-soft:color-mix(in srgb, var(--brand-neutral) 82%, #fff 18%);
  --site-ink:var(--brand-secondary);
  --site-ink-soft:rgba(var(--brand-secondary-rgb),0.76);
  --site-panel:#ffffff;
  --site-panel-soft:rgba(255,255,255,0.78);
  --site-line:rgba(var(--brand-secondary-rgb),0.14);
  --site-dark:#0a0a0b;
  --site-dark-2:#161616;
  --site-dark-3:#1f1f1f;
  --site-dark-line:rgba(var(--brand-accent-rgb),0.26);
  --site-dark-text:#ffffff;
  --site-dark-muted:rgba(255,255,255,0.72);
  --site-accent-soft:rgba(var(--brand-accent-rgb),0.14);
}
body{
  background:
    radial-gradient(circle at 10% 8%, rgba(var(--brand-accent-rgb),0.16), transparent 28%),
    linear-gradient(180deg, var(--brand-neutral) 0%, #ffffff 100%);
}
#hero-4.hero4{
  background: linear-gradient(130deg, #000 0%, var(--brand-secondary) 58%, #2a1600 100%) !important;
}
#hero-4 .hero4__slides::after{
  background: linear-gradient(to bottom, rgba(0,0,0,0.78) 0%, rgba(0,0,0,0.5) 42%, rgba(0,0,0,0.88) 100%) !important;
}
#hero-4 .hero4__content{
  background: linear-gradient(145deg, rgba(0,0,0,0.92), rgba(var(--brand-secondary-rgb),0.78)) !important;
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
  color: #080808 !important;
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
  background: linear-gradient(135deg, #000 0%, var(--brand-secondary) 100%) !important;
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
  border-radius: 18px !important;
}
.section-services-premium .sv-card:hover,
.section-maint-pro .maint-card-dark:hover,
.section-remodel-why .feature-card:hover,
.section-process .process-step:hover{
  box-shadow: 0 22px 48px rgba(0,0,0,0.28) !important;
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
  color: #080808 !important;
}
.section-areas .btn-area{
  border-color: var(--brand-accent) !important;
  color: var(--brand-accent) !important;
}
.section-areas .btn-area:hover{
  background: var(--brand-accent) !important;
  color: #080808 !important;
}
.section-contact-premium .form-control-arch:focus{
  border-bottom-color: var(--brand-accent) !important;
}
.section-map-contact .map-background iframe{
  filter: grayscale(60%) contrast(0.9) !important;
}
.language-switcher{
  display:inline-flex;
  align-items:center;
  gap:6px;
  padding:5px;
  border-radius:999px;
  background:#0b0b0d;
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
  color:#050505;
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
