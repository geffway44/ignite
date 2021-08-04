<?php

namespace Tests\Unit;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

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
        $thread = create(Thread::class);
        $reply = Reply::factory()->create(['thread_id' => $thread->id]);

        //reply exists in a thread's reply collection
        $this->assertTrue($thread->replies->contains($reply));
    }

    public function testThreadRequiresTitle()
    {
        $this->signIn();

        $thread = Thread::factory()->make(['title' => null]);

        $this->post('threads', $thread->toArray())
                ->assertSessionHasErrors('title');
    }

    public function testThreadRequiresBody()
    {
        $this->signIn();

        $thread = Thread::factory()->make(['body' => null]);

        $this->post('threads', $thread->toArray())
                ->assertSessionHasErrors('body');
    }


}
