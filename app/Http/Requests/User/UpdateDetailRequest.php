<?php

namespace App\Http\Requests\User;

use App\Http\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDetailRequest extends FormRequest
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
            'name' => 'required|string|max:200',
            'email' => 'required|email|max:250|unique:users,email,' . auth()->user()->id
        ];
    }
}
