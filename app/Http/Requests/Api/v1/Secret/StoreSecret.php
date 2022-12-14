<?php

namespace App\Http\Requests\Api\v1\Secret;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Secret;

class StoreSecret extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = Secret::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(
            [
                'user_id' => 'sometimes|int|exists:users,id|can:attach_secret,User',
                'type' => 'required|string|in:password,totp',
                'value' => 'required|string|confirmed'
            ]
        );
    }
}
