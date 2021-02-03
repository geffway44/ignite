<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Actions\Threads\CreateNewThread;
use App\Providers\Traits\RegisterActions;
use App\Contracts\Actions\CreatesNewThreads;

class AppServiceProvider extends ServiceProvider
{
    use RegisterActions;

    /**
     * All action classes.
     *
     * @var array
     */
    protected $actions = [
        CreatesNewThreads::class => CreateNewThread::class,
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
