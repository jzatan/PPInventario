<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateComponentesrequest extends FormRequest
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
        $componente = $this->route('componente');
        $componenteid = $componente->id;
        return [
            //
            'equipo_id' => 'required',
            'nombre_componente' => 'required|max:50,'.$componenteid,
            'descripcion' => 'required|max:250'
        ];
    }
}
