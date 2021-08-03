<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function browse_a_thread()
    {
        $response = $this->get('/threads');

        $response->assertStatus(200);
    }
}
