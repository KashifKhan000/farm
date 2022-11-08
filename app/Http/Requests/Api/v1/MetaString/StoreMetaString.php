<?php

namespace App\Http\Requests\Api\v1\MetaString;

use App\Models\MetaString;
use App\Http\Requests\Api\v1\ApiRequest;

class StoreMetaString extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = MetaString::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => 'required|string'
        ];
    }
}
