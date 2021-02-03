<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use App\Http\Requests\ReplyRequest;
use App\Http\Responses\ReplyResponse;
use Illuminate\Contracts\Support\Responsable;

class ReplyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ReplyRequest $request
     * @param \App\Models\Thread              $thread
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function store(ReplyRequest $request, Thread $thread): Responsable
    {
        $reply = $thread->addReply($request->validated());

        return $this->app(ReplyResponse::class, compact('reply'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Thread       $thread
     * @param \App\Models\Reply        $reply
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function update(ReplyRequest $request, Thread $thread, Reply $reply): Responsable
    {
        $reply->update($request->validated());

        // $thread->user->notify();

        return $this->app(ReplyResponse::class, compact('reply'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Thread $thread
     * @param \App\Models\Reply  $reply
     *
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function destroy(Thread $thread, Reply $reply): Responsable
    {
        $reply->delete();

        return $this->app(ReplyResponse::class, compact('thread'));
    }
}
