<?php

namespace App\Filters;

use App\Models\User;
use Illuminate\Http\Request;

class ThreadFilters extends Filter
{
    /**
     * @var string[]
     */
    protected $filters = ['by'];

    /**
     * @param $username
     *
     * @return mixed
     */
    protected function by($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }
}
