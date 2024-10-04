<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    // Definir los atributos que pueden ser asignados masivamente
    protected $fillable = ['clase_id', 'estudiante_id', 'asistencia', 'observacion'];

    public $timestamps = true;
    // Relación con el modelo Clase
public function estudiante()
{
    return $this->belongsTo(Estudiante::class, 'estudiante_id');
}

public function clase()
{
    return $this->belongsTo(Clase::class, 'clase_id');
}
}
