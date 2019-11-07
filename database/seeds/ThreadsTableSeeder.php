<?php

use App\Reply;
use App\Thread;
use Illuminate\Database\Seeder;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(Thread::class, 7)->create()->each(function ($thread) {
            factory(Reply::class, 7)->create(['thread_id' => $thread->id]);
        });
    }
}
