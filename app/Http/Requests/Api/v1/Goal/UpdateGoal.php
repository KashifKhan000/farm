<?php

namespace App\Http\Requests\Api\v1\Goal;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Goal;

class UpdateGoal extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'goal';
        $this->model = Goal::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'goal_category_id' => 'int|exists:goal_categories,id',
            'name' => 'string',
            'description' => 'nullable|string',
            'recap' => 'nullable|string',
            'status' => 'string|in:On-Going,Completed',
            'notification_time' => 'nullable|required_with:days|date_format:H:i:s',
            'notification_days' => 'nullable|required_with:time|integer|max:255',
        ];
    }
}
