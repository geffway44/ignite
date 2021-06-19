<?php

namespace App\Queries;

use App\Models\Channel;
use App\Filters\ThreadFilter;
use Emberfuse\Blaze\Queries\Query;
use Illuminate\Database\Eloquent\Builder;

class ThreadQuery extends Query
{
    /**
     * Instance of model being queried.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = Thread::class;

    /**
     * Get a customized query of the threads for the user.
     *
     * @param \App\Models\Channel       $channel
     * @param \App\Filters\ThreadFilter $filters
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function make(Channel $channel, ThreadFilter $filters): Builder
    {
        return $channel->threads()->filter($filters);
    }
}
