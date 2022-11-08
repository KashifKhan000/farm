<?php

namespace App\Http\Requests\Api\v1\Certification;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Certification;

class UpdateCertification extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'certification';
        $this->model = Certification::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'sometimes|int|exists:users,id|can:update,Certification',
            'name' => 'string',
            'type' => 'nullable|string',
            'number' => 'nullable|string',
            'is_expirable' => 'boolean',
            'is_primary' => 'boolean',
            'expires_at' => 'nullable|date',
            'notes' => 'nullable|string',
        ];
    }
}
