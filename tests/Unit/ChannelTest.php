<?php

namespace Tests\Unit;

use App\Models\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->channel = create(Channel::class);
    }

    public function testChannelHasName()
    {
        $this->assertNotNull($this->channel->name);
    }

    public function testChannelHasSlug()
    {
        $this->assertNotNull($this->channel->slug);
    }
}
