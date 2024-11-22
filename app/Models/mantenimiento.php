<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mantenimiento extends Model
{
    use HasFactory;
    protected $guarded = []; 

    public function mantenimiento_usuario(){
        return $this->belongsTo(usuario::class,'id_usuario_mantenimiento');
    }

    public function mantenimiento_admin(){
        return $this->belongsTo(usuario::class,'id_usuario_admin');
    }

    public function equipos(){
        return $this->belongsTo(equipo::class,'equipo_id');
    }

    public function mantenimiento_detalle(){
        return $this->belongsTo(mantenimiento_detalle::class, 'mantenimiento_detalle_id');
    }
    

    public function areas(){
        return $this->belongsTo(area::class,'area_id');
    }
}
