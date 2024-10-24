<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeEquiposrequest extends FormRequest
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
            //
            'categoria_id' => 'required',
            'usuario_id' => 'required',
            'nombre_equipo' => 'required|max:255',
            'marca' => 'required|max:30',
            'modelo' => 'required|max:30',
            'cod_registro' => 'required|max:20',
            'nro_serie' => 'required|max:20',
            'observacion' => 'required|max:250',
            'estado'=>'required'
        ];
    }
}
