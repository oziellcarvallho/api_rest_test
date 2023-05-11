<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'deadline' => ['required', 'date', 'after_or_equal:today']
        ];
    }

    public function messages() {
        return [
            'name.max' => 'The name field must have a maximum of 255 characters.',
            'name.min' => 'Name field must be at least 3 characters long.',
            'name.required' => 'Name field cannot be empty.',
            'deadline.required' => 'Deadline field cannot be empty.',
            'deadline.date' => 'The deadline is not a valid date.',
            'deadline.after_or_equal' => 'The deadline must be a date after or equal to today.'
        ];
    }
}
