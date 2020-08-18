<?php

namespace App\Events;

use App\Models\Reply;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ThreadReceivedNewReply
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * The reply that was posted.
     *
     * @param \App\Models\Reply $reply
     */
    public $reply;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Reply $reply
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the subject of the event.
     */
    public function subject()
    {
        return $this->reply;
    }
}
