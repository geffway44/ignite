<?php

namespace Tests\Feature\Reply;

use App\Models\Reply;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CreateReplyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->reply = make(Reply::class);
    }

    public function testAuthenticatedUsersCanReplyToThread()
    {
        $this->signIn();

        $this->post('/threads/replies', $this->reply->toArray());

        $this->assertDatabaseHas('replies', ['thread_id'=> $this->reply->thread_id]);
    }

    public function testUnauthenticatedUsersCannotReplyToThread()
    {
        $this->post('/threads/replies', $this->reply->toArray())
            ->assertRedirect('/login');
    }
}
