<?php

namespace App\Http\Requests\Api\v1\UserServiceEvent;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\UserServiceEvent;

class ShowUserServiceEvent extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->ability = 'show';
        // $this->binding = 'service_event';
        // $this->model = ServiceEvent::class;
    }
}
