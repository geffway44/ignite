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

        $reply = Reply::factory()->make(['body' => null]);

        $this->post('replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }

    public function testReplyRequiresUser()
    {
        $this->signIn();

        $reply = Reply::factory()->make(['user_id' => null]);

        $this->post('replies', $reply->toArray())
            ->assertSessionHasErrors('user_id');
    }

    public function testReplyRequiresThread()
    {
        $this->signIn();

        $reply = Reply::factory()->make(['thread_id' => null]);

        $this->post('replies', $reply->toArray())
            ->assertSessionHasErrors('thread_id');
    }
}
