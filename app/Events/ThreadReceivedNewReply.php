<?php

namespace App\Events;

use App\Models\Thread;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ThreadReceivedNewReply
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * Instance of thread being broadcast.
     *
     * @var \App\Models\Thread
     */
    protected $thread;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Thread $thread
     *
     * @return void
     */
    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }
}
