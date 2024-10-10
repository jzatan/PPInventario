<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipo extends Model
{
    use HasFactory;

    public function usuarios(){
        return $this->belongsTo(usuario::class);
}

    public function mantenimientos(){
        return $this->hasMany(mantenimiento::class);     
}

    public function prestamos(){
        return $this->hasMany(prestamo::class);
}

    public function componentes(){
        return $this->hasMany(componente::class);
}

    public function categorias(){
        return $this->belongsTo(categoria::class);
    }

}
