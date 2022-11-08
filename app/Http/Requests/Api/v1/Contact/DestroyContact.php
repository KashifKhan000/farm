<?php

namespace App\Http\Requests\Api\v1\Contact;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Contact;

class DestroyContact extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'user_contact';
        $this->model = Contact::class;
    }
}
