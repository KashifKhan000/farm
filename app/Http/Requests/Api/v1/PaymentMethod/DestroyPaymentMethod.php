<?php

namespace App\Http\Requests\Api\v1\PaymentMethod;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\PaymentMethod;

class DestroyPaymentMethod extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->ability = 'destroy';
        // $this->binding = 'payment_method';
        // $this->model = PaymentMethod::class;
    }
}
