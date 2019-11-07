<?php

namespace Tests;

use App\User;
use App\Profile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;
    use RefreshDatabase;
    use WithFaker;

    /**
     * Mock authenticated user.
     *
     * @param \App\User $user
     *
     * @return \App\User
     */
    protected function signIn($user = null)
    {
        $user = $user ?: create(User::class);
        create(Profile::class, ['user_id' => $user->id]);

        $this->actingAs($user);

        return $this;
    }

    /**
     * Mock authenticated user with admin previlage.
     *
     * @param \App\User $user
     *
     * @return \App\User
     */
    protected function signInAdmin($admin = null)
    {
        $admin = $admin ?: create(User::class);

        config(['ignite.administrators' => [$admin->email]]);

        $this->actingAs($admin);

        return $this;
    }
}
