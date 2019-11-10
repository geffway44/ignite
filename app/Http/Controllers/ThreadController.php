<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use App\Trending;
use Illuminate\Http\Request;
use App\Filters\ThreadFilters;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\PostThreadRequest;
use App\Http\Requests\UpdateThreadRequest;
use App\Http\Controllers\Traits\Filterable;

class ThreadController extends Controller
{
    use Filterable;

    /**
     * Display a listing of the resource.
     *
     * @param \App\Channel               $channel
     * @param \App\Filters\ThreadFilters $fileter
     * @param \App\Trending              $trending
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, ThreadFilters $filters, Trending $trending)
    {
        $threads = $this->getThreads($channel, $filters);

        if (request()->wantsJson()) {
            return $threads;
        }

        return view('threads.index', [
            'threads' => $threads,
            'trending' => $trending->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create', ['channels' => Channel::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostThreadRequest $request)
    {
        $thread = Thread::create($request->only(Thread::getFields()));

        if (request()->wantsJson()) {
            return response($thread, 201);
        }

        return redirect($thread->path())
            ->with('flash', 'Your thread has been published.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Channel  $channel
     * @param \App\Thread   $thread
     * @param \App\Trending $trending
     *
     * @return \Illuminate\Http\Response
     */
    public function show($channel, Thread $thread, Trending $trending)
    {
        auth()->user()->read($thread);

        Trending::push($thread);

        $thread->increment('visits');

        return view('threads.show', [
            'thread' => $thread,
            'trending' => $trending->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateThreadRequest $request
     * @param \App\Channel                           $channel
     * @param \App\Thread                            $thread
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateThreadRequest $request, $channel, Thread $thread)
    {
        $thread->update($request->only(Thread::getFields()));

        return redirect($thread->path())
            ->with('flash', 'Thread has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Channel $channel
     * @param \App\Thread  $thread
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel, Thread $thread)
    {
        $this->authorize('delete', $thread);

        $thread->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect(route('threads.index'))
            ->with('flash', 'Thread has been deleted.');
    }
}
