<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Thread;
use App\Models\Channel;
use App\Queries\ThreadQuery;
use App\Filters\ThreadFilter;
use App\Http\Requests\ThreadRequest;
use App\Actions\Threads\DeleteThread;
use App\Actions\Threads\UpdateThread;
use App\Http\Responses\ThreadResponse;
use App\Actions\Threads\CreateNewThread;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Channel       $channel
     * @param \App\Queries\ThreadQuery  $query
     * @param \App\Filters\ThreadFilter $filters
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, ThreadQuery $query, ThreadFilter $filters)
    {
        return Inertia::render('Threads/Index', [
            'thread' => $query->make($channel, $filters)->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Thread $thread
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Channel $channel)
    {
        return Inertia::render('Threads/Create', compact('channel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ThreadRequest     $request
     * @param \App\Models\Channel                  $channel
     * @param \App\Actions\Threads\CreateNewThread $creator
     *
     * @return \Illuminate\Http\Response
     */
    public function store(
        ThreadRequest $request,
        Channel $channel,
        CreateNewThread $creator
    ) {
        $thread = $creator->create(
            $request->validated(), ['channel' => $channel]
        );

        return ThreadResponse::dispatch($thread->fresh());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Channel $channel
     * @param \App\Models\Thread  $thread
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel, Thread $thread)
    {
        return Inertia::render('Threads/Show', [
            'thread' => $thread->load('replies'),
            'related' => $channel->threads(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Channel $channel
     * @param \App\Models\Thread  $thread
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel, Thread $thread)
    {
        return Inertia::render('Threads/Edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ThreadRequest  $request
     * @param \App\Models\Channel               $channel
     * @param \App\Models\Thread                $thread
     * @param \App\Actions\Threads\UpdateThread $updater
     *
     * @return \Illuminate\Http\Response
     */
    public function update(
        ThreadRequest $request,
        Channel $channel,
        Thread $thread,
        UpdateThread $updater
    ) {
        $updater->update($thread, $request->validated());

        return ThreadResponse::dispatch($thread->fresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Channel               $channel
     * @param \App\Models\Thread                $thread
     * @param \App\Actions\Threads\DeleteThread $deleter
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel, Thread $thread, DeleteThread $deleter)
    {
        $deleter->delete($thread);

        return ThreadResponse::dispatch($channel);
    }
}
