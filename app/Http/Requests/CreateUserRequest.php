<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'userName' => 'required|max:255',
            'userEmail' => 'required|email|unique:users,email',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'userName.required' => 'Name is required',
            'userEmail.required'  => 'Email  is required',
            'userEmail.email'  => 'Email is invalid',
            'userEmail.unique'  => 'Email should be unique',
        ];
    }
}
