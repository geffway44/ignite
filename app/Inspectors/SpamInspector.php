<?php

namespace App\Inspectors;

use App\Inspectors\Inspections\KeyHeldDown;
use App\Inscpectors\Inspections\InvalidKeywords;

class SpamInspector
{
    /**
     * All registered inspections.
     *
     * @var array
     */
    protected $inspections = [
        InvalidKeywords::class,
        KeyHeldDown::class,
    ];

    /**
     * Detect spam.
     *
     * @param  string $body
     * @return bool
     */
    public function detect($body)
    {
        foreach ($this->inspections as $inspection) {
            app($inspection)->detect($body);
        }

        return false;
    }
}
