<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\SaveAvatar;
use App\Http\Requests\UploadAvatarRequest;

class AvatarController extends Controller
{
    use SaveAvatar;

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\UploadAvatarRequest $reques
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(UploadAvatarRequest $request, User $user)
    {
        $user->profile->update([
            'avatar' => $this->save($request, 'avatar'),
        ]);

        return response(['message' => 'Avatar saved.'], 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->profile->avatar = null;

        return response(['message' => 'Avatar deleted.'], 204);
    }
}
