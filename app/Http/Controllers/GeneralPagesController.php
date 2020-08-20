<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Filters\ThreadFilters;

class GeneralPagesController extends Controller
{
    use Concerns\GetsThreads;

    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Channel        $chhanel
     * @param \App\Filters\ThreadFilters $filters
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, ThreadFilters $filters)
    {
        $threads = $this->getThreads($channel, $filters);

        if (request()->wantsJson()) {
            return $threads;
        }

        return view('threads.index', [
            'threads' => $threads,
            'channel' => $channel,
        ]);
    }
}
