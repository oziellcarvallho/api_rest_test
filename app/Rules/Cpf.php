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
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $value);

        // Verifica se o comprimento é de 11 dígitos
        if (strlen($cpf) !== 11) {
            return false;
        }

        // Verifica se é uma sequência de dígitos repetidos
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Realiza o cálculo de validação do cpf
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
