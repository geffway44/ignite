<?php

namespace App\Filters;

use App\Models\User;
use Illuminate\Http\Request;

class ThreadFilters
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * ThreadFilters constructor.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $builder
     *
     * @return mixed
     */
    public function apply($builder)
    {
        if (! $username = $this->request->by) {
            return $builder;
        }

        $user = User::where('username', $username)->firstOrFail();

        return $builder->where('user_id', $user->id);
    }
}
