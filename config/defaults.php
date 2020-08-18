<?php

return [
    /*
     * Default/Admin User Details
     */
    'user' => [
        'username' => 'Thavarshan',
        'name' => 'Thavarshan Thayananthajothy',
        'email' => 'tjthavarshan@gmail.com',
        'phone' => '775018795',
        'email_verified_at' => now(),
        'password' => '$2y$10$8jakkFVc8175VAOGK5Jt/uDT4R9KEwJPdG5jEEceaxCHwyfhkLs2S', // alphaxion77
        'remember_token' => 'Wdd5eAC4tFBrM0c4qT1b1yGrePdlBzONsndKxjEx',
        'settings' => [
            'notifications_mobile' => 'everything',
            'notifications_email' => [
                'new-order', 'cancel-order', 'newsletter',
            ],
        ],
    ],

    'administrators' => [
        // Add the email addresses of users who should be administrators here.
    ],

    'reputation' => [
        'thread_published' => 10,
        'reply_posted' => 2,
        'best_reply_awarded' => 50,
        'reply_favorited' => 5,
    ],

    'pagination' => [
        'perPage' => 25,
    ],
];
