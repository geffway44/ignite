<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use App\Actions\Threads\CreateNewThread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateNewThreadTest extends TestCase
{
    use RefreshDatabase;

    public function testCanCreateThreadUsingGivenData()
    {
        $user = create(User::class);
        $creator = $this->app->make(CreateNewThread::class);
        $thread = $creator->create($user, make(Thread::class)->toArray());

        $this->assertInstanceOf(Thread::class, $thread);
        $this->assertCount(1, Thread::all());
        $this->assertTrue($user->is($thread->user));
    }
}
