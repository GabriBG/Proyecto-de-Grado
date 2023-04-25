<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;


    public $timestamps = false;
    
    protected $fillable = ['documento_identidad','nombre','apellido','telefono'];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

}
