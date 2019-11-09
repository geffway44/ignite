<?php

namespace App\Http\Controllers\Traits;

use App\Thread;
use App\Channel;
use App\Filters\ThreadFilters;

trait Filterable
{
    /**
     * Fetch all relevant threads.
     *
     * @param \App\Channel               $channel
     * @param \App\Filters\ThreadFilters $filters
     *
     * @return mixed
     */
    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::latest('pinned')->latest()->with('channel')->filter($filters);

        if ($channel->exists) {
            $threads = $threads->where('channel_id', $channel->id);
        }

        return $threads->paginate(config('ignite.pagination'));
    }
}
