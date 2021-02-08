<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Channel;
use App\Jobs\DeleteChannelJob;
use App\Http\Requests\ChannelRequest;
use App\Http\Responses\ChannelResponse;
use Inertia\Response as InertiaResponse;
use Symfony\Component\HttpFoundation\Response;

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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(ChannelRequest $request): Response
    {
        $channel = Channel::create($request->validated());

        return ChannelResponse::dispatch($channel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ChannelRequest $request
     * @param \App\Models\Channel               $channel
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(ChannelRequest $request, Channel $channel): Response
    {
        $channel->update($request->validated());

        return ChannelResponse::dispatch($channel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Http\Requests\ChannelRequest $request
     * @param \App\Models\Channel               $channel
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy(ChannelRequest $request, Channel $channel): Response
    {
        $request->user()->deleteResource(
            fn ($request) => DeleteChannelJob::dispatch($channel)
        );

        return ChannelResponse::dispatch();
    }
}
