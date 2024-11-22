<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeUsuariosrequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // colocar false a true (permite interactuar)
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
            // Campos de la base de datos, los cuales seran almacenados de cada formulario
            'area_id' => 'required',
            'nombres' => 'required|max:80',
            'apellidos' => 'required|max:80',
            'dni' => 'required|max:8',
            'telefono' => 'required|max:15',
            'correo' => 'required|max:40'

        
        ];
    }
}
