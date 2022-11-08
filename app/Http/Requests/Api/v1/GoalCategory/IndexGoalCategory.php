<?php

namespace App\Http\Requests\Api\v1\GoalCategory;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\GoalCategory;
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexGoalCategory extends ApiRequest
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
        $this->model = GoalCategory::class;
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
