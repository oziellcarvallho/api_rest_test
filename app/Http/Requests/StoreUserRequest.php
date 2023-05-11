<?php

namespace App\Http\Requests;

use App\Rules\Cpf;
use App\Rules\UserType;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'cpf' => [new Cpf, 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],
            'type' => ['required', new UserType]
        ];
    }

    public function messages() {
        return [

            'name.max' => 'The name field must have a maximum of 255 characters.',
            'name.min' => 'Name field must be at least 3 characters long.',
            'name.required' => 'Name field cannot be empty.',
            'email.email' => 'Invalid email.',
            'email.unique' => 'The email is already in use.',
            'email.required' => 'Email field cannot be empty.',
            'cpf.unique' => 'The Cpf is already in use.',
            'password.confirmed' => 'Passwords do not match.',
            'password.min' => 'Password field must be at least 6 characters long.',
            'password.required' => 'Password field cannot be empty.',
            'type.required' => 'Type field cannot be empty.'
        ];
    }
}
