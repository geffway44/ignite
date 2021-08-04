<?php

namespace Tests\Unit;

use App\Models\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function checkChannelHasAName()
    {
        $channel = create(Channel::class);

        $this->assertNotNull($channel->name);
    }
}
