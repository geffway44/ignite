<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThreadRequest;
use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Thread::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->response('Thread Creation');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ThreadRequest $request)
    {
        Thread::create( $request->all());
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
        return $thread;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Thread $thread
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        $this->response('Thread Edit View');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Thread       $thread
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ThreadRequest $request, Thread $thread)
    {
        $this->authorize('update', $thread);
        $thread->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Thread $thread
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();
    }
}
