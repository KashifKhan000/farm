<?php

namespace App\Http\Requests\Api\v1\Company;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Traits\Requests\Api\v1\HasAddress;
use App\Models\Company;

class UpdateCompany extends ApiRequest
{
    use HasAddress;

    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'company';
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
            'user_id' => 'sometimes|required|exists:users,id|is_or_can:attach,Company'
        ], $this->addressUpdateRules('address.'));
    }
}
