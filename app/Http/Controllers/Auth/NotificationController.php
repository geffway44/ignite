<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * Fetch all unread notifications for the user.
     *
     * @return mixed
     */
    public function index()
    {
        return auth()->user()->unreadNotifications;
    }

    /**
     * Mark a specific notification as read.
     *
     * @param \App\User $user
     * @param int       $notificationId
     */
    public function destroy($user, $notificationId)
    {
        auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();
    }
}
