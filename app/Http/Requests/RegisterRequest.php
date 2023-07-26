<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * RegisterRequest
 */
class RegisterRequest extends FormRequest
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
            'name' => ['required', 'min:4'],
            'phone' => ['required', 'min:11'],
            'address' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
        ];
    }
}
