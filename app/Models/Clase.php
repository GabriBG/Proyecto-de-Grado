<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    protected $table= 'clases';
    public $timestamps = false;

    protected $fillable = ['grupo_id','asignatura_id','persona_id'];


    public function aulas()
    {
        return $this->belongsTo(Aula::class, 'aula_id');
    }
    public function horarios()
    {
        return $this->belongsTo(Horario::class, 'horario_id');
    }
    public function asignacionGrupos()
    {
        return $this->belongsTo(Asignacion_Grupo::class, 'grupoasignado_id');
    }

    public function personas()
    {
        return $this->hasOneThrough(Persona::class, Asignacion_Grupo::class, 'id', 'id', 'asignacion_grupo_id', 'persona_id');
    }

    public function asignaturas()
    {
        return $this->hasOneThrough(Asignatura::class, Asignacion_Grupo::class, 'id', 'id', 'asignacion_grupo_id', 'asignatura_id');
    }

    public function grupos()
    {
        return $this->hasOneThrough(Grupo::class, Asignacion_Grupo::class, 'id', 'id', 'asignacion_grupo_id', 'grupo_id');
}

}
