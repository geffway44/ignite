<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    public function testAReplyHasABody()
    {
        $reply = create(Reply::class);

        $this->assertNotNull($reply->body);
    }

    public function testAReplyBelongsToAThread()
    {
        $reply = create(Reply::class);

        $this->assertInstanceOf(Thread::class, $reply->thread);
    }

    public function testAReplyBelongsToAUser()
    {
        $reply = create(Reply::class);

        $this->assertInstanceOf(User::class, $reply->user);
    }
}
