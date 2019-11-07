<?php

namespace Tests\Feature;

use App\User;
use App\Profile;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /** @test **/
    public function a_user_has_a_profile()
    {
        $user = create(User::class);
        create(Profile::class, ['user_id' => $user->id]);

        $this->assertInstanceOf(Profile::class, $user->profile);
    }

    /** @test **/
    public function a_user_can_view_his_profile()
    {
        $user = create(User::class, ['username' => 'JohnDoe']);
        create(Profile::class, ['user_id' => $user->id]);
        $this->signIn($user);

        $response = $this->get('/user/JohnDoe')->assertSee('JohnDoe');
        $this->assertEquals($user->id, $user->profile->user_id);
    }
}
