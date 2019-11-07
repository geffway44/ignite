<?php

namespace Tests\Unit;

use App\User;
use App\Reply;
use App\Thread;
use App\Channel;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class ThreadTest extends TestCase
{
    /** @test **/
    public function it_has_replies()
    {
        $thread = create(Thread::class);
        create(Reply::class, ['thread_id' => $thread->id]);

        $this->assertInstanceOf(Collection::class, $thread->replies);
    }

    /** @test **/
    public function it_has_an_owner()
    {
        $thread = create(Thread::class);

        $this->assertInstanceOf(User::class, $thread->user);
    }

    /** @test **/
    public function it_belongs_to_a_channel()
    {
        $thread = create(Thread::class);

        $this->assertInstanceOf(Channel::class, $thread->channel);
    }

    /** @test */
    public function it_can_add_a_reply()
    {
        $thread = create(Thread::class);

        $thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1,
        ]);

        $this->assertCount(1, $thread->replies);
    }

    /** @test **/
    public function it_can_make_a_string_path()
    {
        $thread = create(Thread::class);

        $this->assertSame(route('threads.show', [
            'channel' => $thread->channel->slug,
            'thread' => $thread->slug,
        ]), $thread->path());
    }

    /** @test */
    public function a_thread_can_be_subscribed_to()
    {
        $thread = create(Thread::class);

        $this->signIn();

        $thread->subscribe($userId = auth()->id());

        $this->assertEquals(1, $thread->subscriptions()->where('user_id', $userId)->get()->count());
    }

    /** @test */
    public function a_thread_can_be_unsubscribed_from()
    {
        $thread = create(Thread::class);

        $this->signIn();

        $thread->subscribe($userId = auth()->id());

        $thread->unsubscribe($userId);
        $this->assertCount(0, $thread->subscriptions);
    }

    /** @test */
    public function is_knows_if_the_authenticated_user_is_subscribed_to_it()
    {
        $thread = create(Thread::class);

        $this->signIn();

        $this->assertFalse($thread->isSubscribedTo);

        $thread->subscribe();

        $this->assertTrue($thread->isSubscribedTo);
    }

    /** @test */
    public function a_thread_can_check_if_the_authenticated_user_has_read_all_replies()
    {
        $this->signIn();

        $thread = create(Thread::class);

        tap(auth()->user(), function ($user) use ($thread) {
            $this->assertTrue($thread->hasUpdatesFor($user));

            $user->read($thread);

            $this->assertFalse($thread->hasUpdatesFor($user));
        });
    }
}
