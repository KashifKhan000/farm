<?php

namespace App\Rules;

use App\Models\Secret;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class MatchesCurrent implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (substr($attribute, -8) === "_current") {
            $name = $attribute;
        } else {
            $name = "{$attribute}_current";
        }

        if (!request()->has($name)) {
            return false;
        }

        $model_attribute_name = str_replace('_current', '', $name);
        $given = request($name);
        $user = auth()->user();

        if ($model_attribute_name !== 'password') {
            return $given === ($user->getAttributes()[$model_attribute_name] ?? null);
        }

        $predicate = ['user_id' => $user->id, 'type' => 'password'];
        $secret = Secret::where('user_id', $predicate)->first();

        return Hash::check($given, $secret->value ?? null);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.matches_current');
    }
}
