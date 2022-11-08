<?php

namespace App\Http\Requests\Api\v1\Meta;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Meta;
use App\Traits\Requests\Api\v1\HasOwnership;

class UpdateMeta extends ApiRequest
{
    use HasOwnership;

    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'meta';
        $this->model = Meta::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'owner_id' => 'sometimes|morphable|ownable',
            'owner_type' => 'sometimes|morphable|ownable',
            'name' => 'required|string'
        ];
    }
}
