<?php

namespace Tests\Unit;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function testThreadHasUser()
    {
        $thread = create(Thread::class);

        $this->assertInstanceOf(User::class, $thread->user);
    }

    public function testThreadHasChannel()
    {
        $thread = create(Thread::class);

        $this->assertInstanceOf(Channel::class, $thread->channel);
    }

    public function testThreadHaveReply()
    {
        $thread = Thread::factory()->create();
        $reply = Reply::factory()->create(['thread_id' => $thread->id]);

        //reply exists in a thread's reply collection
        $this->assertTrue($thread->replies->contains($reply));
    }
}
