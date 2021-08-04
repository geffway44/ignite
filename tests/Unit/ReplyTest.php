<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    public function testReplyRequiresBody()
    {
        $this->signIn();

        $thread = Thread::factory()->create();

        $reply = Reply::factory()->make(['body' => null, 'thread_id' => $thread->id, 'user_id' => Auth::id()]);

        $this->post('replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }

    public function testThreadRequiresUser()
    {
        $this->signIn();

        $thread = Thread::factory()->create();

        $reply = Reply::factory()->make(['thread_id' => $thread->id, 'user_id' => null]);

        $this->post('replies', $reply->toArray())
            ->assertSessionHasErrors('user_id');
    }
}
