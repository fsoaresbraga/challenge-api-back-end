<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterSaleRequest extends FormRequest
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
            'date_start' => [
                'required',
                'date_format:d/m/Y'
            ],

            'date_end' => [
                'required',
                'date_format:d/m/Y'
            ],

            'user' => [
                'nullable',
                'present',
                'exists:users,id'
            ],

            'unity' => [
                'nullable',
                'present',
                'exists:unities,id'
            ],

            'director' => [
                'nullable',
                'present',
                'exists:directors,id'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'date_start' => 'Data Início',
            'date_end' => 'Data Fim',

        ];
    }
}
