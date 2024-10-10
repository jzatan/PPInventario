<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mantenimiento_detalle extends Model
{
    use HasFactory;

    public function mantenimientos(){
        return $this->hasOne(mantenimiento::class);
    }
}
