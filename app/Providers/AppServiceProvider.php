<?php

namespace App\Providers;

use App\Actions\DeleteChannel;
use App\Actions\Threads\DeleteThread;
use Illuminate\Support\ServiceProvider;
use App\Actions\Threads\CreateNewThread;
use App\Contracts\Actions\DeletesThreads;
use App\Providers\Traits\RegisterActions;
use App\Contracts\Actions\DeletesChannels;
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
        DeletesThreads::class => DeleteThread::class,
        DeletesChannels::class => DeleteChannel::class,
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
