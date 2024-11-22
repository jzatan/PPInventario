<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mantenimiento_detalle extends Model
{
    use HasFactory;
    protected $guarded = []; 

    public function mantenimiento(){
        return $this->hasOne(Mantenimiento::class, 'mantenimiento_detalle_id');
    }
}
