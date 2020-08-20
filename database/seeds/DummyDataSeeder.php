<?php

use App\Models\Reply;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = create(Channel::class, [], 10);

        // $threads = create(Thread::class, ['channel_id' => rand(1, 10)], 10);

        // foreach ($threads as $thread) {
        //     create(Reply::class, ['thread_id' => $thread->id], 2);
        // }
    }
}
