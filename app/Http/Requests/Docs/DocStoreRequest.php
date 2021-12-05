<?php

namespace App\Http\Requests\Docs;

use Illuminate\Foundation\Http\FormRequest;

class DocStoreRequest extends FormRequest
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
            "category" => "required",
            "title" => "required",
            "description" => "required",
            "order" => "required"
        ];
    }

    public function messages()
    {
        return [
            "category.required" => "Categoría es requerida",
            "title.required" => "Titulo es requerido",
            "description.required" => "Descripción es requerida",
            "order.required" => "Orden dentro de la categoría es requerido"
        ];
    }
}
