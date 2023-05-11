<?php

namespace App\Http\Requests;

use App\Rules\Cpf;
use App\Rules\UserType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => ['max:255', 'min:3'],
            'email' => ['email', 'unique:users,email,'.$this->user->id],
            'cpf' => [new Cpf, 'unique:users,cpf,'.$this->user->id],
            'password' => ['min:6', 'confirmed'],
            'type' => [new UserType]
        ];
    }

    public function messages() {
        return [
            'name.max' => 'The name field must have a maximum of 255 characters.',
            'name.min' => 'Name field must be at least 3 characters long.',
            'email.email' => 'Invalid email.',
            'email.unique' => 'The email is already in use.',
            'cpf.unique' => 'The Cpf is already in use.',
            'password.confirmed' => 'Passwords do not match.',
            'password.min' => 'Password field must be at least 6 characters long.'
        ];
    }
}
