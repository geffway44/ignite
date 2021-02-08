<?php

namespace App\Contracts\Actions;

use App\Models\Channel;

interface DeletesChannels
{
    /**
     * Preform certain action using the gievn data.
     *
     * @param \App\Models\Channel $channel
     *
     * @return void
     */
    public function delete(Channel $channel): void;
}
