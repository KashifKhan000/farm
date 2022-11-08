<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Models\{ HasImages, HasUser };

class Certification extends Model
{
    use HasImages, HasUser;

    protected $casts = [
        'is_primary' => 'boolean',
        'is_expirable' => 'boolean',
        'expires_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'number',
        'is_expirable',
        'is_primary',
        'expires_at',
        'notes',
    ];

    protected $with = [
        'image',
    ];
}
