<?php

namespace App\Actions\Threads;

use App\Models\Thread;
use App\Contracts\Actions\DeletesThreads;

class DeleteThread implements DeletesThreads
{
    /**
     * Preform certain action using the gievn data.
     *
     * @param \App\Models\Threads $thread
     *
     * @return void
     */
    public function delete(Thread $thread): void
    {
        $thread->delete();
    }
}
