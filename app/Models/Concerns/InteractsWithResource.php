<?php

namespace App\Models\Concerns;

use Closure;

trait InteractsWithResource
{
    /**
     * Model can delete another resource.
     *
     * @param \Closure $callback
     *
     * @return void
     */
    public function deleteResource(Closure $callback): void
    {
        \call_user_func($callback, request());
    }
}
