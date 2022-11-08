<?php

namespace App\Http\Requests\Api\v1\Badge;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Badge;

class ShowBadge extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'badge';
        $this->model = Badge::class;
    }
}
