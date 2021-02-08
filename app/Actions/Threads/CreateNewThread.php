<?php

namespace App\Actions\Threads;

use App\Models\User;
use App\Models\Thread;
use App\Contracts\Actions\CreatesNewThreads;

class CreateNewThread implements CreatesNewThreads
{
    /**
     * Create new thread.
     *
     * @param \App\Models\User $user
     * @param array            $data
     *
     * @return \App\Models\Thread
     */
    public function create(User $user, array $data): Thread
    {
        return $user->threads()->create($data);
    }
}
