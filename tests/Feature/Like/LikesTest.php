<?php

namespace Tests\Feature\Like;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LikesTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthenticatedUserLikesThread()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $this->get('/thread/'.$thread->id.'/likes');
        $this->get('/thread/'.$thread->id.'/likes');

        $this->assertCount(1, $thread->likes);
    }

    public function testAuthenticatedUserLikesReply()
    {
        $this->signIn();

        $reply = create(Reply::class);

        $this->get('/replies/'.$reply->id.'/likes');
        $this->get('/replies/'.$reply->id.'/likes');

        $this->assertCount(1, $reply->likes);
    }
}
