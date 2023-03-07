<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:20'],
            'middle_name' => ['nullable', 'string', 'max:20'],
            'last_name' => ['required', 'string', 'max:20'],
            'username' => ['required', 'string', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email'],
            'password' => ['required','string','min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'company_name' => ['nullable', 'string', 'max:30'],
            'company_address' => ['nullable', 'string', 'max:30'],
            'position_id' => ['required', 'integer', 'exists:user_positions,id'],
            'department_id' => ['required', 'integer', 'exists:departments,id']
        ];
    }
}
