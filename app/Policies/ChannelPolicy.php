<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Channel;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChannelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Channel $channel
     *
     * @return mixed
     */
    public function manage(User $user, Channel $channel)
    {
        // return $user->hasPermissionTo('create', $channel);
        return true;
    }
}
