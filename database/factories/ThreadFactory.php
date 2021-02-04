<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThreadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thread::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence();

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $this->faker->paragraph,
            'user_id' => create(User::class)->id,
            'channel_id' => create(Channel::class)->id,
            'replies_count' => 0,
            'visits' => 0,
            'locked' => false,
            'pinned' => false,
        ];
    }
}
