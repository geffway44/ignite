<?php

namespace Tests\Feature\Thread;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UpdateThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function testAuthorizedUserUpdateThread()
    {
        $this->actingAs(User::factory()->create());
        $thread = Thread::factory()->create(['user_id' => Auth::id()]);
        $thread->title = "Updated Thread Title";
        $this->put('/threads/'.$thread->id, $thread->toArray());
        $this->assertDatabaseHas('threads', ['id'=> $thread->id , 'title' => 'Updated Thread Title']);
    }

//    todo
//need to restrict this using a policy
//    public function testUnAuthorizedUserUpdateThread()
//    {
//        //Sign in a user
//        $this->actingAs(User::factory()->create());
//
//        //create a thread with another user
//        $thread = Thread::factory()->create();
//
//        $thread->title = "Updated Thread Title";
//
//        $response =   $this->put('/threads/'.$thread->id, $thread->toArray());
//
//        //Expect a 403 error
//        $response->assertStatus(403);
//    }
}
