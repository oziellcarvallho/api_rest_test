<?php

namespace App\Http\Requests;

use App\Rules\Deadline;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'title' => ['max:255', 'min:3'],
            'description' => ['max:255', 'min:2'],
            'deadline' => [new Deadline],
            'executor_id' => ['exists:users,id'],
            'project_id' => ['exists:projects,id']
        ];
    }

    public function messages() {
        return [
            'title.max' => 'The title field must have a maximum of 255 characters',
            'title.min' => 'Title field must be at least 3 characters long',
            'description.max' => 'The description field must have a maximum of 255 characters',
            'description.min' => 'Description field must be at least 2 characters long',
            'executor_id.exists' => 'The specified executor does not exist',
            'project_id.exists' => 'The specified project does not exist'
        ];
    }
}
