<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShorterUrlRequest extends FormRequest
{
    /**
     * Verifica se o usuário está autorizado a fazer a requisição de encurtar URL.
     *
     * @return bool Sempre retorna true para permitir o acesso.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Retorna as regras de validação para o campo URL.
     *
     * @return array Regras de validação para a requisição.
     */
    public function rules(): array
    {
        return [
            'url' => 'required|url|max:2048',
        ];
    }

    /**
     * Retorna as mensagens de erro personalizadas para validação da URL.
     *
     * @return array Mensagens de erro para cada regra de validação.
     */
    public function messages(): array
    {
        return [
            'url.required' => 'A URL é obrigatória.',
            'url.url' => 'A URL deve ser válida.',
            'url.max' => 'A URL é muito longa.',
        ];
    }
}
