<?php

namespace App\Http\Requests\Api\v1\Gas;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Gas;
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexGas extends ApiRequest
{
    use HasRequestHelpers;

    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = Gas::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->indexRules();
    }
}
