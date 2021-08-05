<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * @param Thread $thread
     */
    public function likeThread(Thread $thread)
    {
        if (!$thread->likes()->where('user_id', Auth::user()->id)->exists()) {
            $thread->likes()->create(['user_id' => Auth::user()->id]);
        }
    }

    /**
     * @param Reply $reply
     */
    public function likeReply(Reply $reply)
    {
        if (!$reply->likes()->where('user_id', Auth::user()->id)->exists()) {
            $reply->likes()->create(['user_id' => Auth::user()->id]);
        }
    }
}
