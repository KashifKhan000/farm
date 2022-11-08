<?php

namespace App\Http\Requests\Api\v1\ServiceEventLeakInspection;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ServiceEvent;

class DestroyServiceEventLeakInspection extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'service_event_leak_inspection';
        $this->model = ServiceEventLeakInspection::class;
    }
}
