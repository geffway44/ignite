<?php

use App\User;
use App\Profile;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(User::class, 50)->create()->each(function ($user) {
            factory(Profile::class)->create(['user_id' => $user->id]);
        });
    }
}
