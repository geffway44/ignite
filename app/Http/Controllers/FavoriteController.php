<?php

namespace App\Http\Controllers;

use App\Reply;

class FavoriteController extends Controller
{
    /**
     * Favorite the specified reply.
     *
     * @param \App\Reply $reply
     *
     * @return \Illuminate\Http\Response
     */
    public function favorite(Reply $reply)
    {
        $reply->favorite();

        return back();
    }

    /**
     * Unfavorite the specified reply.
     *
     * @param \App\Reply $reply
     *
     * @return \Illuminate\Http\Response
     */
    public function unfavorite(Reply $reply)
    {
        $reply->unfavorite();

        return back();
    }
}
