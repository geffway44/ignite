<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use App\Models\Thread;
use App\Models\Channel;
use PHPUnit\Framework\Assert;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class ChannelTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        EloquentCollection::macro('assertEquals', function ($items) {
            Assert::assertEquals(count($this), count($items));

            $this->zip($items)->each(function ($pair) {
                [$actual, $expected] = $pair;

                Assert::assertTrue($actual->is($expected));
            });
        });
    }

    /** @test */
    public function a_channel_consists_of_threads()
    {
        $channel = create(Channel::class);
        $thread = create(Thread::class, ['channel_id' => $channel->id]);

        $this->assertTrue($channel->threads->contains($thread));
    }

    /** @test */
    public function a_channel_can_be_archived()
    {
        $channel = create(Channel::class);

        $this->assertFalse($channel->archived);

        $channel->archive();

        $this->assertTrue($channel->archived);
    }

    /** @test */
    public function archived_channels_are_excluded_by_default()
    {
        create(Channel::class);
        create(Channel::class, ['archived' => true]);

        $this->assertEquals(1, Channel::count());
    }

    /** @test */
    public function channels_are_sorted_alphabetically_by_default()
    {
        $php = create(Channel::class, ['name' => 'PHP']);
        $basic = create(Channel::class, ['name' => 'Basic']);
        $zsh = create(Channel::class, ['name' => 'Zsh']);

        Channel::all()->assertEquals([$basic, $php, $zsh]);
    }
}
