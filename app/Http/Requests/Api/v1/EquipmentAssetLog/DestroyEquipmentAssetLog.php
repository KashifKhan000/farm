<?php

namespace App\Http\Requests\Api\v1\EquipmentAssetLog;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\EquipmentAssetLog;

class DestroyEquipmentAssetLog extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'equipment_asset_log';
        $this->model = EquipmentAssetLog::class;
    }
}
