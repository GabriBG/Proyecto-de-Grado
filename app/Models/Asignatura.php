<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = ['codigo','nombre','creditos'];


    public function asignacionesGrupos()
{
    return $this->hasMany(Asignacion_Grupo::class);
}
}
