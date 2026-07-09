<?php
@session_start();
require_once __DIR__ . '/text.php';

// --- DATA LOGIC: Handle Form Submission & Load Reviews ---

$jsonFile = __DIR__ . '/data/reviews.json';

// 1. Handle POST (New Review)
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $name    = strip_tags(trim($_POST['name'] ?? ''));
    $city    = strip_tags(trim($_POST['city'] ?? ''));
    $text    = strip_tags(trim($_POST['text'] ?? ''));
    $stars   = (int)($_POST['stars'] ?? 5);
    $captcha = strtoupper(trim($_POST['captcha'] ?? ''));

    // Validate Captcha
    if (empty($_SESSION['captcha_code']) || $captcha !== $_SESSION['captcha_code']) {
        header("Location: reviews.php?error=" . urlencode($ReviewFormCopy['captcha_error'] ?? ''));
        exit;
    }

    // Load existing items
    $currentReviews = [];
    if (file_exists($jsonFile)) {
        $currentReviews = json_decode(file_get_contents($jsonFile), true) ?? [];
    }

    // Add new item
    $newReview = [
        "name" => $name,
        "city" => $city,
        "stars" => $stars,
        "text" => $text,
        "date" => "Just now" // Dynamic date, simplistic for now
    ];

    // Prepend to array (newest first)
    array_unshift($currentReviews, $newReview);

    // Save back to JSON
    file_put_contents($jsonFile, json_encode($currentReviews, JSON_PRETTY_PRINT));

    // Redirect to success
    header("Location: reviews.php?success=1");
    exit;
}

// 2. Load Reviews for Display (Verified + user submissions)
$Reviews = $DetailedReviewItems ?? ($DirectoryReviewItems ?? ($GoogleReviewItems ?? []));
if (!empty($ReviewSourceSummaries) && is_array($ReviewSourceSummaries)) {
    $ReviewSources = $ReviewSourceSummaries;
}
if (file_exists($jsonFile)) {
    $userReviews = json_decode(file_get_contents($jsonFile), true) ?? [];
    if (!empty($userReviews)) {
        foreach ($userReviews as &$ur) {
            if (empty($ur['source'])) $ur['source'] = 'Website Review';
            if (empty($ur['date'])) $ur['date'] = 'Recently posted';
        }
        unset($ur);
        $Reviews = array_merge($Reviews, $userReviews);
    }
}


// --- VIEW LOGIC ---

// SEO basics
$PageTitle = ($NavCopy['reviews'] ?? '') . ' | ' . ($Company ?? '');
$PageDescription = $ReviewsPageCopy['list_desc'] ?? '';
$PageCanonical = rtrim($BaseURL ?? '', '/') . '/reviews.php';
$BodyClass = 'reviews-page';

include __DIR__ . '/header.php';
?>

<style>
body.reviews-page,
body.reviews-page main,
body.reviews-page .page-content {
  overflow-x: hidden;
  overflow-x: clip;
}

body.reviews-page .review-submit,
body.reviews-page .reviews-verified,
body.reviews-page .section-contact-premium,
body.reviews-page .cta-forge {
  overflow-x: hidden;
  overflow-x: clip;
}

body.reviews-page .review-submit__grid > *,
body.reviews-page .reviews-verified__grid > *,
body.reviews-page .reviews-verified__sources > *,
body.reviews-page .ct-grid > *,
body.reviews-page .cta-forge__layout > * {
  min-width: 0;
}
</style>

<main class="page-content">
  <!-- Reusing Page Hero -->
  <?php 
    $pageHeroTitle = $ReviewsPageCopy['hero_title'] ?? '';
    $pageHeroSubtitle = $ReviewsPageCopy['hero_subtitle'] ?? '';
    $pageHeroImage = $ReviewsPageCopy['hero_image'] ?? (function_exists('stockImage') ? stockImage('hero2') : "");
    if(strpos($pageHeroImage, 'http') !== 0 && !file_exists($pageHeroImage)) {
        $pageHeroImage = function_exists('stockImage') ? stockImage('hero2') : "";
    }

    include __DIR__ . '/partials/shared/page-hero.php'; 
  ?>
 <?php include __DIR__ . '/partials/reviews/review-form.php'; ?>
  <!-- Reviews List (Uses $Reviews variable loaded above) -->
  <?php include __DIR__ . '/partials/reviews/reviews-list.php'; ?>

  <!-- Submission Form -->
 
  
</main>

<?php include('partials/shared/trusted-partners.php'); ?>
<?php include('partials/shared/contact-form.php'); ?>          
<?php include('partials/shared/cta.php'); ?>
<?php include __DIR__ . '/footer.php'; ?>
