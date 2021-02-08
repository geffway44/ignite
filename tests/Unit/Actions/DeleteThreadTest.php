<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Thread;
use App\Actions\Threads\DeleteThread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteThreadTest extends TestCase
{
    use RefreshDatabase;

    public function testCanDeleteGivenThread()
    {
        $thread = create(Thread::class);

        $this->assertCount(1, Thread::all());

        $deleter = $this->app->make(DeleteThread::class);
        $deleter->delete($thread);

        $this->assertCount(0, Thread::all());
    }
}
