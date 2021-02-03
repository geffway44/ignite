<?php

namespace App\Observers;

use App\Models\Thread;
use Illuminate\Support\Str;

class ThreadObserver
{
    /**
     * Handle the Thread "created" event.
     *
     * @param \App\Models\Thread $thread
     *
     * @return void
     */
    public function creating(Thread $thread)
    {
        $thread->slug = Str::slug($thread->title);
    }

    /**
     * Handle the Thread "updated" event.
     *
     * @param \App\Models\Thread $thread
     *
     * @return void
     */
    public function updated(Thread $thread)
    {
    }

    /**
     * Handle the Thread "deleted" event.
     *
     * @param \App\Models\Thread $thread
     *
     * @return void
     */
    public function deleted(Thread $thread)
    {
    }
}
