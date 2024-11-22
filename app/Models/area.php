<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    use HasFactory;

    // permite guardar registro con id
    protected $guarded = ['id'];

    public function usuarios(){
        return $this->belongsTo(usuario::class);
    }

    public function users(){
        return $this->belongsTo(user::class,'area_id');
    }

    public function mantenimientos(){
        return $this->belongsTo(mantenimiento::class);
    }

    public function prestamos_prestador_area(){
        return $this->hasMany(prestamo::class);
    }
}
