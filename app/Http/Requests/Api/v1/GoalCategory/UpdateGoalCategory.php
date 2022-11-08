<?php

namespace App\Http\Requests\Api\v1\GoalCategory;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\GoalCategory;

class UpdateGoalCategory extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'goal_category';
        $this->model = GoalCategory::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
