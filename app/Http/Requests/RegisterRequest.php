<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=>[ 'required', 'string','max:25'],
            'email'=>['required','email','unique:users'],
            'password'=>['required','confirmed','min:6','max:10']
        ];
    }
    public function messages():array
    {
        return[
            'name.required'=>'Ad bölməsi boş olmalı deyil',
            'name.string'=>'Ad yalnız hərflərdən ibarət olmalıdır',
            'email.required'=>'Email bölməsi boş olmalı deyil',
            'email.email'=>'Email düzgün yazılişında @ işarə olmalıdır',
            'password.required'=>'Parol bölməsi boş olmalı deyil',
            'password.confirmed'=>'Parollar bir-birinə uyğun deyil',
            'password.min'=>'Parol minimum 6 simvoldan ibarət olmalıdır',
            'password.max'=>'Parol maximum 10 simvol ola bilər'
        ];
    }
}
