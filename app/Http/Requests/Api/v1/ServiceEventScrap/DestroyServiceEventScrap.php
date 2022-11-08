<?php

namespace App\Http\Requests\Api\v1\ServiceEventScrap;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ServiceEvent;

class DestroyServiceEventScrap extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'service_event';
        $this->model = ServiceEvent::class;
    }
}
