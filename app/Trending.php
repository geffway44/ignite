<?php

namespace App;

use Illuminate\Support\Facades\Redis;

class Trending
{
    /**
     * Fetch all trending threads.
     *
     * @return array
     */
    public static function get()
    {
        return array_map(
            'json_decode',
            Redis::zrevrange(static::cacheKey(), 0, 4)
        );
    }

    /**
     * Push a new thread to the trending list.
     *
     * @param Thread $thread
     */
    public static function push($thread)
    {
        Redis::zincrby(static::cacheKey(), 1, json_encode([
            'title' => $thread->title,
            'path' => $thread->path(),
        ]));
    }

    /**
     * Get the cache key name.
     *
     * @return string
     */
    public static function cacheKey()
    {
        return app()->environment('testing')
            ? 'testing_trending_threads'
            : 'trending_threads';
    }

    /**
     * Reset all trending threads.
     */
    public static function reset()
    {
        Redis::del(static::cacheKey());
    }
}
