<?php

namespace App\Policies;

use App\User;
use App\Reply;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the authenticated user has permission to create a new reply.
     *
     * @param  User $user
     * @return bool
     */
    public function create(User $user)
    {
        if (! $lastReply = $user->fresh()->lastReply) {
            return true;
        }

        return ! $lastReply->wasJustPublished();
    }

    /**
     * Determine whether the user can update the reply.
     *
     * @param \App\User  $user
     * @param \App\Reply $reply
     *
     * @return mixed
     */
    public function update(User $user, Reply $reply)
    {
        return $user->is($reply->user);
    }

    /**
     * Determine whether the user can delete the reply.
     *
     * @param \App\User  $user
     * @param \App\Reply $reply
     *
     * @return mixed
     */
    public function delete(User $user, Reply $reply)
    {
        return $user->is($reply->user);
    }
}
