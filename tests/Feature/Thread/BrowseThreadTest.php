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
}
