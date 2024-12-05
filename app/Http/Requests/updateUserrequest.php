<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class updateUserrequest extends FormRequest
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
        $user = $this->route('user');
        $userid = $user->id;
        return [
            //
            'area_id' => 'required',
            'usuario_id' =>'required',
            'name' => 'required|max:255,'.$userid,
            'email' => 'required|max:255',
             'role' => 'required|exists:roles,name',
            //'password' => 'required|max:255'
            'estado' => 'required'
        ];
    }
}
