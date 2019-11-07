<?php

namespace App\Inscpectors\Inspections;

use Exception;
use App\Inscpections\Contracts\InspectionContract;

class InvalidKeywords implements InspectionContract
{
    /**
     * All registered invalid keywords.
     *
     * @var array
     */
    protected $keywords = [
        'yahoo customer support',
    ];

    /**
     * Inspect content for illegals.
     *
     * @param string $body
     * @return bool
     * @throws \Exception
     */
    public function detect($body)
    {
        foreach ($this->keywords as $keyword) {
            if (stripos($body, $keyword) !== false) {
                throw new Exception('Your reply contains spam.');
            }
        }
    }
}
