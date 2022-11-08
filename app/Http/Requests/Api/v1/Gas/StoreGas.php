<?php

namespace App\Http\Requests\Api\v1\Gas;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Gas;

class StoreGas extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = Gas::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'gwp' => 'required|integer',
        ];
    }
}
