<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['codigo','nombre','creditos'];


    public function asignacionesGrupos()
{
    return $this->hasMany(AsignacionGrupo::class);
}
}
