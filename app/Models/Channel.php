<?php

namespace App\Models;

use App\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use Sluggable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get all threads associated with the channel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function threads()
    {
        return $this->hasMany(Thread::class, 'channel_id');
    }
}
