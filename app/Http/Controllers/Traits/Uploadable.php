<?php

namespace Http\Controllers\Traits;

use Illuminate\Http\Request;

trait Uploadable
{
    /**
     * Save user avatar image.
     *
     * @param Illuminate\Http\Request $request
     * @param string                  $name
     *
     * @return string
     */
    public function saveAvatar(Request $request, $name)
    {
        return $request->file($name)->store(config('ignite.avatars'), 'public');
    }
}
