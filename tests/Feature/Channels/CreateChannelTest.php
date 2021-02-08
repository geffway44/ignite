<?php

namespace Tests\Feature\Channels;

use Tests\TestCase;
use App\Models\User;
use App\Models\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Cratespace\Preflight\Testing\Contracts\Postable;

class CreateChannelTest extends TestCase implements Postable
{
    use RefreshDatabase;

    public function testNewChannelCanBeCreated()
    {
        $response = $this->signIn(create(User::class))->post(
            route('channels.store'),
            $this->validParameters()
        );

        $response->assertStatus(303);
        $this->assertCount(1, Channel::all());
    }

    public function testNewChannelCanBeCreatedThroughJsonRequest()
    {
        $response = $this->signIn(create(User::class))->postJson(
            route('channels.store'),
            $this->validParameters()
        );

        $response->assertStatus(201);
        $this->assertCount(1, Channel::all());
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
        return array_merge([
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph(),
        ], $overrides);
    }
}
