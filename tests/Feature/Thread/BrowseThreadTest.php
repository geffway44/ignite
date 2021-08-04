<?php

namespace Tests\Feature\Thread;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BrowseThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function testBrowseAllThreads()
    {
        $this->actingAs(User::factory()->create());
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
        $this->actingAs(User::factory()->create());

        $thread = Thread::factory()->create();

        $response = $this->get('/thread/'.$thread->id);

        $response->assertStatus(200); // assert response is successful

        $content = $response->getContent(); // get the response content

        $this->assertStringContainsString($thread->title, $content);
    }
}
