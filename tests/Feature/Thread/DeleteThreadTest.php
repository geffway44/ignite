<?php

namespace Tests\Feature\Thread;

use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DeleteThreadTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthorizedUserDeleteThread()
    {
        $this->signIn();

        $thread =  Thread::factory()->create(['user_id' => Auth::id()]);

        $this->delete('/threads/'.$thread->id);

        $this->assertDatabaseMissing('threads', ['id'=> $thread->id]);
    }

    public function testUnauthorizedUserCannotDeleteThread()
    {
        $this->signIn();

        $thread =  Thread::factory()->create();

        $response = $this->delete('/threads/'.$thread->id);

        $response->assertStatus(403);
    }
}
