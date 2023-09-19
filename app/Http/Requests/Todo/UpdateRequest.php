<?php

namespace App\Http\Requests\Todo;

use App\Http\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    use FailedValidation;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'todo_id' => 'required|integer|exists:todos,id',
            'name' => 'required|string|max:250',
            'description' => 'nullable|string|max:500',
            'due_date' => 'nullable|date_format:Y-m-d',
            'status' => 'nullable|integer|in:0,1'
        ];
    }
}
