<?php

namespace App\Providers;

use App\Channel;
use App\Trending;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->shareThreadChannels();
        $this->shareTrendingThreads();
    }

    /**
     * Share thread channels as global collection.
     */
    protected function shareThreadChannels()
    {
        $channels = [];

        if (Schema::hasTable('channels')) {
            $channels = Cache::rememberForever('channels', function () {
                return Channel::all();
            });
        }

        View::share('channels', $channels);
    }

    /**
     * Share trending threads as global collection.
     */
    protected function shareTrendingThreads()
    {
        $trending = [];

        if (Schema::hasTable('threads')) {
            $trending = Trending::get();
        }

        View::share('trending', $trending);
    }
}
