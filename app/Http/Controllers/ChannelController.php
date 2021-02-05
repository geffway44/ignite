<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Channel;
use App\Http\Requests\ChannelRequest;
use App\Http\Responses\ChannelResponse;
use Inertia\Response as InertiaResponse;
use Illuminate\Contracts\Support\Responsable;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): InertiaResponse
    {
        return Inertia::render('Channel/Index', [
            'channels' => Channel::with('threads')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ChannelRequest $request
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function store(ChannelRequest $request): Responsable
    {
        $channel = Channel::create($request->validated());

        return $this->app(ChannelResponse::class, compact('channel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ChannelRequest $request
     * @param \App\Models\Channel               $channel
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function update(ChannelRequest $request, Channel $channel): Responsable
    {
        $channel->update($request->validated());

        return $this->app(ChannelResponse::class, compact('channel'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Channel $channel
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function destroy(Channel $channel): Responsable
    {
        $channel->delete();

        return $this->app(ChannelResponse::class);
    }
}
