<?php

namespace Tests\Feature\Replies;

use Tests\TestCase;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteReplyTest extends TestCase
{
    use RefreshDatabase;

    public function testAReplyCanBeDeletedFromAThread()
    {
        $this->withoutExceptionHandling();

        $thread = create(Thread::class);
        $reply = create(Reply::class, ['thread_id' => $thread->id]);

        $response = $this->signIn($reply->user)->delete(route('replies.destroy', [
            'thread' => $thread, 'reply' => $reply,
        ]), ['body' => 'updated reply body']);

        $response->assertStatus(303)->assertRedirect($thread->path);
    }

    public function testAReplyCanBeDeletedFromAThreadThroughJsonRequest()
    {
        $this->withoutExceptionHandling();

        $thread = create(Thread::class);
        $reply = create(Reply::class, ['thread_id' => $thread->id]);

        $response = $this->signIn($reply->user)->deleteJson(route('replies.destroy', [
            'thread' => $thread, 'reply' => $reply,
        ]), ['body' => 'updated reply body']);

        $response->assertStatus(204);
    }
}
