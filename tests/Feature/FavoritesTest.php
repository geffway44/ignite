<?php

namespace Tests\Feature;

use App\Reply;
use Exception;
use App\Thread;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    /** @test **/
    public function an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();

        $thread = create(Thread::class);
        $reply = create(Reply::class, ['thread_id' => $thread->id]);

        $response = $this->post('/replies/' . $reply->id . '/favorite');

        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function an_authenticated_user_can_unfavorite_a_reply()
    {
        $this->signIn();

        $reply = create(Reply::class);

        $reply->favorite();

        $this->delete('replies/' . $reply->id . '/unfavorite');

        $this->assertCount(0, $reply->favorites);
    }

    /** @test */
    public function an_authenticated_user_may_only_favorite_a_reply_once()
    {
        $this->signIn();

        $reply = create(Reply::class);

        try {
            $this->post('replies/' . $reply->id . '/favorite');
            $this->post('replies/' . $reply->id . '/favorite');
        } catch (Exception $e) {
            $this->fail('Did not expect to insert the same record set twice.');
        }

        $this->assertCount(1, $reply->favorites);
    }
}
