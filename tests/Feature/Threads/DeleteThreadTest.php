<?php

namespace Tests\Feature\Threads;

use Tests\TestCase;
use App\Models\Thread;
use Illuminate\Testing\TestResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteThreadTest extends TestCase
{
    use RefreshDatabase;

    public function testThreadCanBeDeleted()
    {
        $this->withoutExceptionHandling();

        $thread = create(Thread::class);
        $this->assertCount(1, Thread::all());

        $this->signIn($thread->user);

        $response = $response = $this->deleteThread($thread);

        $response->assertStatus(303);
        $this->assertCount(0, Thread::all());
    }

    public function testThreadCanBeDeletedByJsonRequest()
    {
        $this->withoutExceptionHandling();

        $thread = create(Thread::class);
        $this->assertCount(1, Thread::all());

        $this->signIn($thread->user);

        $response = $this->deleteThread($thread, true);

        $response->assertStatus(204);
        $this->assertCount(0, Thread::all());
    }

    /**
     * Send request to delete a given thread.
     *
     * @param \App\Models\Thread $thread
     * @param bool|null          $json
     *
     * @return \Illuminate\Testing\TestResponse
     */
    protected function deleteThread(Thread $thread, ?bool $json = false): TestResponse
    {
        $parameters = [
            'channel' => $thread->channel,
            'thread' => $thread,
        ];

        if (! $json) {
            return $this->delete(route('threads.destroy', $parameters));
        }

        return $this->deleteJson(route('threads.destroy', $parameters));
    }
}
