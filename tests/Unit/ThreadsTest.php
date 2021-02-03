<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function testThreadHasATitle()
    {
        $thread = create(Thread::class);

        $this->assertNotNull($thread->title);
    }

    public function testThreadHasABody()
    {
        $thread = create(Thread::class);

        $this->assertNotNull($thread->body);
    }

    public function testThreadBelongsToUser()
    {
        $thread = create(Thread::class);

        $this->assertInstanceOf(User::class, $thread->user);
    }

    public function testThreadBelongsToChannel()
    {
        $thread = create(Thread::class);

        $this->assertInstanceOf(Channel::class, $thread->channel);
    }

    public function testThreadDefaultRepliesCountIsZero()
    {
        $thread = create(Thread::class);

        $this->assertEquals(0, $thread->replies_count);
    }

    public function testThreadDefaultVisitsCountIsZero()
    {
        $thread = create(Thread::class);

        $this->assertEquals(0, $thread->visits);
    }

    public function testThreadHasAPath()
    {
        $thread = create(Thread::class);

        $this->assertNotNull($thread->path);
        $this->assertTrue(Str::contains($thread->path, 'http'));
        $this->assertTrue(Str::contains($thread->path, $thread->slug));
        $this->assertTrue(Str::contains($thread->path, $thread->channel->slug));
    }

    public function testThreadCreatesSlugUsingTitle()
    {
        $thread = create(Thread::class, ['title' => 'My Super Awesome Thread']);

        $this->assertEquals('my-super-awesome-thread', $thread->slug);
    }

    public function testThreadCanDetermineLockedStatus()
    {
        $thread = create(Thread::class);

        $this->assertFalse($thread->locked);

        $thread->locked = true;
        $thread->save();

        $this->assertTrue($thread->locked);
    }

    public function testThreadCanDeterminePinnedStatus()
    {
        $thread = create(Thread::class);

        $this->assertFalse($thread->pinned);

        $thread->pinned = true;
        $thread->save();

        $this->assertTrue($thread->pinned);
    }
}
