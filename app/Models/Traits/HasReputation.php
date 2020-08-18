<?php

namespace App\Models\Traits;

trait HasReputation
{
    /**
     * Award reputation points to the model.
     *
     * @param string $action
     *
     * @return void
     */
    public function gainReputation(string $action): void
    {
        $this->increment('reputation', config("defaults.reputation.{$action}"));
    }

    /**
     * Reduce reputation points for the model.
     *
     * @param string $action
     *
     * @return void
     */
    public function loseReputation(string $action): void
    {
        $this->decrement('reputation', config("defaults.reputation.{$action}"));
    }
}
