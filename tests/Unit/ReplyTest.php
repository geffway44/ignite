<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->reply = create(Reply::class);
    }

    public function testReplyHasBody()
    {
        $this->assertNotNull($this->reply->body);
    }

    public function testReplyHasUser()
    {
        $this->assertInstanceOf(User::class, $this->reply->user);
    }
}
