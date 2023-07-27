<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

/**
 * ProfileRequest
 */
class ProfileRequest extends FormRequest
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
            'image' => [
                File::types(['jpg', 'jpeg', 'png'])
                    ->max(12 * 1024),
            ],
            'name' => ['required','string','min:4', 'max:255'],
            'email' => ['required','string','min:12','max:255', Rule::unique('users')->ignore($this->id)],
            'phone' => ['required', 'min:11','max:15'],
            'address' => ['required','min:3', 'max:255'],
        ];
    }
}
