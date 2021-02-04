<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Thread;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User   $user
     * @param \App\Models\Thread $thread
     *
     * @return mixed
     */
    public function manage(User $user, Thread $thread)
    {
        return $user->is($thread->user);
    }
}
