<?php

namespace App\Http\Requests\Api\v1\Address;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Address;
use App\Traits\Requests\Api\v1\HasOwnership;

class UpdateAddress extends ApiRequest
{
    use HasOwnership;

    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'address';
        $this->model = Address::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'owner_id' => 'required_with:owner_type|morphable|ownable',
            'owner_type' => 'required_with:owner_id|morphable|ownable',
            'name' => 'string',
            'line1' => 'nullable|string',
            'line2' => 'nullable|string',
            'city' => 'nullable|string',
            'province' => 'required_with:country|province:' . request('country'),
            'country' => 'required_with:province|country',
            'postal_code' => 'nullable|string'
        ];
    }
}
