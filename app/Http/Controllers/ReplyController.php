<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use App\Http\Requests\ReplyRequest;

class ReplyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ReplyRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ReplyRequest $request, Thread $thread)
    {
        $reply = $thread->addReply(
            $request->merge(['user_id' => user('id')])->except('_token')
        );

        if ($request->wantsJson()) {
            return response($reply, 200);
        }

        return redirect()->to($thread->path());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ReplyRequest $request
     * @param \App\Models\Thread              $thread
     * @param \App\Models\Reply               $reply
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ReplyRequest $request, Thread $thread, Reply $reply)
    {
        $reply->update($request->validated());

        if ($request->wantsJson()) {
            return response($reply->refresh(), 200);
        }

        return redirect()->to($thread->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Reply $reply
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread, Reply $reply)
    {
        $reply->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect()->back();
    }
}
