<?php

namespace Tests\Feature\Thread;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DeleteThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function testAuthorizedUserDeleteThread()
    {
        $this->actingAs(User::factory()->create());

        $thread =  Thread::factory()->create(['user_id' => Auth::id()]);

        $this->delete('/threads/'.$thread->id);

        $this->assertDatabaseMissing('threads', ['id'=> $thread->id]);
    }

    public function testUnauthorizedUserCannotDeleteThread()
    {
        $this->actingAs(User::factory()->create());
    
        $thread =  Thread::factory()->create();

        $response = $this->delete('/threads/'.$thread->id);
     
        $response->assertStatus(403);
    }
}
