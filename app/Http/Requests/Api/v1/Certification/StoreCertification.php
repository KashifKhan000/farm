<?php

namespace App\Http\Requests\Api\v1\Certification;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Certification;

class StoreCertification extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
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
            'user_id' => 'sometimes|required|int|exists:users,id|is_or_can:attach,Company',
            'name' => 'required|string',
            'type' => 'nullable|string',
            'number' => 'nullable|string',
            'is_expirable' => 'required|boolean',
            'is_primary' => 'required|boolean',
            'expires_at' => 'nullable|date',
            'notes' => 'nullable|string',
        ];
    }
}
