<?php

namespace App;

use Parsedown;
use Carbon\Carbon;
use App\Traits\Searchable;
use App\Traits\Favoritable;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use RecordsActivity;
    use Favoritable;
    use Searchable;

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
    protected $appends = ['favoritesCount', 'isFavorited'];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'reply.id' => 10,
            'reply.body' => 10,
        ],
    ];

    /**
     * Boot the reply instance.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($reply) {
            $reply->thread->increment('replies_count');
        });

        static::deleted(function ($reply) {
            $reply->thread->decrement('replies_count');
        });
    }

    /**
     * Get the related title for the reply.
     */
    public function title()
    {
        return $this->thread->title;
    }

    /**
     * Determine the path to the reply.
     *
     * @return string
     */
    public function path()
    {
        $replyPosition = $this->thread->replies()
                                      ->pluck('id')
                                      ->search($this->id) + 1;

        $page = ceil($replyPosition / config('ignite.pagination'));

        return $this->thread->path() . "?page={$page}#reply-{$this->id}";
    }

    /**
     * Fetch all mentioned users within the reply's body.
     *
     * @return array
     */
    public function mentionedUsers()
    {
        preg_match_all('/@([\w\-]+)/', $this->body, $matches);

        return array_values(array_unique($matches[1], SORT_REGULAR));
    }

    /**
     * Set the body attribute.
     *
     * @param string $body
     */
    public function setBodyAttribute($body)
    {
        $this->attributes['body'] = preg_replace(
            '/@([\w\-]+)/', '[$0](/user/@$1)', $body
        );
    }

    /**
     * Set the body attribute.
     *
     * @param string $body
     */
    public function getBodyAttribute($body)
    {
        return resolve(Parsedown::class)->text($body);
    }

    /**
     * Fetch the path to the thread as a property.
     */
    public function getPathAttribute()
    {
        return $this->path();
    }

    /**
     * Determine if the reply was just published a moment ago.
     *
     * @return bool
     */
    public function wasJustPublished()
    {
        return $this->created_at->gt(Carbon::now()->subMinute());
    }

    /**
     * Get the thread the reply belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    /**
     * Get the user the reply belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
