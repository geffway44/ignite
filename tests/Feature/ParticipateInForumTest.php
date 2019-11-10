<?php

namespace Tests\Feature;

use App\User;
use App\Reply;
use App\Thread;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    /** @test **/
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $user = create(User::class);
        $this->signIn($user);

        $thread = create(Thread::class);

        $reply = create(Reply::class, [
            'user_id' => $user->id, 'thread_id' => $thread->id,
        ]);

        $this->post($thread->path(), $reply->toArray());

        $this->assertDatabaseHas('replies', ['body' => strip_tags($reply->body)]);
    }

    /** @test **/
    public function a_reply_requires_body()
    {
        $this->signIn();

        $thread = create(Thread::class);
        $reply = make(Reply::class, ['body' => null]);

        $this->post($thread->path(), $reply->toArray())
             ->assertSessionHasErrors('body');
    }

    /** @test */
    public function unauthorized_users_cannot_delete_replies()
    {
        $this->signIn();

        $reply = create(Reply::class, ['user_id' => auth()->id()]);

        $this->delete("/replies/{$reply->id}/destroy")
             ->assertStatus(200);

        $reply2 = create(Reply::class, ['user_id' => auth()->id()]);

        auth()->logout();

        $this->signIn()
             ->delete("/replies/{$reply2->id}/destroy")
             ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_delete_replies()
    {
        $this->signIn();

        $reply = create(Reply::class, ['user_id' => auth()->id()]);

        $this->delete("/replies/{$reply->id}/destroy")->assertStatus(200);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);

        $this->assertEquals(0, $reply->thread->fresh()->replies_count);
    }

    /** @test */
    public function unauthorized_users_cannot_update_replies()
    {
        $john = create(User::class, ['name' => 'John']);
        $jane = create(User::class, ['name' => 'Jane']);

        $this->signIn($john);

        $reply = create(Reply::class, ['user_id' => $john->id]);

        $updatedReply = ['body' => 'Content update'];

        $this->put("/replies/{$reply->id}/update", $updatedReply)
             ->assertStatus(200);

        auth()->logout();

        $this->signIn($jane);

        $this->put("/replies/{$reply->id}/update", $updatedReply)
             ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_update_replies()
    {
        $john = create(User::class);
        $this->signIn($john);

        $reply = create(Reply::class, ['user_id' => $john->id]);

        $update = 'You been changed, fool.';
        $this->put("/replies/{$reply->id}/update", ['body' => $update]);

        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => $update]);
    }

    /** @test */
    public function replies_that_contain_spam_may_not_be_created()
    {
        $this->signIn();

        $thread = create(Thread::class);
        $reply = make(Reply::class, [
            'body' => 'Yahoo Customer Support',
        ]);

        $this->json('post', $thread->path(), $reply->toArray())
            ->assertStatus(422);
    }

    /** @test */
    public function users_may_only_reply_a_maximum_of_once_per_minute()
    {
        $this->signIn();

        $thread = create(Thread::class);
        $reply = make(Reply::class, ['user_id' => auth()->id()]);

        $this->post($thread->path(), $reply->toArray())
             ->assertStatus(201);

        $this->post($thread->path(), $reply->toArray())
             ->assertStatus(429);
    }
}
