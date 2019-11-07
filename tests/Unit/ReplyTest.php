<?php

namespace Tests\Unit;

use App\User;
use App\Reply;
use Tests\TestCase;
use Illuminate\Support\Carbon;

class ReplyTest extends TestCase
{
    /** @test **/
    public function it_has_an_owner()
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
    public function it_can_detect_all_mentioned_users_in_the_body()
    {
        $reply = new Reply([
            'body' => '@JaneDoe wants to talk to @JohnDoe',
        ]);

        $this->assertEquals(['JaneDoe', 'JohnDoe'], $reply->mentionedUsers());
    }

    /** @test */
    public function it_wraps_mentioned_usernames_in_the_body_within_anchor_tags()
    {
        $reply = new Reply([
            'body' => 'Hello @Jane-Doe.',
        ]);

        $this->assertEquals(
            '<p>Hello <a href="/user/@Jane-Doe">@Jane-Doe</a>.</p>',
            $reply->body
        );
    }
}
