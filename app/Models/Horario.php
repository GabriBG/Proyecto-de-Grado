<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;


    public $timestamps = false;
    
    protected $fillable = ['jornada','hora_inicio','hora_final'];

    public function asignaturas()
    {
        return $this->belongsTo(Asignatura::class, 'id_asignatura');
    }
    public function profile(){
        return $this->hasOne(Asignatura::class);
    }

}