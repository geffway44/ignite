<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserPasswordRequest;

class PasswordController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateUserAccountRequest $request
     * @param \App\User                                   $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPasswordRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('flash', 'Password updated.');
    }
}
