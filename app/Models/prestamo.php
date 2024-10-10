<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prestamo extends Model
{
    use HasFactory;

    public function usuario_admin(){
        return $this->hasMany(usuario::class,'id_usuario_admin');
    }

    public function usuario_prestamista(){
        return $this->hasMany(usuario::class,'id_prestamista');
    }


}
