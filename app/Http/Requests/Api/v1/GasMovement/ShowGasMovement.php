<?php

namespace App\Http\Requests\Api\v1\GasMovement;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\GasMovement;

class ShowGasMovement extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'gas_movement';
        $this->model = GasMovement::class;
    }
}
