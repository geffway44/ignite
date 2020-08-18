<?php

namespace App\Models;

use App\Favoritable;
use App\Models\Traits\Recordable;
use App\Models\Traits\Presentable;
use App\Contracts\Models\Redirectable;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model implements Redirectable
{
    use Recordable;
    use Favoritable;
    use Presentable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['user', 'favorites'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'favoritesCount',
        'isFavorited',
        'isBest',
        'xp',
        'path',
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
     * Get the user the thread belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class, 'thread_id');
    }

    /**
     * Determine the path to the reply.
     *
     * @return string
     */
    public function path(): string
    {
        $perPage = config('defaults.pagination.perPage');

        $replyPosition = $this->thread->replies()->pluck('id')->search($this->id) + 1;

        $page = ceil($replyPosition / $perPage);

        return $this->thread->path() . "?page={$page}#reply-{$this->id}";
    }

    /**
     * Fetch the path to the thread as a property.
     */
    public function getPathAttribute()
    {
        return $this->path();
    }

    /**
     * Access the body attribute.
     *
     * @param string $body
     *
     * @return string
     */
    public function getBodyAttribute($body)
    {
        return Purify::clean($body);
    }

    /**
     * Set the body attribute.
     *
     * @param string $body
     */
    public function setBodyAttribute($body)
    {
        $this->attributes['body'] = preg_replace(
            '/@([\w\-]+)/',
            '<a href="/profiles/$1">$0</a>',
            $body
        );
    }

    /**
     * Determine if the current reply is marked as the best.
     *
     * @return bool
     */
    public function isBest(): bool
    {
        return $this->thread->best_reply_id == $this->id;
    }

    /**
     * Determine if the current reply is marked as the best.
     *
     * @return bool
     */
    public function getIsBestAttribute()
    {
        return $this->isBest();
    }

    /**
     * Calculate the correct XP amount earned for the current reply.
     */
    public function getXpAttribute()
    {
        $xp = config('defaults.reputation.reply_posted');

        if ($this->isBest()) {
            $xp += config('defaults.reputation.best_reply_awarded');
        }

        return $xp += $this->favorites()->count() * config('defaults.reputation.reply_favorited');
    }
}
