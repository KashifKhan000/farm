<?php

namespace App\Http\Requests\Api\v1\Certification;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Certification;

class ShowCertification extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'certification';
        $this->model = Certification::class;
    }
}
