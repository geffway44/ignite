<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Ability;
use App\Models\Account;
use Illuminate\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    /**
     * Instance of default user.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createDefaultUser()->assignRolesAndAbilities();
    }

    /**
     * Create default user account.
     *
     * @return \DefaultUserSeeder
     */
    protected function createDefaultUser()
    {
        $this->user = User::create(config('defaults.user'));

        return $this;
    }

    /**
     * Assign administrator role and associated abilities to default user.
     *
     * @return \DefaultUserSeeder
     */
    protected function assignRolesAndAbilities()
    {
        [$admin, $doAll] = $this->findOrCreateRoleAndAbility();

        $admin->allowTo($doAll);

        $this->user->assignRole($admin);

        return $this;
    }

    /**
     * Determine if required roles and abilities exist, create them otherwise.
     *
     * @return array
     */
    protected function findOrCreateRoleAndAbility(): array
    {
        $admin = Role::firstOrCreate([
            'title' => 'admin',
            'label' => 'Administrator',
        ]);

        $toDoAll = Ability::firstOrCreate([
            'title' => 'all',
            'label' => 'All abilities',
        ]);

        return [$admin, $toDoAll];
    }
}
