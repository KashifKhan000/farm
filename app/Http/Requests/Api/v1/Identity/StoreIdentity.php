<?php

namespace App\Http\Requests\Api\v1\Identity;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Identity;
use App\Guards\Api\v1\ApiGuard;

class StoreIdentity extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = Identity::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $method_name = request('type') . 'ValueRules';

        if (method_exists($this, $method_name)) {
            $value_rules = call_user_func([ $this, $method_name ]);
        } else {
            $value_rules = null;
        }

        // Check if auth'd user is changing an existing identity.
        // If so they must provide a password for security reasons.

        $user = ApiGuard::getInstance()->user();

        if ($user && $user->identities()->count() && !request('user_id')) {
            $password_rule = ['password_current' => 'required|string|matches_current'];
        } else {
            $password_rule = [];
        }

        return array_merge($password_rule, [
            'user_id' => 'sometimes|int|exists:users,id|can:attach_identity,User',
            'name' => 'required|string',
            'type' => 'required|in:email,mobile,oauth',
            'value' => [
                'required',
                'unique:identities',
                $value_rules
            ]
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function emailValueRules()
    {
        return 'email';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function mobileValueRules()
    {
        return '';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function oauthValueRules()
    {
        return '';
    }
}
