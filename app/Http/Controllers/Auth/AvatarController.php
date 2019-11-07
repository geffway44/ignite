<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadAvatarRequest;

class AvatarController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadAvatarRequest $request, User $user)
    {
        $user->profile->update([
            'avatar' => $request->file('avatar')->store('img/avatars', 'public'),
        ]);

        return response([], 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user->avatar = null;

        return response([], 204);
    }
}
