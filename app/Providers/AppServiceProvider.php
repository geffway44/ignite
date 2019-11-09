<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->registerMarkdownParser();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Validator::extend('spamfree', 'App\Rules\SpamFree@passes');
    }

    /**
     * Register markdown parser into the service container.
     */
    protected function registerMarkdownParser()
    {
        $this->app->singleton('markdown', function () {
            $parsedown = new \Parsedown();

            $parsedown->setSafeMode(true);

            $parsedown->setMarkupEscaped(true);

            return $parsedown;
        });
    }
}
