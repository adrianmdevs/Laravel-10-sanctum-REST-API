<?php

return [
    'mode' => 'utf-8',
    'author' => '',
    'subject' => '',
    'keywords' => '',
    'creator' => 'Laravel Pdf',
    'display_mode' => 'fullpage',
    'tempDir' => base_path('../temp/'),
    // ...
    'font_path' => base_path('resources/fonts/'),
    'font_data' => [
        'vibes' => [
            'R' => 'GreatVibes-Regular.ttf',    // regular font
        ],
        'lato' => [
            'R' => 'Lato-Regular.ttf',    // regular font
            'B' => 'Lato-Bold.ttf',       // optional: bold font
            'I' => 'Lato-Italic.ttf',     // optional: italic font
            'BI' => 'Lato-BoldItalic.ttf' // optional: bold-italic font
        ],
        'lobster' => [
            'R' => 'Lobster-Regular.ttf',    // regular font
        ],
        // ...add as many as you want.
    ]
    // ...
];
