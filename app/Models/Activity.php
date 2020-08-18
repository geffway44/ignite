<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Activity extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['favoritedModel'];

    /**
     * Fetch the associated subject for the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * Fetch the model record for the subject of the favorite.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getFavoritedModelAttribute(): Model
    {
        $favoritedModel = null;

        if ($this->subject_type === Favorite::class) {
            $subject = $this->subject()->firstOrFail();

            if ($subject->favorited_type == Reply::class) {
                $favoritedModel = Reply::find($subject->favorited_id);
            }
        }

        return $favoritedModel;
    }

    /**
     * Fetch an activity feed for the given user.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Database\Eloquent\Collection;
     */
    public static function feed(User $user): Collection
    {
        return static::where('user_id', $user->id)
            ->latest()
            ->with('subject')
            ->paginate(30);
    }
}
