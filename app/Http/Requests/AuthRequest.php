<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6']
        ];
    }

    public function messages() {
        return [
            'email.required' => 'Email field cannot be empty.',
            'email.email' => 'Invalid email.',
            'password.required' => 'Password field cannot be empty.',
            'password.min' => 'Password field must be at least 6 characters long.'
        ];
    }
}
