<?php

namespace App\Http\Requests\Api\v1\PaymentMethod;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\PaymentMethod;

class StorePaymentMethod extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->ability = 'store';
        // $this->model = PaymentMethod::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_method_id' => 'required|string'
        ];
    }
}
