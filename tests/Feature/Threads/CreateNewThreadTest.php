<?php

namespace Tests\Feature\Threads;

use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Cratespace\Preflight\Testing\Contracts\Postable;

class CreateNewThreadTest extends TestCase implements Postable
{
    use RefreshDatabase;

    public function testNewThreadCanBeCreated()
    {
        $channel = create(Channel::class);

        $response = $this->signIn(create(User::class))->post(
            route('threads.index', $channel),
            $this->validParameters()
        );

        $response->assertStatus(303);
        $this->assertCount(1, Thread::all());
    }

    public function testNewThreadCanBeCreatedThroughJsonRequest()
    {
        $channel = create(Channel::class);

        $response = $this->signIn(create(User::class))->postJson(
            route('threads.index', $channel),
            $this->validParameters()
        );

        $response->assertStatus(201);
        $this->assertCount(1, Thread::all());
    }

    public function testThreadRequiresValidTitle()
    {
        $channel = create(Channel::class);

        $response = $this->signIn(create(User::class))->post(
            route('threads.index', $channel),
            $this->validParameters(['title' => ''])
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title']);
        $this->assertCount(0, Thread::all());

        $response = $this->signIn(create(User::class))->postJson(
            route('threads.index', $channel),
            $this->validParameters(['title' => ''])
        );

        $response->assertStatus(422);
        $this->assertCount(0, Thread::all());
    }

    public function testThreadRequiresValidBody()
    {
        $channel = create(Channel::class);

        $response = $this->signIn(create(User::class))->post(
            route('threads.index', $channel),
            $this->validParameters(['body' => ''])
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['body']);
        $this->assertCount(0, Thread::all());

        $response = $this->signIn(create(User::class))->postJson(
            route('threads.index', $channel),
            $this->validParameters(['body' => ''])
        );

        $response->assertStatus(422);
        $this->assertCount(0, Thread::all());
    }

    public function testThreadRequiresValidChannelId()
    {
        $channel = create(Channel::class);

        $response = $this->signIn(create(User::class))->post(
            route('threads.index', $channel),
            [
                'title' => $this->faker->unique()->sentence(),
                'body' => $this->faker->paragraph,
                'channel' => '',
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['channel_id']);
        $this->assertCount(0, Thread::all());

        $response = $this->signIn(create(User::class))->postJson(
            route('threads.index', $channel),
            [
                'title' => $this->faker->unique()->sentence(),
                'body' => $this->faker->paragraph,
                'channel' => '',
            ]
        );

        $response->assertStatus(422);
        $this->assertCount(0, Thread::all());
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
