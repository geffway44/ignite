<?php

namespace Tests\Unit;

use App\Thread;
use App\Channel;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    /** @test **/
    public function it_consists_of_threads()
    {
        $this->signIn();

        $channel = create(Channel::class);
        $thread = create(Thread::class, ['channel_id' => $channel->id]);

        $this->assertTrue($channel->threads->contains($thread));
    }
}
