<?php

namespace App\Http\Requests\Api\v1\UserServiceEvent;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\UserServiceEvent;

class DestroyUserServiceEvent extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'user_service_event';
        $this->model = UserServiceEvent::class;
    }
}
