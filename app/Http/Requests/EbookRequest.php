<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;


/**
 * EbookRequest
 */
class EbookRequest extends FormRequest
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
            'title' => ['required','min:4', 'max:225'],
            'cover' => [
                File::types(['jpg', 'jpeg', 'png'])
                    ->max(12 * 1024),
            ],
            'description' => ['required','min:4','max:225'],
            'pagecount' => ['integer','max:1000'],
            'price' => ['integer','min:3000','max:30000'],
            'authors' => ['required','min:3','max:225'],
            'categories' => ['required','min:3','max:225'],
            'ebookfile' => [
                File::types(['pdf', 'epub', 'doc', 'docx', 'jpg'])
                    ->max(100 * 1024),
            ],
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
            'ebookfile.max' => "Image size may not be greater than 100 mb.",
        ];
    }
}
