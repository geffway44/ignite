<?php

namespace App\Models;

use Emberfuse\Blaze\Models\Traits\Directable;
use Emberfuse\Blaze\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;
    use Sluggable;
    use Directable;

    /**
     * Mass assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];
}
