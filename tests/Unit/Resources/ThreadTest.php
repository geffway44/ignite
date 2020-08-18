<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Support\Collection;

class ThreadTest extends TestCase
{
    /** @test */
    public function it_belongs_to_a_user()
    {
        $thread = create(Thread::class);

        $this->assertInstanceOf(User::class, $thread->user);
    }

    /** @test */
    public function it_belongs_to_a_channel()
    {
        $thread = create(Thread::class);

        $this->assertInstanceOf(Channel::class, $thread->channel);
    }

    /** @test */
    public function it_has_replies()
    {
        $thread = create(Thread::class);
        $replies = create(Reply::class, ['thread_id' => $thread->id]);

        $this->assertInstanceOf(Collection::class, $thread->replies);
        $this->assertInstanceOf(Reply::class, $thread->replies->first());
    }

    /** @test */
    public function a_thread_has_a_path()
    {
        $thread = create(Thread::class);

        $this->assertEquals(
            "http://localhost/threads/{$thread->channel->slug}/{$thread->slug}",
            $thread->path()
        );
    }

    /** @test */
    public function a_thread_can_have_a_best_reply()
    {
        $thread = create(Thread::class);
        $reply = $thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1,
        ]);

        $thread->markBestReply($reply);

        $this->assertEquals($reply->id, $thread->bestReply->id);
    }
}
