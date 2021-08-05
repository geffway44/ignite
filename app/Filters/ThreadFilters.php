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
     * @var
     */
    protected $builder;

    /**
     * @var string[]
     */
    protected $filters = ['by'];

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
        $this->builder = $builder;
        foreach ($this->filters as $filter) {
            if ($this->hasFilter($filter)) {
                $this->$filter($this->request->$filter);
            }
        }

        return $this->builder;
    }

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

    /**
     * @param string $filter
     *
     * @return bool
     */
    protected function hasFilter(string $filter): bool
    {
        return method_exists($this, $filter) && $this->request->has($filter);
    }
}
