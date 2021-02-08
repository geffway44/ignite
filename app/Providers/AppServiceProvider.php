<?php

namespace App\Providers;

use App\Actions\Threads\DeleteThread;
use App\Actions\Channels\DeleteChannel;
use Illuminate\Support\ServiceProvider;
use App\Actions\Threads\CreateNewThread;
use App\Contracts\Actions\DeletesThreads;
use App\Contracts\Actions\DeletesChannels;
use App\Contracts\Actions\CreatesNewThreads;
use Cratespace\Sentinel\Providers\Traits\HasActions;

class AppServiceProvider extends ServiceProvider
{
    use HasActions;

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
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerActions();
    }
}
