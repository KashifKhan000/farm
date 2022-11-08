<?php

namespace App\Http\Requests\Api\v1\Badge;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Badge;

class StoreBadge extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = Badge::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'badge_category_id' => 'required|int|exists:badge_categories,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'caption' => 'required|string',
            'quantity' => 'required|string',
        ];
    }
}
