<?php

namespace App\Rules;

use DateTime;
use Illuminate\Contracts\Validation\Rule;

class OlderThan implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (new DateTime)->diff(new DateTime($value))->y >= 13;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You must be older than 13 to register.';
    }
}
