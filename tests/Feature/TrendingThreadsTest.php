<?php

namespace Tests\Feature;

use App\Thread;
use App\Trending;
use Tests\TestCase;

class TrendingThreadsTest extends TestCase
{
    protected static $trending;

    protected function setUp(): void
    {
        parent::setUp();

        static::$trending = new Trending();

        (static::$trending)::reset();
    }

    /** @test */
    public function it_increments_a_threads_score_each_time_it_is_read()
    {
        $this->assertEmpty((static::$trending)::get());

        $this->signIn();

        $thread = create(Thread::class);

        $this->call('GET', $thread->path());

        $this->assertCount(1, $trending = (static::$trending)::get());

        $this->assertEquals($thread->title, $trending[0]->title);
    }
}
