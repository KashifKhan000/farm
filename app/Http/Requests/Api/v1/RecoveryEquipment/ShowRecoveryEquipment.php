<?php

namespace App\Http\Requests\Api\v1\RecoveryEquipment;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\RecoveryEquipment;

class ShowRecoveryEquipment extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'recovery_equipment';
        $this->model = RecoveryEquipment::class;
    }
}
