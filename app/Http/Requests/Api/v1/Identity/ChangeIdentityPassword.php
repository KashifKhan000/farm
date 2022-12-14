<?php

namespace App\Http\Requests\Api\v1\Identity;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Identity;

class ChangeIdentityPassword extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->binding = 'identity';
        $this->model = Identity::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identity_id' => 'required|int|exists:identities,id',
            'email' => 'required|email',
            'password' => 'required|string|confirmed',
        ];
    }
}
