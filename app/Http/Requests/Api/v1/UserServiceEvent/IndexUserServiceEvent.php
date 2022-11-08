<?php

namespace App\Http\Requests\Api\v1\UserServiceEvent;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\UserServiceEvent;

class IndexUserServiceEvent extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->ability = 'index';
        // $this->model = UserServiceEvent::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'filter' => 'query_filter:UserServiceEvent'
        ];
    }
}
