<?php

namespace App\Models;

use App\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'body', 'user_id', 'channel_id',
    ];

    /**
     * Get the user the thread belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the channel the thread is associated with.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    /**
     * Get the channel the thread is associated with.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class, 'thread_id');
    }

    /**
     * Add new reply and associate it with the thread.
     *
     * @param array $data
     *
     * @return \App\Models\Reply
     */
    public function addReply(array $data): Reply
    {
        return $this->replies()->create($data);
    }

    /**
     * Get full URL of thread page.
     *
     * @return string
     */
    public function path(): string
    {
        return route('threads.show', $this);
    }
}
