<?php

namespace Tests\Feature\Replies;

use Tests\TestCase;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateReplyTest extends TestCase
{
    use RefreshDatabase;

    public function testAReplyCanBeUpdated()
    {
        $thread = create(Thread::class);
        $reply = create(Reply::class, ['thread_id' => $thread->id]);

        $response = $this->signIn($reply->user)->put(route('replies.update', [
            'thread' => $thread,
            'reply' => $reply,
        ]), ['body' => 'updated reply body.']);

        $response->assertStatus(303);
        $this->assertEquals($reply->refresh()->body, 'updated reply body.');
    }

    public function testAReplyCanBeUpdatedThroughJsonRequest()
    {
        $thread = create(Thread::class);
        $reply = create(Reply::class, ['thread_id' => $thread->id]);

        $response = $this->signIn($reply->user)->putJson(route('replies.update', [
            'thread' => $thread,
            'reply' => $reply,
        ]), ['body' => 'updated reply body.']);

        $response->assertStatus(200);
        $this->assertEquals($reply->refresh()->body, 'updated reply body.');
    }

    public function testAValidBodyIsRequired()
    {
        $thread = create(Thread::class);
        $reply = create(Reply::class, ['thread_id' => $thread->id]);

        $response = $this->signIn($reply->user)->put(route('replies.update', [
            'thread' => $thread,
            'reply' => $reply,
        ]), ['body' => '']);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['body']);
    }
}
