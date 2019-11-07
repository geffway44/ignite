<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'website', 'twitter', 'github', 'avatar', 'job',
        'hometown', 'country', 'employment',
    ];

    /**
     * Get the user's avatar.
     *
     * @param string $value
     *
     * @return string
     */
    public function getAvatarAttribute($value)
    {
        if (Str::contains($value, 'http')) {
            return $value;
        }

        return asset($value ?: 'img/avatars/default.svg');
    }

    /**
     * Get fillable fields.
     *
     * @return array
     */
    public static function getFields()
    {
        return [
            'website', 'twitter', 'github', 'avatar', 'job',
            'hometown', 'country', 'employment',
        ];
    }
}
