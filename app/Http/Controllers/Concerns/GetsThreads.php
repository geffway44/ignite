<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Thread;
use Illuminate\Database\Eloquent\Collection;

trait GetsThreads
{
    /**
     * Get relevant thread collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getThreads(): Collection
    {
        return Thread::latest()->with('user', 'channel', 'replies')->get();
    }
}
