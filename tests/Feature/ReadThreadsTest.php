<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Reply;
use App\Models\Thread;

class ReadThreadsTest extends TestCase
{
    /** @test */
    public function users_can_browse_threads()
    {
        $this->withoutExceptionHandling();

        $thread = create(Thread::class);

        $this->get('/')
            ->assertStatus(200)
            ->assertSee($thread->title);

        $this->get('/threads')
            ->assertStatus(200)
            ->assertSee($thread->title);
    }

    /** @test */
    public function users_can_view_single_thread()
    {
        $this->withoutExceptionHandling();

        $thread = create(Thread::class);

        $this->get($thread->path())
            ->assertStatus(200)
            ->assertSee($thread->title);
    }

    /** @test */
    public function users_can_view_replies_that_are_associated_with_the_thread()
    {
        $thread = create(Thread::class);
        $replyAssociatedWithThread = create(Reply::class, ['thread_id' => $thread->id]);
        $replyNotAssociatedWithThread = create(Reply::class);

        $this->get($thread->path())
            ->assertStatus(200)
            ->assertSee($replyAssociatedWithThread->body)
            ->assertDontSee($replyNotAssociatedWithThread->body);
    }
}
