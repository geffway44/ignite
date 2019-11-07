<?php

namespace Tests\Feature;

use App\User;
use App\Reply;
use App\Thread;
use App\Channel;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    /** @test **/
    public function a_guest_user_cannot_see_threads()
    {
        $response = $this->get('/threads');

        $response->assertStatus(302);
    }

    /** @test **/
    public function a_user_can_browse_threads()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $response = $this->get('/threads');

        $response->assertStatus(200);
        $response->assertSee($thread->title);
    }

    /** @test **/
    public function a_user_can_read_a_single_thread()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $response = $this->get($thread->path());

        $response->assertStatus(200);
        $response->assertSee($thread->title);
    }

    /** @test **/
    public function a_user_can_filter_threads_by_channel()
    {
        $this->signIn();

        $channel = create(Channel::class);
        $threadInChannel = create(Thread::class, ['channel_id' => $channel->id]);
        $threadNotInChannel = create(Thread::class);

        $this->get('/threads/' . $channel->slug)
             ->assertSee($threadInChannel->title)
             ->assertDontSee($threadNotInChannel->title);
    }

    /** @test **/
    public function a_user_can_filter_threads_by_username()
    {
        $this->signIn(create(User::class, ['username' => 'JohnDoe']));

        $johnsThread = create(Thread::class, ['user_id' => auth()->id()]);
        $janesThread = create(Thread::class);

        $this->get('threads?by=JohnDoe')
             ->assertSee($johnsThread->title)
             ->assertDontSee($janesThread->title);
    }

    /** @test **/
    public function a_user_can_filter_threads_by_popularity()
    {
        $this->signIn();

        $threadWithTwoReplies = create(Thread::class);
        create(Reply::class, ['thread_id' => $threadWithTwoReplies->id], 2);

        $threadWithThreeReplies = create(Thread::class);
        create(Reply::class, ['thread_id' => $threadWithThreeReplies->id], 3);

        $threadWithNoReplies = create(Thread::class);

        $response = $this->getJson('threads?popular=1')->json();

        $this->assertEquals([3, 2, 0], array_column($response['data'], 'replies_count'));
    }

    /** @test **/
    public function a_user_can_filter_threads_by_those_that_are_unanswered()
    {
        $this->signIn();

        $threadWithReplies = create(Thread::class);
        create(Reply::class, ['thread_id' => $threadWithReplies->id]);

        $threadWithNoReplies = create(Thread::class);

        $response = $this->getJson('threads?unanswered=1')->json();

        $this->assertCount(1, $response['data']);
    }

    /** @test */
    public function a_user_can_request_all_replies_to_a_given_thread()
    {
        $this->signIn();

        $thread = create(Thread::class);
        create(Reply::class, ['thread_id' => $thread->id], 2);

        $response = $this->getJson($thread->path() . '/replies')->json();

        $this->assertCount(2, $response['data']);
        $this->assertEquals(2, $response['total']);
    }
}
