<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mantenimiento extends Model
{
    use HasFactory;

    public function mantenimiento_usuario(){
        return $this->belongsTo(usuario::class,'id_usuario_mantenimiento');
    }

    public function mantenimiento_admin(){
        return $this->belongsTo(usuario::class,'id_usuario_admin');
    }

    public function equipos(){
        return $this->belongsTo(equipo::class);
    }

    public function mantenimiento_detalles(){
        return $this->hasOne(mantenimiento_detalle::class);
    }
}
