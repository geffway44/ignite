<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Channel extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'threads_count',
    ];

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
     * Get all threads belonging to this channel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads(): HasMany
    {
        return $this->hasMany(Thread::class);
    }

    /**
     * Get all threads the user is allowed to view.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function viewableThreads(): Collection
    {
        return $this->threads()->where('locked', false)->with('replies')->get();
    }

    /**
     * Get number of threads the channel has.
     *
     * @return int
     */
    public function getThreadsCountAttribute(): int
    {
        return $this->threads()->count();
    }
}
