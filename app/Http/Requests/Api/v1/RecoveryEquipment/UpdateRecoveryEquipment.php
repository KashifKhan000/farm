<?php

namespace App\Http\Requests\Api\v1\RecoveryEquipment;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\RecoveryEquipment;

class UpdateRecoveryEquipment extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'recovery_equipment';
        $this->model = RecoveryEquipment::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'int|exists:users,id|is_or_can:update,RecoveryEquipment',
            'brand_name' => 'string',
            'model' => 'string',
            'certified_by' => 'string',
            'serial_number' => 'string'
        ];
    }
}
