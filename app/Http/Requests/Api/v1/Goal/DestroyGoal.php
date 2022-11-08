<?php

namespace App\Http\Requests\Api\v1\Goal;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Goal;

class DestroyGoal extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'goal';
        $this->model = Goal::class;
    }
}
