<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = ['id_grupo', 'nombres', 'apellidos'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'estudiante_id');
    }
}
