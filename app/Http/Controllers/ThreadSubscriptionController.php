<?php

namespace App\Http\Controllers;

use App\Thread;

class ThreadSubscriptionController extends Controller
{
    /**
     * Subscribe a user to the thread.
     *
     * @param  \App\Channel  $channel
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function subscribe($channel, Thread $thread)
    {
        $thread->subscribe();
    }

    /**
     * Unsubscribe a user to the thread.
     *
     * @param  \App\Channel  $channel
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe($channel, Thread $thread)
    {
        $thread->unsubscribe();
    }
}
