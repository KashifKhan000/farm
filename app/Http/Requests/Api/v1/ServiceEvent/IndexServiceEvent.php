<?php

namespace App\Http\Requests\Api\v1\ServiceEvent;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ServiceEvent;
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexServiceEvent extends ApiRequest
{
    use HasRequestHelpers;

    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = ServiceEvent::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge([
                'start_at' => 'date',
                'end_at' => 'nullable|date|after:start_at',
        ], $this->indexRules());
    }
}
