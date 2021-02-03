<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelTest extends TestCase
{
    use RefreshDatabase;

    public function testChannelHasAName()
    {
        $channel = create(Channel::class);

        $this->assertNotNull($channel->name);
    }

    public function testChannelHasAnOptionalDescription()
    {
        $channel = create(Channel::class, ['description' => null]);

        $this->assertNull($channel->description);
    }

    public function testChannelCanGetViewableThreads()
    {
        $channel = create(Channel::class);
        $viewable = create(Thread::class, [
            'channel_id' => $channel->id,
        ], 10);
        $unViewable = create(Thread::class, [
            'locked' => true,
            'channel_id' => $channel->id,
        ], 10);

        $threads = $channel->viewableThreads();

        $this->assertInstanceOf(Collection::class, $threads);
        $threads->contains(function ($thread) use ($viewable) {
            $this->assertTrue($viewable->contains($thread));
        });
        $threads->contains(function ($thread) use ($unViewable) {
            $this->assertFalse($unViewable->contains($thread));
        });
    }
}
