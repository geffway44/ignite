<?php

namespace Tests\Feature\Replies;

use Tests\TestCase;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateNewReplyTest extends TestCase
{
    use RefreshDatabase;

    public function testNewReplyCanBeAddedToThread()
    {
        $this->withoutExceptionHandling();

        $thread = create(Thread::class);

        $response = $this->signIn($thread->user)
            ->post(route('replies.store', [
                'thread' => $thread,
            ]), ['body' => $this->faker->paragraph()]);

        $response->assertStatus(303);
        $this->assertCount(1, Reply::all());
        $this->assertEquals(1, $thread->refresh()->replies_count);
    }

    public function testNewReplyCanBeAddedToThreadThroughtJsonRequest()
    {
        $this->withoutExceptionHandling();

        $thread = create(Thread::class);

        $response = $this->signIn($thread->user)
            ->postJson(route('replies.store', [
                'thread' => $thread,
            ]), ['body' => $this->faker->paragraph()]);

        $response->assertStatus(201);
        $this->assertCount(1, Reply::all());
        $this->assertEquals(1, $thread->refresh()->replies_count);
    }
}
