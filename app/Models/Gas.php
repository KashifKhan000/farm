<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gas extends Model
{
    protected $table = 'gases';

    protected $fillable = [
        'name',
        'gwp'
    ];

    protected $hidden = [
        'pivot'
    ];
}
