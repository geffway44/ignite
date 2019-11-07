<?php

if (!function_exists('authUsername')) {
    /**
     * Get the username of the authenticated user.
     */
    function authUsername()
    {
        return auth()->user()->username;
    }
}
