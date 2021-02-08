<?php

namespace App\Jobs;

use Throwable;
use App\Models\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Contracts\Actions\DeletesChannels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteChannelJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Instance of channel being deleted.
     *
     * @var \App\Models\Channel
     */
    protected $channel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DeletesChannels $deleter)
    {
        try {
            $deleter->delete($this->channel);
        } catch (Throwable $e) {
            logger()->error($e->getMessage(), ['channel' => $this->channel]);

            throw $e;
        }
    }

    /**
     * Get instance of channel being deleted.
     *
     * @return \App\Models\Channel
     */
    public function getChannel(): Channel
    {
        return $this->channel;
    }
}
