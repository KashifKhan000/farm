<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoalCategory extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }
}
