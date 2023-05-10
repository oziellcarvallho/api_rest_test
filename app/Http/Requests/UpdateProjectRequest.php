<?php

namespace App\Http\Requests;

use App\Rules\Deadline;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'deadline' => [new Deadline]
        ];
    }

    public function messages() {
        return [
            'name.max' => 'The name field must have a maximum of 255 characters',
            'name.min' => 'Name field must be at least 3 characters long'
        ];
    }
}
