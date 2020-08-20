<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Thread;
use App\Models\Channel;
use App\Filters\ThreadFilters;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

trait GetsThreads
{
    /**
     * Get relevant thread collection.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function getThreads(Channel $channel, ThreadFilters $filters): LengthAwarePaginator
    {
        $threads = Thread::latest('pinned')
            ->latest()
            ->with('channel', 'user')
            ->filter($filters);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        return $threads->paginate(config('defaults.pagination.perPage'));
    }
}
