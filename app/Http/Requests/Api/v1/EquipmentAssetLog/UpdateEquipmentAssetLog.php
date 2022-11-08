<?php

namespace App\Http\Requests\Api\v1\EquipmentAssetLog;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\EquipmentAssetLog;

class UpdateEquipmentAssetLog extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'equipment_asset_log';
        $this->model = EquipmentAssetLog::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
