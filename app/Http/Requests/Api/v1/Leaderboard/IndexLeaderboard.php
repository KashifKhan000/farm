<?php

namespace App\Http\Requests\Api\v1\Leaderboard;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Leaderboard;
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexLeaderboard extends ApiRequest
{
    use HasRequestHelpers;

    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->ability = 'index';
        // $this->model = Leaderboard::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->indexRules();
    }
}
