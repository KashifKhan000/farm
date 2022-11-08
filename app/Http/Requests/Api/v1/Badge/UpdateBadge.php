<?php

namespace App\Http\Requests\Api\v1\Badge;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Badge;

class UpdateBadge extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'badge';
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
            'badge_category_id' => 'int|exists:badge_categories,id',
            'name' => 'string',
            'description' => 'string',
            'caption' => 'string',
            'quantity' => 'string',
        ];
    }
}
