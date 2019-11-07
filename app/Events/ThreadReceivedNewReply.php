<?php

namespace App\Events;

use App\Reply;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ThreadReceivedNewReply
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Reply that was updated.
     *
     * @var \App\Reply.
     */
    public $reply;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }
}
