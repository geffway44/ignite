<?php

namespace App;

use App\Models\Favorite;
use Illuminate\Database\Eloquent\Model;

trait Favoritable
{
    /**
     * Boot the trait.
     */
    protected static function bootFavoritable()
    {
        static::deleting(function ($model) {
            $model->favorites->each->delete();
        });
    }

    /**
     * A reply can be favorited.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    /**
     * Favorite the current reply.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function favorite(): Model
    {
        $attributes = ['user_id' => auth()->id()];

        if (!$this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create($attributes);
        }
    }

    /**
     * Unfavorite the current reply.
     *
     * @return void
     */
    public function unfavorite(): void
    {
        $attributes = ['user_id' => auth()->id()];

        $this->favorites()->where($attributes)->get()->each->delete();
    }

    /**
     * Determine if the current reply has been favorited.
     *
     * @return bool
     */
    public function isFavorited(): bool
    {
        return (bool) $this->favorites->where('user_id', auth()->id())->count();
    }

    /**
     * Fetch the favorited status as a property.
     *
     * @return bool
     */
    public function getIsFavoritedAttribute(): bool
    {
        return $this->isFavorited();
    }

    /**
     * Get the number of favorites for the reply.
     *
     * @return int
     */
    public function getFavoritesCountAttribute(): int
    {
        return $this->favorites->count();
    }
}
