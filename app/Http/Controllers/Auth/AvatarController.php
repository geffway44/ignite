<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Http\Controllers\Traits\Uploadable;
use App\Http\Requests\UploadAvatarRequest;

class AvatarController extends Controller
{
    use Uploadable;

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\UploadAvatarRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UploadAvatarRequest $request, User $user)
    {
        $user->profile->update([
            'avatar' => $this->saveAvatar($request 'avatar')
        ]);

        return response(['message' => 'Avatar saved.'], 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user->avatar = null;

        return response(['message' => 'Avatar deleted.'], 204);
    }
}
