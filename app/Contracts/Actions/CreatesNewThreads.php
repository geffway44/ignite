<?php

namespace App\Contracts\Actions;

use App\Models\User;
use App\Models\Thread;

interface CreatesNewThreads
{
    /**
     * Create new thread.
     *
     * @param \App\Models\User $user
     * @param array            $data
     *
     * @return \App\Models\Thread
     */
    public function create(User $user, array $data): Thread;
}
