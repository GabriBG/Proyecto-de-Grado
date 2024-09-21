<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;


    public $timestamps = false;

    protected $fillable = ['id_grupo','nombres','apellidos'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }
}
