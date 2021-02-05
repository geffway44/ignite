<?php

namespace Database\Seeders;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

class DummyDataSeeder extends Seeder
{
    use WithFaker;

    /**
     * Number of resources to create.
     *
     * @var int
     */
    protected $count = 5;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        create(Channel::class, [], $this->count)
            ->each(function ($channel) {
                create(Thread::class, [
                    'channel_id' => $channel->id,
                ], $this->count)->each(function ($thread) {
                    create(Reply::class, [
                        'thread_id' => $thread->id,
                    ], $this->count);
                });
            });
    }
}
