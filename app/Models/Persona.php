<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;


    public $timestamps = true;

    protected $fillable = ['documento_identidad','nombre','apellido','telefono'];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function asignaciones()
    {
        return $this->hasMany(Asignacion_Grupo::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function profile(){
        return $this->hasOne(Persona::class);
    }

    public function scopeNombres($query, $nom) {
        if ($nom) {
           return $query->where('nombre','like',"%$nom%");
        }
    }
}
