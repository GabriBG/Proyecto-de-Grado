<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion_Grupo extends Model
{
    use HasFactory;

    protected $table= 'asignacion_grupos';
    public $timestamps = false;

    protected $fillable = ['id_grupo','id_asignatura','id_persona'];

    public function grupos()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }
    public function asignaturas()
    {
        return $this->belongsTo(Asignatura::class, 'id_asignatura');
    }
    public function personas()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
