<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    protected $table = 'clases';
    public $timestamps = false;

    protected $fillable = [
        'grupoasignado_id',
        'horario_id',
        'fecha',
        'asistencia',
        'modalidad'
    ];


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
        return $this->hasOneThrough(Persona::class, Asignacion_Grupo::class, 'id', 'id', 'grupoasignado_id', 'persona_id');
    }
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
    public function asignaturas()
    {
        return $this->hasOneThrough(Asignatura::class, Asignacion_Grupo::class, 'id', 'id', 'grupoasignado_id', 'asignatura_id');
    }

    public function grupos()
    {
        return $this->hasOneThrough(Grupo::class, Asignacion_Grupo::class, 'id', 'id', 'grupoasignado_id', 'grupo_id');
    }

    public function estudiantes()
    {
        return $this->belongsToMany(Persona::class, 'clase_estudiante')
                    ->withPivot('asistencia', 'observacion')
                    ->withTimestamps();
    }
}
