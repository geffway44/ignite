<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Http\Requests\PostReplyRequest;
use App\Http\Requests\UpdateReplyRequest;
use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Channel
     * @param \App\Thread
     *
     * @return \Illuminate\Http\Response
     */
    public function index($channel, Thread $thread)
    {
        return $thread->replies()->paginate(config('ignite.pagination'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Channel $channel
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostReplyRequest $request, $channel, Thread $thread)
    {
        return $thread->addReply($request->only('body', 'user_id'))->load('user');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReplyRequest $request, Reply $reply)
    {
        $reply->update($request->only('body'));

        return response(['status' => 'Reply updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);

        $reply->delete();

        return response(['status' => 'Reply deleted']);
    }
}
