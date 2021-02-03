<?php

namespace App\Contracts\Actions;

use App\Models\Thread;

interface DeletesThreads
{
    /**
     * Preform certain action using the gievn data.
     *
     * @param \App\Models\Threads $thread
     *
     * @return void
     */
    public function delete(Thread $thread): void;
}
