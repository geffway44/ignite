<?php

namespace Tests\Feature\Channels;

use Tests\TestCase;
use App\Models\User;
use App\Models\Channel;
use App\Jobs\DeleteChannelJob;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteChannelTest extends TestCase
{
    use RefreshDatabase;

    public function testChannelCanBeDeleted()
    {
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

    public function testJobIsDispatchedToDeleteChannel()
    {
        $this->withoutExceptionHandling();

        Queue::fake();

        $this->signIn(create(User::class));

        Queue::assertNothingPushed();

        $channel = create(Channel::class);
        $this->assertCount(1, Channel::all());

        $response = $this->delete(route('channels.update', $channel));

        Queue::assertPushed(function (DeleteChannelJob $job) use ($channel) {
            return $job->getChannel()->is($channel);
        });
    }
}
