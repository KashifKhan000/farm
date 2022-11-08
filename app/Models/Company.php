<?php

namespace App\Models;

use App\Traits\Models\HasAddresses;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasAddresses;

    protected $fillable = [
        'user_id',
        'name'
    ];

    protected $with = [
        'address',
        'addresses',
    ];

    /**
     * Get the users for this company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
