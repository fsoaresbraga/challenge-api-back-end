<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'date_sale' => [
                'required',
                'date_format:d/m/Y H:i:s'
            ],
            'value' => [
                'required',
            ],
            'latitude' => [
                'required',
                'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'
            ],
            'longitude' => [
                'required',
                'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'
            ]
        ];
    }
}
