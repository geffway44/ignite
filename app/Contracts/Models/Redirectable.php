<?php

namespace App\Contracts\Models;

interface Redirectable
{
    /**
     * Determine the path to the reply.
     *
     * @return string
     */
    public function path(): string;
}
