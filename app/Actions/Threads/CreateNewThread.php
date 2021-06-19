<?php

namespace App\Actions\Threads;

use Emberfuse\Scorch\Contracts\Actions\CreatesNewResources;

class CreateNewThread implements CreatesNewResources
{
    /**
     * Create a new resource type.
     *
     * @param array      $data
     * @param array|null $options
     *
     * @return mixed
     */
    public function create(array $data, ?array $options = null)
    {
    }
}
