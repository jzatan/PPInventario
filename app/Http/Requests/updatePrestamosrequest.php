<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updatePrestamosrequest extends FormRequest
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
        $prestamo = $this->route('prestamo');
        $prestamoid = $prestamo->id;
        return [
            //
            'equipo_id' => 'required',
            'id_prestador_area' => 'required',
            'id_prestario' => 'required',
            'cod_prestamo' => 'required|max:10,'.$prestamoid,
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'required|date',
            'observaciones' => 'nullable|max:250',
            'estado' => 'required'
        ];
    }
}
