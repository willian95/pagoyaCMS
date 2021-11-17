<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            "order" => "required|integer"
        ];
    }

    public function messages(){

        return [
            "name.required" => "Nombre de la categoría es requerido",
            "order.required" => "Orden es requerida",
            "order.integer" => "Orden debe ser un número entero"
        ];

    }

}
