<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $arr = [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:4'],
            'confirmPassword' => ['required', 'same:password'],
        ];

        if ($this->input('id')) {

            $arr['email'] = ['required', 'email', 'unique:users,email,' . $this->id];

            if (!$this->input('password')) {
                unset($arr['password']);
                unset($arr['confirmPassword']);
            }
        }

        return $arr;
    }

    public function messages(): array
    {
        $arr = [
            'name.required' => 'O campo nome é obrigatório',
            'name.min' => 'O nome deve ter no mínimo 3 caracteres',
            'email.required' => 'O campo email é obrigatório',
            'email.unique' => 'O email já existe',
            'password.required' => 'O campo senha é obrigatório',
            'password.min' => 'O campo senha deve ter no mínimo 4 caracteres',
            'confirmPassword.required' => 'O campo confirme sua senha é obrigatório',
            'confirmPassword.same' => 'Senhas não conferem',
        ];

        if ($this->input('id')) {

            if (!$this->input('password')) {
                unset($arr['password.required']);
                unset($arr['password.min']);
                unset($arr['confirmPassword.required']);
                unset($arr['confirmPassword.same']);
            }
        }

        return $arr;
    }
}
