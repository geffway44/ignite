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

if (!function_exists('parse')) {
    /**
     * Parse markdown.
     *
     * @param string $content
     *
     * @return \Parsedown
     */
    function parse($content)
    {
        return app('markdown')->text($content);
    }
}
