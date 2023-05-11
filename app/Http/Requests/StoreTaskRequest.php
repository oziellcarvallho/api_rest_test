<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title' => ['required', 'max:255', 'min:3'],
            'description' => ['max:255', 'min:2'],
            'deadline' => ['required', 'date', 'after_or_equal:today'],
            'executor_id' => ['required', 'exists:users,id'],
            'project_id' => ['required', 'exists:projects,id']
        ];
    }

    public function messages() {
        return [
            'title.max' => 'The title field must have a maximum of 255 characters.',
            'title.min' => 'Title field must be at least 3 characters long.',
            'title.required' => 'Title field cannot be empty.',
            'description.max' => 'The description field must have a maximum of 255 characters.',
            'description.min' => 'Description field must be at least 2 characters long.',
            'deadline.required' => 'Deadline field cannot be empty.',
            'deadline.date' => 'The deadline is not a valid date.',
            'deadline.after_or_equal' => 'The deadline must be a date after or equal to today.',
            'executor_id.required' => 'Executor_id field cannot be empty.',
            'executor_id.exists' => 'The specified executor does not exist.',
            'project_id.required' => 'Project_id field cannot be empty.',
            'project_id.exists' => 'The specified project does not exist.'
        ];
    }
}
