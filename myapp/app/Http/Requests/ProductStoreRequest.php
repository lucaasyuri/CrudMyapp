<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() // rules: são as regras da nossa validação
    {
        return [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer', //nullable: pode ser nulo
            'cover' => 'nullable|file',
            'description' => 'nullable|string',
        ];
    }
}
