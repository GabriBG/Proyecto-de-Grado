<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;


    public $timestamps = false;

    protected $fillable = ['estudiantes_matriculados','numero_grupo'];

    public function asignacionesGrupos()
    {
        return $this->hasMany(AsignacionGrupo::class);
    }

}
