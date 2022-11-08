<?php

namespace App\Http\Requests\Api\v1\ServiceEventLeakInspection;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\{ ServiceEvent, ServiceEventLeakInspection };
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexServiceEventLeakInspection extends ApiRequest
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
        $this->model = ServiceEvent::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->indexRules(ServiceEventLeakInspection::class);
    }
}
