<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecoveryEquipment extends Model
{
    protected $table = 'recovery_equipment';

    protected $fillable = [
        'user_id',
        'brand_name',
        'model',
        'certified_by',
        'serial_number',
    ];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo;
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
