<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storePrestamosrequest extends FormRequest
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
            'equipo_id' => 'required',
            'id_prestador_area' => 'required',
            'cod_prestamo' => 'required|max:10',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'required|date',
            'observaciones' => 'nullable|max:250',
            'estado' => 'required'

        ];
    }
}
