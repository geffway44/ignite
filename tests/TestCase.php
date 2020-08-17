<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;
use App\Models\Ability;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    use WithFaker;

    /**
     * Instance of fake user.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * Mock authenticated user.
     *
     * @param \App\Models\User $user
     *
     * @return \App\Models\User
     */
    protected function signIn($user = null): User
    {
        $this->user = $user ?: create(User::class);

        $this->assignRolesAndAbilities()
            ->actingAs($this->user);

        return $this->user;
    }

    /**
     * Create and assign customer role.
     *
     * @return \Tests\TestCase
     */
    protected function assignRolesAndAbilities()
    {
        $customerRole = Role::firstOrCreate([
            'title' => 'customer',
            'label' => 'Customer',
        ]);

        $purchaseSpace = Ability::firstOrCreate([
            'title' => 'purchase_spaces',
            'label' => 'Purchase spaces',
        ]);

        $customerRole->allowTo($purchaseSpace);

        $this->user->assignRole($customerRole);

        return $this;
    }
}
