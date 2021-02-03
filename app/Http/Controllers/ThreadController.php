<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Http\Requests\ThreadRequest;
use App\Http\Responses\ThreadResponse;
use App\Contracts\Actions\CreatesNewThreads;
use Illuminate\Contracts\Support\Responsable;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     * @param \App\Models\Thread $thread
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ThreadRequest $request
     * @param \App\Models\Thread               $thread
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function update(ThreadRequest $request, Thread $thread): Responsable
    {
        $thread->update($request->validated());

        return $this->app(ThreadResponse::class, compact('thread'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Thread $thread
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function destroy(Thread $thread): Responsable
    {
        $this->authorize('manage', $thread);

        $thread->delete();

        return $this->app(ThreadResponse::class);
    }
}
