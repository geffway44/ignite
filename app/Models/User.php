<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Cratespace\Citadel\Models\Traits\HasProfilePhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cratespace\Citadel\Models\Concerns\InteractsWithSessions;
use Cratespace\Citadel\Models\Traits\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use InteractsWithSessions;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'settings',
        'locked',
        'profile_photo_path',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_enabled' => 'boolean',
        'settings' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'sessions',
        'two_factor_enabled',
    ];

    /**
     * Get all threads that belong to the thread.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads(): HasMany
    {
        return $this->hasMany(Thread::class);
    }

    /**
     * Get all replies that belong to the thread.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }
}
