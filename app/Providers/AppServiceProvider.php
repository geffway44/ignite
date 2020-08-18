<?php

namespace App\Providers;

use App\Models\Reply;
use App\Models\Thread;
use App\Observers\ReplyObserver;
use App\Observers\ThreadObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All observers to be booted on application boot.
     *
     * @var array
     */
    protected static $observers = [
        Thread::class => ThreadObserver::class,
        Reply::class => ReplyObserver::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useTailwind();

        Validator::extend('spamfree', 'App\Rules\SpamFree@passes');
    }

    /**
     * Boot all registered observers.
     *
     * @return void
     */
    protected function bootObservers(): void
    {
        foreach (static::$observers as $model => $observer) {
            $model::observe($observer);
        }
    }
}
