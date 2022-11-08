<?php

namespace App\Http\Requests\Api\v1\CylinderAssetLog;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\CylinderAssetLog;
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexCylinderAssetLog extends ApiRequest
{
    use HasRequestHelpers;

    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = CylinderAssetLog::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->indexRules();
    }
}
