<?php

namespace App\Http\Requests\Api\v1\MetaInteger;

use App\Models\MetaInteger;
use App\Http\Requests\Api\v1\ApiRequest;
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexMetaInteger extends ApiRequest
{
    use HasRequestHelpers;

    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = MetaInteger::class;
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
