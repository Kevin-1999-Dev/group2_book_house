<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

/**
 * BookRequest
 */
class BookRequest extends FormRequest
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
            'title' => ['required', 'max:255'],
            'cover' => [
                File::types(['jpg', 'jpeg', 'png'])
                    ->max(12 * 1024),
            ],
            'description' => ['required'],
            'pagecount' => ['integer'],
            'price' => ['integer'],
            'authors' => ['required'],
            'categories' => ['required'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'cover.max' => "Image size may not be greater than 12 mb.",
        ];
    }

}
