<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateUsuariosrequest extends FormRequest
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
        $usuario = $this->route('usuario');
        $usuarioid = $usuario->id;
        return [
            //
            'area_id' => 'required',
            'nombres' => 'required|max:80,'.$usuarioid,
            'apellidos' => 'required|max:80',
            'dni' => 'required|max:8',
            'telefono' => 'required|max:15',
            'usuario' => 'required|max:30',
            'contraseña' => 'required|max:8',
            'estado' => 'required'
        ];
    }
}
