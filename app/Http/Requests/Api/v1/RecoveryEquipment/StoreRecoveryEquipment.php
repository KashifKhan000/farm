<?php

namespace App\Http\Requests\Api\v1\RecoveryEquipment;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\RecoveryEquipment;

class StoreRecoveryEquipment extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = RecoveryEquipment::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $model = request('model');
        return [
            'user_id' => 'sometimes|required|int|exists:users,id|is_or_can:store,RecoveryEquipment',
            'brand_name' => "required|string|unique:recovery_equipment,brand_name,$model,model",
            'model' => 'required|string',
            'certified_by' => 'required|string',
            'serial_number' => 'required|string'
        ];
    }
}
