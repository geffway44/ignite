<?php

namespace App\Models;

use App\Favoritable;
use App\Models\Traits\Sluggable;
use App\Models\Traits\Filterable;
use App\Models\Traits\Recordable;
use App\Models\Traits\Presentable;
use App\Contracts\Models\Redirectable;
use App\Events\ThreadReceivedNewReply;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model implements Redirectable
{
    use Sluggable;
    use Filterable;
    use Presentable;
    use Recordable;
    use Favoritable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'body', 'user_id', 'channel_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['path'];

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
     * A thread can have a best reply.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bestReply()
    {
        return $this->hasOne(Reply::class, 'thread_id');
    }

    /**
     * Get all replies associated with the thread.
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
        $reply = $this->replies()->create($reply);

        event(new ThreadReceivedNewReply($reply));

        return $reply;
    }

    /**
     * Get full URL of thread page.
     *
     * @return string
     */
    public function path(): string
    {
        return route('threads.show', [
            'channel' => $this->channel->slug,
            'thread' => $this->slug,
        ]);
    }

    /**
     * Subscribe a user to the current thread.
     *
     * @param int|null $userId
     *
     * @return \App\Models\Thread
     */
    public function subscribe(?int $userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id(),
        ]);

        return $this;
    }

    /**
     * Unsubscribe a user from the current thread.
     *
     * @param int|null $userId
     *
     * @return void
     */
    public function unsubscribe(?int $userId = null): void
    {
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id())
            ->delete();
    }

    /**
     * A thread can have many subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    /**
     * Determine if the current user is subscribed to the thread.
     *
     * @return bool
     */
    public function getIsSubscribedToAttribute(): bool
    {
        if (!auth()->id()) {
            return false;
        }

        return $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }

    /**
     * Determine if the thread has been updated since the user last read it.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function hasUpdatesFor($user): bool
    {
        $key = $user->visitedThreadCacheKey($this);

        return $this->updated_at > cache($key);
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
     * Mark the given reply as the best answer.
     *
     * @param \App\Models\Reply $reply
     *
     * @return void
     */
    public function markBestReply(Reply $reply): void
    {
        if ($this->hasBestReply()) {
            $this->bestReply->user->loseReputation('best_reply_awarded');
        }

        $this->update(['best_reply_id' => $reply->id]);

        $reply->user->gainReputation('best_reply_awarded');
    }

    /**
     * Reset the best reply record.
     *
     * @return void
     */
    public function removeBestReply(): void
    {
        $this->bestReply->user->loseReputation('best_reply_awarded');

        $this->update(['best_reply_id' => null]);
    }

    /**
     * Determine if the thread has a current best reply.
     *
     * @return bool
     */
    public function hasBestReply(): bool
    {
        return !is_null($this->best_reply_id);
    }
}
