<?php

namespace App\Http\Requests\Api\v1\EquipmentAssetLog;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\EquipmentAssetLog;

class StoreEquipmentAssetLog extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
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
