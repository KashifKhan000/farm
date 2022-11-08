<?php

namespace App\Http\Requests\Api\v1\ServiceEventShutdownMothball;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\{ ServiceEvent, ServiceEventShutdownMothball };
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexServiceEventShutdownMothball extends ApiRequest
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
        return $this->indexRules(ServiceEventShutdownMothball::class);
    }
}
