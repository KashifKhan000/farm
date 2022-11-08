<?php

namespace App\Http\Requests\Api\v1\Contact;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Contact;

class UpdateContact extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'user_contact';
        $this->model = Contact::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contact_user_id' => 'required|int|exists:users,id',
            'name' => 'nullable|string',
        ];
    }
}
