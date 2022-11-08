<?php

namespace App\Http\Requests\Api\v1\GasTransfer;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\GasTransfer;

class DestroyGasTransfer extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'gas_transfer';
        $this->model = GasTransfer::class;
    }
}
