<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

trait SaveAvatar
{
    /**
     * Upload and save user avatar image.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $name
     *
     * @return string
     */
    public function save($request, $name)
    {
        return $request->file($name)->store(config('ignite.avatars'), 'public');
    }
}
