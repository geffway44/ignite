<?php

namespace App\Providers;

use App\User;
use App\Reply;
use App\Thread;
use App\Policies\UserPolicy;
use App\Policies\ReplyPolicy;
use App\Policies\ThreadPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Thread::class => ThreadPolicy::class,
        Reply::class => ReplyPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
