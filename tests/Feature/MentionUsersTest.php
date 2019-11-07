<?php

namespace Tests\Feature;

use App\User;
use App\Reply;
use App\Thread;
use Tests\TestCase;

class MentionUsersTest extends TestCase
{
    /** @test */
    public function users_mentioned_in_a_reply_are_notified()
    {
        $john = create(User::class, ['username' => 'JohnDoe']);

        $this->signIn($john);

        $jane = create(User::class, ['username' => 'JaneDoe']);

        $thread = create(Thread::class);

        $reply = make(Reply::class, [
            'body' => 'Hey @JaneDoe check this out.',
        ]);

        $this->json('post', $thread->path(), $reply->toArray());

        $this->assertCount(1, $jane->notifications);
    }

    /** @test */
    public function it_can_fetch_all_mentioned_users_starting_with_the_given_characters()
    {
        create(User::class, ['username' => 'johndoe']);
        create(User::class, ['username' => 'johndoe2']);
        create(User::class, ['username' => 'janedoe']);

        $results = $this->json('GET', '/api/users', ['username' => 'john']);

        $this->assertCount(2, $results->json());
    }
}
