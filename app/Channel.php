<?php

namespace App;

use App\Traits\Sluggable;
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
     * Get the thread the reply belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    /**
     * Archive the channel.
     */
    public function archive()
    {
        $this->update(['archived' => true]);
    }

    /**
     * Set the name of the channel.
     *
     * @param string $name
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucfirst($name);
    }

    /**
     * Get a new query builder that includes archives.
     */
    public static function withArchived()
    {
        return (new static())->newQueryWithoutScope('active');
    }
}
