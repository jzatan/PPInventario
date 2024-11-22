<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateMantenimientorequest extends FormRequest
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
    public function rules():array
    {
        return [
            //
             //
             // Validaciones para detalles_mantenimiento

             'fecha_retorno' => 'required|date',
             'problema' => 'nullable|max:300',
             'diagnostico' => 'nullable|max:300',
             'observaciones' => 'nullable|max:250',
             'estado_mantenimiento' => 'required',
             
             // Validaciones para mantenimientos

             'id_usuario_mantenimiento' => 'required|integer|exists:usuarios,id',
             'estado' => 'required',

        ];
    }
}
