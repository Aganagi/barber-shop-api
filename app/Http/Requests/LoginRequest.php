<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'=>['required','email','exists:users'],
            'password'=>['required'],
            'remember_me'=>['boolean']
        ];
    }
    public function messages(): array
    {
        return [
            'email.required'=>'Email bölməsi boş olmalı deyil',
            'email.email'=>'Email düzgün yazılişında @ işarə olmalıdır',
            'email.exists'=>'Bu email qeydiyatdan keçməyib'
        ];
    }
}
