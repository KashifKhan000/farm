<?php

namespace App\Http\Requests\Api\v1\RecoveryEquipment;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\RecoveryEquipment;

class DestroyRecoveryEquipment extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'recovery_equipment';
        $this->model = RecoveryEquipment::class;
    }
}
