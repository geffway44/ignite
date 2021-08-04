<?php

namespace Tests\Feature\Reply;

use App\Models\Reply;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CreateReplyTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthenticatedUsersCanReplyToThread()
    {
        $this->signIn();

        $reply = Reply::factory()->make();

        $this->post('/replies', $reply->toArray());

        $this->assertDatabaseHas('replies', ['thread_id'=> $reply->thread_id]);
    }

    public function testUnauthenticatedUsersCannotReplyToThread()
    {
        $this->signIn();

        $reply = Reply::factory()->make();

        Auth::logout();

        $this->post('/replies', $reply->toArray())
            ->assertRedirect('/login');
    }
}
