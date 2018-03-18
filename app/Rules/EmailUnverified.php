<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailUnverified implements Rule
{

    public $user;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
       return ! optional($this->user)->isVerified();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The email dos not match our records.';
    }
}
