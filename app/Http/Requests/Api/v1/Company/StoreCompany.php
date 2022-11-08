<?php

namespace App\Http\Requests\Api\v1\Company;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Traits\Requests\Api\v1\HasAddress;
use App\Models\Company;

class StoreCompany extends ApiRequest
{
    use HasAddress;
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = Company::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge([
            'name' => 'required|string',
            'user_id' => 'sometimes|required|exists:users,id|is_or_can:store,Company'
        ], $this->addressStoreRules('address.'));
    }
}
