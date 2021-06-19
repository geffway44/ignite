<?php

namespace App\Actions\Threads;

use App\Models\Thread;

class UpdateThread
{
    /**
     * Validate and update the given threads's details.
     *
     * @param \App\Models\Thread $thread
     * @param array              $data
     * @param array|null         $options
     *
     * @return void
     */
    public function update(Thread $user, array $data, ?array $options = null): void
    {
    }
}
