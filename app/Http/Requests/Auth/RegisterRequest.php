<?php

namespace App\Http\Requests\Auth;

use App\Http\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email:filter|max:250|unique:users,email,'.$this->user_id,
            'password' => 'required|min:6|confirmed'
        ];
    }
}
