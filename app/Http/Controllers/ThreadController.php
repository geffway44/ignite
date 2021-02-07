<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Thread;
use App\Models\Channel;
use App\Http\Requests\ThreadRequest;
use App\Http\Responses\ThreadResponse;
use Inertia\Response as InertiaResponse;
use App\Contracts\Actions\DeletesThreads;
use App\Contracts\Actions\CreatesNewThreads;
use Illuminate\Contracts\Support\Responsable;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Channel $channel
     *
     * @return \Inertia\Response
     */
    public function index(Channel $channel): InertiaResponse
    {
        return Inertia::render('Threads/Index', [
            'threads' => $channel->viewableThreads(),
            'channel' => $channel,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Channel $channel
     *
     * @return \Inertia\Response
     */
    public function create(Channel $channel): InertiaResponse
    {
        return Inertia::render('Threads/Create', compact('channel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ThreadRequest $request
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function store(ThreadRequest $request, CreatesNewThreads $creator): Responsable
    {
        $thread = $creator->create($request->user(), $request->validated());

        return $this->app(ThreadResponse::class, compact('thread'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Channel $channel
     * @param \App\Models\Thread  $thread
     *
     * @return \Inertia\Response
     */
    public function show(Channel $channel, Thread $thread): InertiaResponse
    {
        return Inertia::render('Threads/Show', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ThreadRequest $request
     * @param \App\Models\Channel              $channel
     * @param \App\Models\Thread               $thread
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function update(ThreadRequest $request, Channel $channel, Thread $thread): Responsable
    {
        $thread->update($request->validated());

        return $this->app(ThreadResponse::class, compact('thread'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Http\Requests\ThreadRequest    $request
     * @param \App\Actions\Threads\DeletesThreads $deleter
     * @param \App\Models\Channel                 $chennel
     * @param \App\Models\Thread                  $thread
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function destroy(
        ThreadRequest $request,
        DeletesThreads $deleter,
        Channel $channel,
        Thread $thread
    ): Responsable {
        $deleter->delete($thread);

        // $request->user()->notify();

        return $this->app(ThreadResponse::class, compact('channel'));
    }
}
