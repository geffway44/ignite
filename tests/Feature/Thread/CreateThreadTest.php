<?php

namespace Tests\Feature\Thread;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function testAuthenticatedUsersCanCreateNewThread()
    {
        //creates an user and authenticate
        $this->actingAs(User::factory()->create());
        //create thread object
        $thread= Thread::factory()->make();
        //submitting created object to thread creation endpoint
        $this->post('/threads/create',$thread->toArray());
        //check if it stored in db
        $this->assertEquals(1,Thread::all()->count());
    }

    public function testUnauthenticatedUsersCannotCreateThread()
    {
        $thread= Thread::factory()->make();
        $this->post('/threads/create',$thread->toArray())
            ->assertRedirect('/login');
    }
}
