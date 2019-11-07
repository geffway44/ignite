<?php

namespace App\Inspectors\Inspections;

use Exception;
use App\Inscpections\Contracts\InspectionContract;

class KeyHeldDown implements InspectionContract
{
    /**
     * Inspect content for illegals.
     *
     * @param string $body
     * @return bool
     * @throws \Exception
     */
    public function detect($body)
    {
        if (preg_match('/(.)\\1{4,}/', $body)) {
            throw new Exception('Your reply contains spam.');
        }
    }
}
