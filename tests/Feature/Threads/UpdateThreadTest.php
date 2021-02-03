<?php

namespace Tests\Feature\Threads;

use Tests\TestCase;
use App\Models\Thread;
use Illuminate\Testing\TestResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Cratespace\Preflight\Testing\Contracts\Postable;

class UpdateThreadTest extends TestCase implements Postable
{
    use RefreshDatabase;

    public function testThreadInformationCanBeUpdated()
    {
        $this->withoutExceptionHandling();

        $thread = create(Thread::class);

        $response = $this->updateThread($thread);

        $response->assertStatus(303);
    }

    public function testThreadInformationCanBeUpdatedThroughJsonRequest()
    {
        $this->withoutExceptionHandling();

        $thread = create(Thread::class);

        $response = $this->updateThread($thread, [], true);

        $response->assertStatus(200);
    }

    public function testAValidTitleIsRequired()
    {
        $thread = create(Thread::class);

        $response = $this->updateThread($thread, [
            'title' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title']);
    }

    public function testAValidBodyIsRequired()
    {
        $thread = create(Thread::class);

        $response = $this->updateThread($thread, [
            'body' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['body']);
    }

    /**
     * Send update request with given thread.
     *
     * @param \App\Models\Thread $thread
     * @param array              $overrides
     * @param bool|null          $json
     *
     * @return \Illuminate\Testing\TestResponse
     */
    protected function updateThread(Thread $thread, array $overrides = [], ?bool $json = null): TestResponse
    {
        $this->signIn($thread->user);

        if ($json) {
            return $this->putJson(
                route('threads.update', ['channel' => $thread->channel, 'thread' => $thread]),
                $this->validParameters($overrides)
            );
        }

        return $this->put(
            route('threads.update', ['channel' => $thread->channel, 'thread' => $thread]),
            $this->validParameters($overrides)
        );
    }

    /**
     * Provide only the necessary paramertes for a POST-able type request.
     *
     * @param array $overrides
     *
     * @return array
     */
    public function validParameters(array $overrides = []): array
    {
        return make(Thread::class, $overrides)->toArray();
    }
}
