<?php

namespace App\Http\Requests\Api\v1\Site;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Site;

class ShowSite extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'site';
        $this->model = Site::class;
    }
}
