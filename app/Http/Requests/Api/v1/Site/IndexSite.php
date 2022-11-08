<?php

namespace App\Http\Requests\Api\v1\Site;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Site;
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexSite extends ApiRequest
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
        $this->model = Site::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge([
            'lat' => 'sometimes|numeric',
            'lng' => 'sometimes|numeric',
            'radius' => 'sometimes|numeric'
        ], $this->indexRules());
    }
}
