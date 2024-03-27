<?php

include('config.inc.php');

$onboardingScreens = [
    [
        'image' => $site_URL.'resources/onboarding/onboarding_1.png',
        'text' => 'Onboarding Screen 1 Text',
    ],
    [
        'image' => $site_URL.'resources/onboarding/onboarding_2.png',
        'text' => 'Onboarding Screen 2 Text',
    ],
    [
        'image' => $site_URL.'resources/onboarding/onboarding_3.png',
        'text' => 'Onboarding Screen 3 Text',
    ],
];

// Number of pages
$numberOfPages = count($onboardingScreens);

// Combine data with the number of pages
$response = [
    'pages' => $numberOfPages,
    'screens' => $onboardingScreens,
];

// Set the content type to JSON
header('Content-Type: application/json');

// Output the response data as JSON
echo json_encode($response);
