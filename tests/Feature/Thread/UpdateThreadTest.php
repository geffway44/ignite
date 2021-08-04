<?php

namespace Tests\Feature\Thread;

use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UpdateThreadTest extends TestCase
{
    use RefreshDatabase;

    public function testThreadUpdateURL()
    {
        $this->signIn();

        $response = $this->get('threads/edit');

        $response->assertStatus(200);
    }

    public function testAuthorizedUserUpdateThread()
    {
        $this->signIn();

        $thread = Thread::factory()->create(['user_id' => Auth::id()]);

        $thread->title = "Updated Thread Title";

        $this->put('/threads/'.$thread->id, $thread->toArray());

        $this->assertDatabaseHas('threads', ['id'=> $thread->id , 'title' => 'Updated Thread Title']);
    }

    public function testUnAuthorizedUserUpdateThread()
    {
        //Sign in a user
        $this->signIn();

        //create a thread with another user
        $thread = Thread::factory()->create();

        $thread->title = "Updated Thread Title";

        $response =   $this->put('/threads/'.$thread->id, $thread->toArray());

        //Expect a 403 error
        $response->assertStatus(403);
    }
}
