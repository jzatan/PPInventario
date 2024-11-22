<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateEquiposrequest extends FormRequest
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
    public function rules(): array
    {
        $equipo = $this->route('equipo');
        $equipoid = $equipo->id;
        return [
            //
            'categoria_id' => 'required',
            'usuario_id' => 'required',
            'area_id' => 'required',
            'nombre_equipo' => 'required|max:255,'.$equipoid,
            'marca' => 'required|max:30',
            'modelo' => 'required|max:30',
            'color' => 'required|max:30',
            'cod_registro' => 'required|max:20',
            'ord_compra' => 'nullable|max:30',
            'nro_serie' => 'required|max:20',
            'fecha_adquision' => 'required|date',
            'observacion' => 'nullable|max:250',
            'estado'=>'required'
        ];
    }
}
