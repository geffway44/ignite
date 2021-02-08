<?php

namespace App\Actions\Channels;

use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Support\Facades\DB;
use App\Contracts\Actions\DeletesChannels;

class DeleteChannel implements DeletesChannels
{
    /**
     * Preform certain action using the gievn data.
     *
     * @param \App\Models\Channel $channel
     *
     * @return void
     */
    public function delete(Channel $channel): void
    {
        DB::transaction(function () use ($channel) {
            $this->deleteChannelDiscussions($channel);

            $channel->delete();
        });
    }

    /**
     * Delete all threads and replies.
     *
     * @param \App\Models\Channel $channel
     *
     * @return void
     */
    protected function deleteChannelDiscussions(Channel $channel): void
    {
        tap($channel, function (Channel $channel) {
            $channel->threads->each(function (Thread $thread) {
                $thread->replies->each->delete();

                $thread->delete();
            });
        });
    }
}
