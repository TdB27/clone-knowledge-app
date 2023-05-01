<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'name' => ['required'],
            'description' => ['required'],
            'category_id' => ['required'],
            'user_id' => ['required'],
            'content' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Nome é obrigatório',
            'description.required' => 'O campo Descrição é obrigatório',
            'category_id.required' => 'O campo Categoria é obrigatório',
            'user_id.required' => 'O campo Autor é obrigatório',
            'content.required' => 'O campo Conteúdo é obrigatório',
        ];
    }
}
