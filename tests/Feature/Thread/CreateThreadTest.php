<?php

namespace Tests\Feature\Thread;

use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateThreadTest extends TestCase
{
    use RefreshDatabase;

    public function testThreadCreateURL()
    {
        $this->signIn();
        $response = $this->get('threads/create');
        $response->assertStatus(200);
    }

    public function testAuthenticatedUsersCanCreateNewThread()
    {
        //creates an user and authenticate
        $this->signIn();
        //create thread object
        $thread= Thread::factory()->make();
        //submitting created object to thread creation endpoint
        $this->post('/threads', $thread->toArray());
        //check if it stored in db
        $this->assertEquals(1, Thread::all()->count());
    }

    public function testUnauthenticatedUsersCannotCreateThread()
    {
        $thread= Thread::factory()->make();
        $this->post('/threads', $thread->toArray())
            ->assertRedirect('/login');
    }
}
