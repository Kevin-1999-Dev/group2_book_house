<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class BookRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'cover' => [
                'required',
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
}
