<?php

namespace App\Http\Requests\Api\v1\GoalCategory;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\GoalCategory;

class StoreGoalCategory extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
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
            'name' => "required|string|unique:goal_categories"
        ];
    }
}
