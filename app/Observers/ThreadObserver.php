<?php

namespace App\Observers;

use App\Models\Thread;
use App\Events\ThreadWasPublished;

class ThreadObserver
{
    /**
     * Handle the thread "created" event.
     *
     * @param \App\Models\Thread $thread
     *
     * @return void
     */
    public function created(Thread $thread)
    {
        event(new ThreadWasPublished($thread));

        $thread->user->gainReputation('thread_published');
    }

    /**
     * Handle the thread "updated" event.
     *
     * @param \App\Models\Thread $thread
     *
     * @return void
     */
    public function updated(Thread $thread)
    {
    }

    /**
     * Handle the thread "deleting" event.
     *
     * @param \App\Models\Thread $thread
     *
     * @return void
     */
    public function deleting(Thread $thread)
    {
        $thread->replies->each->delete();

        $thread->creator->loseReputation('thread_published');
    }
}
