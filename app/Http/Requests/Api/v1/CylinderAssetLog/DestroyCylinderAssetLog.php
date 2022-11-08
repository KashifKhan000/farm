<?php

namespace App\Http\Requests\Api\v1\CylinderAssetLog;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\CylinderAssetLog;

class DestroyCylinderAssetLog extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'cylinder_asset_log';
        $this->model = CylinderAssetLog::class;
    }
}
