<?php

namespace Tests\Unit\Resources;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;

class ReplyTest extends TestCase
{
    /** @test */
    public function it_has_an_user()
    {
        $reply = create(Reply::class);

        $this->assertInstanceOf(User::class, $reply->user);
    }

    /** @test */
    public function it_knows_if_it_was_just_published()
    {
        $reply = create(Reply::class);

        $this->assertTrue($reply->wasJustPublished());

        $reply->created_at = Carbon::now()->subMonth();

        $this->assertFalse($reply->wasJustPublished());
    }

    /** @test */
    public function it_wraps_mentioned_usernames_in_the_body_within_anchor_tags()
    {
        $reply = new Reply([
            'body' => 'Hello @Jane-Doe.',
        ]);

        $this->assertEquals(
            'Hello <a href="/users/Jane-Doe">@Jane-Doe</a>.',
            $reply->body
        );
    }

    /** @test */
    public function it_knows_if_it_is_the_best_reply()
    {
        $thread = create(Thread::class);
        $reply = create(Reply::class, ['thread_id' => $thread->id]);

        $this->assertFalse($reply->isBest());

        $thread->update(['best_reply_id' => $reply->id]);

        $this->assertTrue($reply->fresh()->isBest());
    }

    /** @test */
    public function a_reply_body_is_sanitized_automatically()
    {
        $reply = make(Reply::class, ['body' => '<script>alert("bad")</script><p>This is okay.</p>']);

        $this->assertEquals('<p>This is okay.</p>', $reply->body);
    }

    /** @test */
    public function a_reply_knows_the_total_xp_earned()
    {
        $this->signIn();

        $reply = create(Reply::class); // 2 points for creating the reply.

        $this->assertEquals(2, $reply->xp);

        $reply->thread->markBestReply($reply); // 50 points for best.

        $this->assertEquals(52, $reply->xp);

        // $this->post(route('replies.favorite', $reply)); // 5 points for favoriting.

        // $this->assertEquals(57, $reply->xp);
    }

    /** @test */
    public function it_generates_the_correct_path_for_a_paginated_thread()
    {
        $thread = create(Thread::class);

        $replies = create(Reply::class, ['thread_id' => $thread->id], 3);

        config(['defaults.pagination.perPage' => 1]);

        $this->assertEquals(
            $thread->path() . '?page=1#reply-1',
            $replies->first()->path()
        );

        $this->assertEquals(
            $thread->path() . '?page=2#reply-2',
            $replies[1]->path()
        );

        $this->assertEquals(
            $thread->path() . '?page=3#reply-3',
            $replies->last()->path()
        );
    }
}
