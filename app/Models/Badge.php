<?php

namespace App\Models;

use App\Traits\Models\HasImages;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = [
        'badge_category_id',
        'name',
        'description',
        'caption',
        'quantity',
    ];

    protected $hidden = [
        'users'
    ];

    /**
     * Get the users for this badge
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->using(BadgeUser::class);
    }
}
