<?php

namespace App\Http\Requests\Api\v1\Gas;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Gas;

class ShowGas extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'gas';
        $this->model = Gas::class;
    }
}
