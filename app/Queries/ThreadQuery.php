<?php

namespace App\Queries;

use Emberfuse\Blaze\Queries\Query;
use Illuminate\Database\Eloquent\Model;

class ThreadQuery extends Query
{
    /**
     * Instance of model being queried.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = Model::class;
}
