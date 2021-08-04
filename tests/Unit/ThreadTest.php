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

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = create(Thread::class);
    }

    public function testThreadHasUser()
    {
        $this->assertInstanceOf(User::class, $this->thread->user);
    }

    public function testThreadHasChannel()
    {
        $this->assertInstanceOf(Channel::class, $this->thread->channel);
    }

    public function testThreadHaveReply()
    {
        $reply = Reply::factory()->create(['thread_id' => $this->thread->id]);

        //reply exists in a thread's reply collection
        $this->assertTrue($this->thread->replies->contains($reply));
    }

    public function testThreadHasTitle()
    {
        $this->assertNotNull($this->thread->title);
    }

    public function testThreadHasBody()
    {
        $this->assertNotNull($this->thread->body);
    }
}
