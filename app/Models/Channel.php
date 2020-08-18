<?php

namespace App\Models;

use App\Models\Traits\Sluggable;
use Illuminate\Database\Query\Builder;
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
     * Attributes to cast.
     */
    protected $casts = [
        'archived' => 'boolean',
    ];

    /**
     * Boot the channels model.
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('active', function ($builder) {
            $builder->where('archived', false);
        });

        static::addGlobalScope('sorted', function ($builder) {
            $builder->orderBy('name', 'asc');
        });
    }

    /**
     * A channel consists of threads.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    /**
     * Archive the channel.
     *
     * @return void
     */
    public function archive(): void
    {
        $this->update(['archived' => true]);
    }

    /**
     * Set the name of the channel.
     *
     * @param string $name
     *
     * @return void
     */
    public function setNameAttribute(string $name): void
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = str_slug($name);
    }

    /**
     * Get a new query builder that includes archives.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public static function withArchived(): Builder
    {
        return (new static())->newQueryWithoutScope('active');
    }
}
