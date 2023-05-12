<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion_Grupo extends Model
{
    use HasFactory;

    protected $table= 'asignacion_grupos';
    public $timestamps = false;

    protected $fillable = ['grupo_id','asignatura_id','persona_id'];

    public function asignaciones()
    {
        return $this->hasMany(Persona::class);
    }
    public function grupos()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }
    public function asignaturas()
    {
        return $this->belongsTo(Asignatura::class, 'asignatura_id');
    }
    public function personas()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
}
