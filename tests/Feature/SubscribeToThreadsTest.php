<?php

namespace Tests\Feature;

use App\Thread;
use Tests\TestCase;

class SubscribeToThreadsTest extends TestCase
{
    /** @test */
    public function a_user_can_subscribe_to_threads()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $this->post($thread->path() . '/subscribe');

        $this->assertCount(1, $thread->fresh()->subscriptions);
    }

    /** @test */
    public function a_user_can_unsubscribe_from_threads()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $thread->subscribe();

        $this->delete($thread->path() . '/unsubscribe');

        $this->assertCount(0, $thread->subscriptions);
    }
}
