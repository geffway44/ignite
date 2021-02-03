<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
        'user_id',
        'thread_id',
    ];

    /**
     * Get the user the reply belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the thread the reply belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }
}
