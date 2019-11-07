<?php

namespace Tests\Unit;

use App\Reply;
use App\Thread;
use App\Activity;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    /** @test */
    public function it_records_activity_when_a_thread_is_created()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $this->assertDatabaseHas('activities', [
            'type' => 'created_thread',
            'user_id' => auth()->id(),
            'subject_id' => $thread->id,
        ]);
    }

    /** @test */
    public function it_records_activity_when_a_reply_is_created()
    {
        $this->signIn();

        $thread = create(Thread::class);
        $reply = create(Reply::class, ['thread_id' => $thread]);

        $this->assertEquals(2, Activity::count());

        $this->assertDatabaseHas('activities', [
            'type' => 'created_reply',
            'user_id' => auth()->id(),
            'subject_id' => $reply->id,
        ]);
    }
}
