<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use App\Models\Thread;
use App\Models\Trending;

class TrendingTest extends TestCase
{
    protected $trending;

    public function setUp(): void
    {
        parent::setUp();

        $this->trending = new Trending();
        $this->trending->reset();
    }

    /** @test */
    public function it_increments_the_score_each_time_a_thread_is_pushed()
    {
        $thread = create(Thread::class);

        $this->assertEquals(0, $this->trending->score($thread));

        $this->trending->push($thread);

        $this->assertEquals(1, $this->trending->score($thread));
    }

    /** @test */
    public function it_returns_the_top_5_threads()
    {
        $thread1 = create(Thread::class);
        $thread2 = create(Thread::class);
        $thread3 = create(Thread::class);
        $thread4 = create(Thread::class);
        $thread5 = create(Thread::class);
        $thread6 = create(Thread::class);

        $this->trending->push($thread1, 1);
        $this->trending->push($thread2, 2);
        $this->trending->push($thread3, 3);
        $this->trending->push($thread4, 4);
        $this->trending->push($thread5, 5);
        $this->trending->push($thread6, 6);

        tap($this->trending->get(), function ($trending) use ($thread1, $thread2, $thread3, $thread4, $thread5, $thread6) {
            $this->assertCount(5, $trending);
            $this->assertEquals($thread6->path(), $trending[0]->path);
            $this->assertEquals($thread5->path(), $trending[1]->path);
            $this->assertEquals($thread4->path(), $trending[2]->path);
            $this->assertEquals($thread3->path(), $trending[3]->path);
            $this->assertEquals($thread2->path(), $trending[4]->path);
        });
    }

    /** @test */
    public function it_returns_an_empty_list_when_there_are_no_trending_topics()
    {
        $this->assertCount(0, $this->trending->get());
    }
}
