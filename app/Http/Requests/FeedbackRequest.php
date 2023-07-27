<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * FeedbackRequest
 */
class FeedbackRequest extends FormRequest
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
        if(empty(Auth::user())){
            $name = ['required','min:4','max:255'];
            $email = ['required','email','min:12','max:255'];
            $address = ['required','min:3','max:255'];
        }else{
            $name = [];
            $email = [];
            $address = [];
        }
        return [
            'name' => $name,
            'email' => $email,
            'subject' => ['required','min:3','max:255'],
            'message' => ['required','min:3','max:255'],
            'address' => $address,
        ];
    }
}
