<?php

namespace Tests\Feature\Channel;

use App\Models\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateChannelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->channel = make(Channel::class);
    }

    public function testAdminsCanCreateChannels()
    {
        $this->signIn();

        $this->post('/threads/channels', $this->channel->toArray());
        
        $this->assertDatabaseHas('channels', ['name'=> $this->channel->name]);
    }
}
