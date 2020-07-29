<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Thread;

class ReadThreadsTest extends TestCase
{
    /** @test */
    public function only_authenticated_users_can_browse_threads()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $thread = create(Thread::class);

        $this->get('/threads')
            ->assertStatus(200)
            ->assertSee($thread->title);
    }
}
