<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ArrayKeyPresent implements Rule
{
    protected string $key;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($key)
    {
        $this->key = $key;
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
        foreach ($value as $object) {
            if (array_key_exists($this->key, $object)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('messages.Field must be checked', ['field' => __('dashboard.'.$this->key)]);
    }
}
