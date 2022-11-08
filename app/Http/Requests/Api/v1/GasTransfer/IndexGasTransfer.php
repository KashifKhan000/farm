<?php

namespace App\Http\Requests\Api\v1\GasTransfer;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\GasTransfer;
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexGasTransfer extends ApiRequest
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
        $this->model = GasTransfer::class;
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
