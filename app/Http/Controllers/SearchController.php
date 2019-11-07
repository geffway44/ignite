<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Search threads with the given query.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Thread
     */
    public function search(Request $request)
    {
        return view('threads.index', [
            'threads' => Thread::search($request->q)->paginate(20),
        ]);
    }
}
