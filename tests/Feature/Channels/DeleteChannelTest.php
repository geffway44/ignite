<?php

namespace Tests\Feature\Channels;

use Tests\TestCase;
use App\Models\User;
use App\Models\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteChannelTest extends TestCase
{
    use RefreshDatabase;

    public function testChannelCanBeDeleted()
    {
        $this->withoutExceptionHandling();

        $this->signIn(create(User::class));

        $channel = create(Channel::class);
        $this->assertCount(1, Channel::all());

        $response = $this->delete(route('channels.update', $channel));

        $response->assertStatus(303);
        $this->assertCount(0, Channel::all());
    }

    public function testChannelCanBeDeletedThroughtJsonRequest()
    {
        $this->signIn(create(User::class));

        $channel = create(Channel::class);
        $this->assertCount(1, Channel::all());

        $response = $this->deleteJson(route('channels.update', $channel));

        $response->assertStatus(204);
        $this->assertCount(0, Channel::all());
    }
}
