<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeComponentesrequest extends FormRequest
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
        /* no lo estoy usando, todo lo esta haciendo el controlador*/
        return [
            'equipo_id' => 'required',
            'nombre_componente' => 'required|max:50',
            'descripcion' => 'required|max:250'
        ];
    }
}
