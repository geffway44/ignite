<?php

namespace Tests\Feature\Reply;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CreateReplyTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthenticatedUsersCanReplyToThread()
    {
        $this->signIn();

        $thread = Thread::factory()->create();

        $reply = Reply::factory()->make(['thread_id' => $thread->id, 'user_id' => Auth::id()]);

        $this->post('/replies', $reply->toArray());

        $this->assertDatabaseHas('replies', ['thread_id'=> $thread->id]);
    }

    public function testUnauthenticatedUsersCannotReplyToThread()
    {
        $this->signIn();

        $thread = Thread::factory()->create();

        $reply = Reply::factory()->make(['thread_id' => $thread->id, 'user_id' => Auth::id()]);

        Auth::logout();

        $this->post('/replies', $reply->toArray())
            ->assertRedirect('/login');
    }
}
