<?php

/**
 * All Validation Rules.
 */
return [
    /*
     * User Inputs Rules
     */
    'user' => [
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'phone' => ['required', 'string', 'min:9'],
    ],

    /*
     * User Password Reset Inputs Rules
     */
    'user-password' => [
        'password' => ['required', 'string', 'min:8', 'confirmed', 'different:old_password'],
        'password_confirmation' => ['required', 'string', 'min:8'],
    ],

    /*
     * User Business Inputs Rules
     */
    'profile' => [
        'phone' => ['required', 'integer', 'min:9'],
        'description' => ['nullable', 'string'],
    ],

    /*
     * Thread Inputs Rules
     */
    'thread' => [
        'title' => ['required', 'string', 'max:255'],
        'body' => ['required', 'string'],
        'channel_id' => ['required', 'integer'],
    ],

    /*
     * Reply Inputs Rules
     */
    'reply' => [
        'body' => ['required', 'string'],
    ],

    /*
     * Channel Inputs Rules
     */
    'channel' => [
        'name' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
    ],

    /*
     * Address Inputs Rules
     */
    'address' => [
        'street' => ['required', 'string'],
        'state' => ['required', 'string'],
        'city' => ['required', 'string'],
        'country' => ['required', 'string'],
    ],

    /*
     * Registration Inputs Rules
     */
    'registration' => [
        'name' => ['required', 'string', 'max:255'],
        'business' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'phone' => ['required', 'string', 'min:9'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ],
];
