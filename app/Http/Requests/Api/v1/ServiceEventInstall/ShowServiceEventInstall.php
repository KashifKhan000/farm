<?php

namespace App\Http\Requests\Api\v1\ServiceEventInstall;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ServiceEvent;

class ShowServiceEventInstall extends ApiRequest
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
