<?php

namespace App\Http\Requests\Api\v1\User;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\User;

use Illuminate\Support\Facades\Log;

class UpdateUser extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'user';
        $this->model = User::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->route('user');

        return [
            'account_id' => 'sometimes|int|exists:accounts,id',
            'first_name' => 'string',
            'middle_name' => 'nullable|string',
            'last_name' => 'string',
            'superhero_name' => 'sometimes|max:50|alpha_spaces|unique:users,superhero_name,' . $user->id,
            'sex' => 'nullable|string|in:Female,Male',
            'timezone' => 'nullable|string',
            'measurements_unit' => 'nullable|string|in:Imperial,Metric',
            'primary_phone_number' => 'sometimes|nullable|phone_number|unique:users,primary_phone_number,'  . $user->id,
            'secondary_phone_number' => 'sometimes|nullable|phone_number',
            'is_dark_mode_enabled' => 'sometimes|boolean'
        ];
    }
}
