<?php

namespace App\Http\Requests\Api\v1\Identity;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Identity;

class UpdateIdentity extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
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
        $method_name = (request('type') ?? 'email') . 'ValueRules';

        if (method_exists($this, $method_name)) {
            $value_rules = call_user_func([ $this, $method_name ]);
        } else {
            $value_rules = null;
        }

        return [
            'value' => [
                'required',
                'unique:identities',
                $value_rules,
            ],
        ];
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
