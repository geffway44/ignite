<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserAccountRequest;

class AccountController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('view', $user);

        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateUserAccountRequest $request
     * @param \App\User                                   $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserAccountRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->update($request->only(['name', 'username', 'email']));

        return back()->with('flash', 'Account details updated.');
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

        $user->delete();

        return auth()->logout();
    }
}
