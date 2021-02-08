<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use App\Http\Requests\ReplyRequest;
use App\Http\Responses\ReplyResponse;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ReplyRequest $request
     * @param \App\Models\Thread              $thread
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(ReplyRequest $request, Thread $thread): Response
    {
        $reply = $thread->addReply($request->validated());

        return ReplyResponse::dispatch(compact('reply'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Thread       $thread
     * @param \App\Models\Reply        $reply
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(ReplyRequest $request, Thread $thread, Reply $reply): Response
    {
        $reply->update($request->validated());

        // $thread->user->notify();

        return ReplyResponse::dispatch(compact('reply'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Thread $thread
     * @param \App\Models\Reply  $reply
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Thread $thread, Reply $reply): Response
    {
        $reply->delete();

        return ReplyResponse::dispatch(compact('thread'));
    }
}
