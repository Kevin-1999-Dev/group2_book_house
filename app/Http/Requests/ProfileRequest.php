<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

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
                ->max(12 * 1024),],
            'name' => ['required', 'max:255'],
            'email' => ['required',Rule::unique('users')->ignore($this->id)],
            'phone' => ['required', 'min:11'],
            'address' => ['required', 'max:255'],
        ];
    }
}
