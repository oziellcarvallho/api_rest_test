<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cpf implements Rule
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
        // Remove non-numeric characters
        $cpf = preg_replace('/[^0-9]/', '', $value);

        // Check if the length is 11 digits
        if (strlen($cpf) !== 11) {
            return false;
        }

        // Check if it was a sequence of repeating digits
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Perform CPF checksum
        for ($i = 9; $i < 11; $i++) {
            $sum = 0;
            for ($j = 0; $j < $i; $j++) {
                $sum += $cpf[$j] * (($i + 1) - $j);
            }
            $remainder = $sum % 11;
            $digit = ($remainder < 2) ? 0 : 11 - $remainder;
            if ($cpf[$i] != $digit) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Cpf';
    }
}
