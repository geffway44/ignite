<?php

namespace App\Providers;

use App\Actions\Citadel\DeleteUser;
use App\Actions\Citadel\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use App\Actions\Citadel\AuthenticateUser;
use App\Providers\Traits\RegisterActions;
use App\Actions\Citadel\ResetUserPassword;
use App\Actions\Citadel\UpdateUserProfile;
use App\Actions\Citadel\UpdateUserPassword;
use Cratespace\Citadel\Contracts\Actions\DeletesUsers;
use Cratespace\Citadel\Contracts\Actions\CreatesNewUsers;
use Cratespace\Citadel\Contracts\Auth\AuthenticatesUsers;
use Cratespace\Citadel\Contracts\Actions\ResetsUserPasswords;
use Cratespace\Citadel\Contracts\Actions\UpdatesUserProfiles;
use Cratespace\Citadel\Contracts\Actions\UpdatesUserPasswords;

class CitadelServiceProvider extends ServiceProvider
{
    use RegisterActions;

    /**
     * The citadel action classes.
     *
     * @var array
     */
    protected $actions = [
        AuthenticatesUsers::class => AuthenticateUser::class,
        CreatesNewUsers::class => CreateNewUser::class,
        ResetsUserPasswords::class => ResetUserPassword::class,
        UpdatesUserPasswords::class => UpdateUserPassword::class,
        UpdatesUserProfiles::class => UpdateUserProfile::class,
        DeletesUsers::class => DeleteUser::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerActions();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
