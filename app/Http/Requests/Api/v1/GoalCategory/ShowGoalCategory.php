<?php

namespace App\Http\Requests\Api\v1\GoalCategory;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\GoalCategory;

class ShowGoalCategory extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'goal_category';
        $this->model = GoalCategory::class;
    }
}
