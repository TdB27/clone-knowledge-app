<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticateRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => ['required', 'min:4'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O email é um campo obrigatório!',
            'email.email' => 'Digite um email válido!',
            'password.required' => 'A senha é um campo obrigatório!',
            'password.min' => 'A senha deve ter pelo menos 4 caracteres!',
        ];
    }
}
