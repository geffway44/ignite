<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Traits\HasImage;
use App\Models\Casts\SettingsCast;
use App\Models\Traits\HasReputation;
use Illuminate\Notifications\Notifiable;
use App\Models\Concerns\ManagesRolesAndAbilities;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasImage;
    use ManagesRolesAndAbilities;
    use HasReputation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password',
        'username', 'image', 'settings',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'settings' => SettingsCast::class,
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * Get all replies the user made.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class, 'user_id')->latest();
    }

    /**
     * Get all activity for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return in_array(
            strtolower($this->email),
            array_map('strtolower', config('defaults.administrators'))
        );
    }

    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function getIsAdminAttribute()
    {
        return $this->isAdmin();
    }

    /**
     * Record that the user has read the given thread.
     *
     * @param \App\Models\Thread $thread
     *
     * @return void
     */
    public function read(Thread $thread): void
    {
        cache()->forever(
            $this->visitedThreadCacheKey($thread),
            Carbon::now()
        );
    }

    /**
     * Get the cache key for when a user reads a thread.
     *
     * @param \App\Models\Thread $thread
     *
     * @return string
     */
    public function visitedThreadCacheKey(Thread $thread): string
    {
        return sprintf('users.%s.visits.%s', $this->id, $thread->id);
    }
}
