<?php

namespace App\Inscpections\Contracts;

interface InspectionContract
{
    /**
     * Inspect content for illegals.
     *
     * @param string $body
     * @return bool
     * @throws \Exception
     */
    public function detect($body);
}
