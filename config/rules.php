<?php

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;
use Cratespace\Citadel\Rules\PasswordRule;

return [
    /*
     * Password Input Validation Rules.
     */
    'password' => ['required', 'string', new PasswordRule(), 'confirmed'],

    /*
     * User Login Validation Rules.
     */
    'login' => [
        'email' => ['required', 'string', 'email'],
        'password' => ['required', 'string'],
        'remember' => ['sometimes'],
    ],

    /*
     * Use Registration Validation Rules.
     */
    'register' => [
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique(User::class),
        ],
        'password' => ['required', 'string', new PasswordRule(), 'confirmed'],
    ],

    /*
     * Use Profile Information Validation Rules.
     */
    'update_profile' => [
        'photo' => ['sometimes', 'image', 'max:1024'],
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email'],
    ],

    /*
     * Use Account Password Update Validation Rules.
     */
    'update_password' => [
        'current_password' => ['required', 'string'],
        'password' => [
            'required',
            'string',
            new PasswordRule(),
            'confirmed',
            'different:current_password',
        ],
    ],

    /*
     * Create/Update Threads Validation Rules.
     */
    'threads' => [
        'title' => ['required', 'string'],
        'body' => ['required', 'string'],
        'channel_id' => ['required', 'integer', 'exists:App\Models\Channel,id'],
    ],

    /*
     * Create/Update Replies Validation Rules.
     */
    'replies' => [
        'body' => ['required', 'string'],
    ],
];
