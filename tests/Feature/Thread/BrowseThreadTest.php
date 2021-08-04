<?php

namespace Tests\Feature\Thread;

use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BrowseThreadTest extends TestCase
{
    use RefreshDatabase;

    public function testBrowseAllThreads()
    {
        $this->signIn();

        $threads = Thread::factory()->count(10)->create();

        $response = $this->get('/threads');

        $response->assertStatus(200); // assert response is successful

        $response->assertJson(fn (AssertableJson $json) => $json->has(10)); // assert response content has 10 items in it.

        $content = $response->getContent(); // get the response content

        $threads->each(function ($thread) use ($content) {
            // assert each thread is in the response content
            $this->assertStringContainsString($thread->title, $content);
        });
    }

    public function testBrowseAThread()
    {
        $this->signIn();

        $thread = Thread::factory()->create();

        $response = $this->get($thread->path);

        $response->assertStatus(200); // assert response is successful

        $content = $response->getContent(); // get the response content

        $this->assertStringContainsString($thread->title, $content);
    }

    public function testThreadsCanBeFilteredByChannel()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $channel = create(Channel::class);
        $channelThreads = create(Thread::class, ['channel_id' => $channel->id], null, 10);
        $nonChannelThreads = create(Thread::class, [], null, 10);

        $response = $this->get($channel->slug . '/threads');

        $response->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) => $json->has(10));

        $content = $response->getContent();

        $channelThreads->each(function ($thread) use ($content) {
            $this->assertStringContainsString($thread->title, $content);
        });

        $nonChannelThreads->each(function ($thread) use ($content) {
            $this->assertStringNotContainsString($thread->title, $content);
        });
    }
}
