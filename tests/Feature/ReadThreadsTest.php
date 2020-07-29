<?php

namespace Tests\Feature;

use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    /** @test */
    public function only_authenticated_users_can_browse_threads()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $response = $this->get('/threads');

        $response->assertStatus(200);
    }
}
