<?php

namespace App\Http\Requests\Api\v1\ServiceEventLeakInspection;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ServiceEvent;

class ShowServiceEventLeakInspection extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'service_event';
        $this->model = ServiceEvent::class;
    }
}
