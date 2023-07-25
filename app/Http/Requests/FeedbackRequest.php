<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

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
            $name = ['required'];
            $email = ['required', 'email'];
            $address = ['required'];
        }else{
            $name = [];
            $email = [];
            $address = [];
        }
        return [
            'name' => $name,
            'email' => $email,
            'subject' => ['required'],
            'message' => ['required'],
            'address' => $address,
        ];
    }
}
