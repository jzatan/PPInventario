<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prestamo extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function usuario_prestario(){
        return $this->belongsTo(usuario::class,'id_prestario');
    }

    public function usuario_prestador_area(){
        return $this->belongsTo(area::class,'id_prestador_area');
    }

    public function equipos(){
        return $this->belongsTo(equipo::class, 'equipo_id');
    }


}
