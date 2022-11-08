<?php

namespace App\Http\Requests\Api\v1\GoalCategory;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\GoalCategory;

class DestroyGoalCategory extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'goal_category';
        $this->model = GoalCategory::class;
    }
}
