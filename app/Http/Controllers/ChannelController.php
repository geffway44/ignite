<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Trending;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Trending $trending
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Trending $trending)
    {
        return view('threads.channels.index', [
            'channels' => Channel::all(),
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Channel $channel
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Channel $channel
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Channel             $channel
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Channel $channel
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
    }
}
