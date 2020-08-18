<?php

namespace App\Observers;

use App\Models\Reply;

class ReplyObserver
{
    /**
     * Handle the reply "created" event.
     *
     * @param \App\Models\Reply $reply
     *
     * @return void
     */
    public function created(Reply $reply)
    {
        $reply->thread->increment('replies_count');

        $reply->user->gainReputation('reply_posted');
    }

    /**
     * Handle the reply "updated" event.
     *
     * @param \App\Models\Reply $reply
     *
     * @return void
     */
    public function updated(Reply $reply)
    {
    }

    /**
     * Handle the reply "deleting" event.
     *
     * @param \App\Models\Reply $reply
     *
     * @return void
     */
    public function deleting(Reply $reply)
    {
        $reply->thread->decrement('replies_count');

        $reply->user->loseReputation('reply_posted');

        if ($reply->isBest()) {
            $reply->thread->removeBestReply();
        }
    }
}
