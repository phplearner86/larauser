<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class differentFromName implements Rule
{

    public $name;
    public $password;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($name, $password)
    {
        $this->name = $name;
        $this->password = $password;
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
        return $this->password && $this->password != $this->name;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Rhe password and the name must be different.';
    }
}
