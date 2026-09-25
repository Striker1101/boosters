<?php

/*
|--------------------------------------------------------------------------
| Simulation lure themes
|--------------------------------------------------------------------------
|
| Each theme is a deliberately *generic* landing experience. They use our own
| icons and colours and never copy a platform's logo, wordmark or trade dress.
| The `platform` name appears only as plain text in the body copy, which is
| enough to make the exercise realistic without impersonating a brand.
|
*/

return [

    'generic' => [
        'label' => 'Generic account verification',
        'headline' => 'Verify your account to continue',
        'subhead' => 'We noticed unusual activity and need you to confirm your details.',
        'accent' => '#6366f1',
        'icon' => 'fa-solid fa-shield-halved',
        'prompt' => 'Confirm your details',
    ],

    'social' => [
        'label' => 'Social profile security check',
        'headline' => 'Your profile needs a security check',
        'subhead' => 'Confirm your sign-in details to keep your profile visible to your followers.',
        'accent' => '#8b5cf6',
        'icon' => 'fa-solid fa-user-shield',
        'prompt' => 'Continue to profile',
    ],

    'creator' => [
        'label' => 'Creator payout verification',
        'headline' => 'Verify your account to release your payout',
        'subhead' => 'Your earnings are on hold until your account details are confirmed.',
        'accent' => '#f59e0b',
        'icon' => 'fa-solid fa-sack-dollar',
        'prompt' => 'Release payout',
    ],

    'storage' => [
        'label' => 'Shared document notification',
        'headline' => 'A document has been shared with you',
        'subhead' => 'Sign in to view the document before the share link expires.',
        'accent' => '#10b981',
        'icon' => 'fa-solid fa-file-shield',
        'prompt' => 'Open document',
    ],

    'invoice' => [
        'label' => 'Outstanding invoice notice',
        'headline' => 'An invoice is awaiting your review',
        'subhead' => 'Review and approve the invoice assigned to your account.',
        'accent' => '#ef4444',
        'icon' => 'fa-solid fa-file-invoice-dollar',
        'prompt' => 'Review invoice',
    ],

];
