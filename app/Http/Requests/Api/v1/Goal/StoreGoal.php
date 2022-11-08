<?php

namespace App\Http\Requests\Api\v1\Goal;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Goal;

class StoreGoal extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
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
            'user_id' => 'sometimes|int|exists:users,id|is_or_can:store,Goal',
            'goal_category_id' => 'required|int|exists:goal_categories,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'caption' => 'nullable|string',
            'status' => 'required|string|in:On-Going,Completed',
            'notification_time' => 'nullable|required_with:days|date_format:H:i:s',
            'notification_days' => 'nullable|required_with:time|integer|max:255',
        ];
    }
}
