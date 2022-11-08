<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = [
        'badge_category_id',
        'name',
        'description',
        'method',
        'quantity'
    ];
}
