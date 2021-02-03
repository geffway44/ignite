<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thread extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'body',
        'user_id',
        'channel_id',
        'replies_count',
        'visits',
        'locked',
        'pinned',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'locked' => 'boolean',
        'pinned' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['path'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the user the thread belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the channel the thread belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Get all replies that belong to the thread.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Create new reply for this thread.
     *
     * @param array $data
     *
     * @return \App\Models\Reply
     */
    public function addReply(array $data): Reply
    {
        $reply = $this->replies()->create(array_merge($data, [
            'user_id' => $data['user_id'] ?? auth()->id(),
        ]));

        $this->increment('replies_count');

        return $reply;
    }

    /**
     * Get full URL to thread.
     *
     * @return string
     */
    public function getPathAttribute(): string
    {
        return route('threads.show', [
            'channel' => $this->channel->slug,
            'thread' => $this->slug,
        ], true);
    }
}
