<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateAreasrequest extends FormRequest
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
        $area = $this->route('area');
        $areaid = $area->id;
        return [
            //
            'nombre_area' => 'required|max:50,'.$areaid,
            'ubicacion' => 'required|max:250',
            'estado' => 'required'
        ];
    }
}
