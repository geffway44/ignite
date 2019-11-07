<?php

namespace App;

use Parsedown;
use App\Traits\Sluggable;
use App\Traits\Searchable;
use App\Filters\ThreadFilters;
use App\Traits\RecordsActivity;
use App\Events\ThreadReceivedNewReply;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordsActivity, Sluggable, Searchable;

    /**
     * The relationships to always eager-load.
     *
     * @var array
     */
    protected $with = ['user', 'channel'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['path', 'isSubscribedTo'];

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'threads.title' => 10,
            'threads.body' => 10,
        ],
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($thread) {
            $thread->slug = $thread->title;
        });

        static::deleting(function ($thread) {
            $thread->replies->each->delete();

            // $thread->user->loseReputation('thread_published');
        });
    }

    /**
     * Apply all relevant thread filters.
     *
     * @param Builder       $query
     * @param ThreadFilters $filters
     *
     * @return Builder
     */
    public function scopeFilter($query, ThreadFilters $filters)
    {
        return $filters->apply($query);
    }

    /**
     * Fetch the path to the thread as a property.
     */
    public function getPathAttribute()
    {
        if (!$this->channel) {
            return '';
        }

        return $this->path();
    }

    /**
     * Get the title for the thread.
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * A thread is assigned a channel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class)->withoutGlobalScope('active');
    }

    /**
     * Get all replies that belong to the thread.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Add a reply to the thread.
     *
     * @param  array $reply
     * @return Model
     */
    public function addReply($reply)
    {
        $reply = $this->replies()->create($reply);

        event(new ThreadReceivedNewReply($reply));

        return $reply;
    }

    /**
     * Get the user the thread belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the full path url to the thread.
     *
     * @return string
     */
    public function path()
    {
        return route('threads.show', [
            'channel' => $this->channel->slug, 'thread' => $this->slug,
        ]);
    }

    /**
     * Extract the thread body into an excerpt form.
     *
     * @return string
     */
    public function getExcerptAttribute()
    {
        return str_limit(resolve(Parsedown::class)->text(
            $this->body), 100, '...'
        );
    }

    /**
     * Mark the given reply as the best answer.
     *
     * @param Reply $reply
     */
    public function markBestReply(Reply $reply)
    {
        if ($this->hasBestReply()) {
            $this->bestReply->owner->loseReputation('best_reply_awarded');
        }

        $this->update(['best_reply_id' => $reply->id]);

        $reply->owner->gainReputation('best_reply_awarded');
    }

    /**
     * Reset the best reply record.
     */
    public function removeBestReply()
    {
        $this->bestReply->owner->loseReputation('best_reply_awarded');

        $this->update(['best_reply_id' => null]);
    }

    /**
     * Determine if the thread has a current best reply.
     *
     * @return bool
     */
    public function hasBestReply()
    {
        return !is_null($this->best_reply_id);
    }

    /**
     * Subscribe a user to the current thread.
     *
     * @param  int|null $userId
     * @return $this
     */
    public function subscribe($userId = null)
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
     */
    public function unsubscribe($userId = null)
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
     * @return boolean
     */
    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()
                    ->where('user_id', auth()->id())
                    ->exists();
    }

    /**
     * Determine if the thread has been updated since the user last read it.
     *
     * @param  User $user
     * @return bool
     */
    public function hasUpdatesFor($user)
    {
        $key = $user->visitedThreadCacheKey($this);

        return $this->updated_at > cache($key);
    }

    /**
     * Get fillable fields.
     *
     * @return array
     */
    public static function getFields()
    {
        return [
            'title', 'body', 'user_id', 'channel_id',
        ];
    }
}
