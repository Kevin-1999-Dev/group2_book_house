<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * PasswordRequest
 */
class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    /**
     * authorize
     *
     * @return bool
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
            'oldPassword' => ['required'],
            'newPassword' => ['required', 'min:8'],
            'confirmPassword' => ['required', 'min:8', 'same:newPassword'],
        ];
    }
}
