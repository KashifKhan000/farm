<?php

namespace App\Exceptions\Api\v1\Identity;

use App\Exceptions\ApiException;

class NullVerification extends ApiException
{
    /**
     * Instantiate the exception.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('identity.verification.null', 422);
    }
}
