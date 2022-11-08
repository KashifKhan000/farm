<?php

namespace App\Http\Requests\Api\v1\File;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\File;
use App\Traits\Requests\Api\v1\HasOwnership;

class UpdateFile extends ApiRequest
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
        $this->binding = 'file';
        $this->model = File::class;
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
            'file' => 'file',
            'name' => 'string'
        ];
    }
}
