<?php

namespace App\Http\Requests\Api\v1\Image;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Image;
use App\Traits\Requests\Api\v1\HasOwnership;

class UpdateImage extends ApiRequest
{
    use HasOwnership;

    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'image';
        $this->model = Image::class;
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
            'image' => 'image',
            'name' => 'string'
        ];
    }
}
