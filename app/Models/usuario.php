<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    use HasFactory;

    // permite guardar registro con id
    protected $guarded = ['id'];

    //hasMany : uno a muchos
    //belongsTo: muchos a uno
    //hasOne: uno a uno

    public function equipos(){
        return $this->hasMany(equipo::class);
    }

    public function prestamos_prestario(){
        return $this->hasMany(prestamo::class);
    }

    public function mantenimiento_usuario(){
        return $this->hasMany(mantenimiento::class,'id_usuario_mantenimiento');
    }

    public function mantenimiento_admin(){
        return $this->hasMany(mantenimiento::class);
    }

    public function areas(){
        return $this->belongsTo(area::class,'area_id');
    }

}
