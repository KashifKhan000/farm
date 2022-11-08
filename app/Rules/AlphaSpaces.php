<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AlphaSpaces implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @param  array  $parameters
     *
     * @return void
     */
    public function __construct(array $parameters)
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^[\pL\s0-9]+$/u', $value);
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.alpha_spaces');
    }
}
