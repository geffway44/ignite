<?php

namespace App\Http\Controllers\Auth;

use App\Activity;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user, 'activities' => Activity::feed($user),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User                $app
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserProfileRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->profile->update($request->only(Profile::getFields()));

        return back()->with('flash', 'Profile details updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $app
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        return view('users.destroy', ['user' => $user]);
    }
}
