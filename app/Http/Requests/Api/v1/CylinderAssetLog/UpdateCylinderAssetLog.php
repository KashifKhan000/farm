<?php

namespace App\Http\Requests\Api\v1\CylinderAssetLog;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\CylinderAssetLog;

class UpdateCylinderAssetLog extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'cylinder_asset_log';
        $this->model = CylinderAssetLog::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cylinder_asset_id' => 'required|int|exists:cylinder_assets,id',
            'type' => 'required|string|in:Repair,Shutdown/Mothball,Install,Scrap,Inspection',
            'notes' => 'string',
        ];
    }
}
