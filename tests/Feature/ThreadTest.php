<?php

namespace Tests\Feature;

use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ThreadTest extends TestCase
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
