<?php

namespace Tests\Feature\Channels;

use Tests\TestCase;
use App\Models\User;
use App\Models\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateChannelTest extends TestCase
{
    use RefreshDatabase;

    public function testChannelInformatoinCanBeUpdated()
    {
        $this->signIn(create(User::class));

        $channel = create(Channel::class);

        $response = $this->put(route('channels.update', $channel), [
            'name' => 'UpdatedName',
        ]);

        $response->assertStatus(303);
        $this->assertEquals('UpdatedName', $channel->refresh()->name);
    }

    public function testChannelInformatoinCanBeUpdatedThroughJsonRequest()
    {
        $this->signIn(create(User::class));

        $channel = create(Channel::class);

        $response = $this->putJson(route('channels.update', $channel), [
            'name' => 'UpdatedName',
        ]);

        $response->assertStatus(200);
        $this->assertEquals('UpdatedName', $channel->refresh()->name);
    }
}
