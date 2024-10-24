<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class componente extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function equipos(){
        return $this->belongsTo(equipo::class, 'equipo_id');
    }

}
