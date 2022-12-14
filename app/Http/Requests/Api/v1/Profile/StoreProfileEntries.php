<?php

namespace App\Http\Requests\Api\v1\Profile;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Profile;

class StoreProfileEntries extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->model = Profile::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'entries.*.type' => 'required|in:float,integer,string,text',
            'entries.*.name' => 'required|string',
            'entries.*.value' => 'required'
        ];
    }
}
