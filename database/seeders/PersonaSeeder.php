<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persona;


class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Persona::create([
            'id' => 1,
            'id_usuario' => '1',
            'documento_identidad' => '1005896465',
            'nombre' => 'Gabriel',
            'apellido' => 'Bahamon Guerrero',
            'telefono' => '3126893069',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Persona::create([
            'id' => 2,
            'id_usuario' => '2',
            'documento_identidad' => '16965485',
            'nombre' => 'Alejandro',
            'apellido' => 'Sanchez Ruiz',
            'telefono' => '3165963265',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Persona::create([
            'id' => 3,
            'id_usuario' => '3',
            'documento_identidad' => '14523659',
            'nombre' => 'Luis',
            'apellido' => 'Alvarez Montoya',
            'telefono' => '3156296647',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Persona::create([
            'id' => 4,
            'id_usuario' => '4',
            'documento_identidad' => '163269850',
            'nombre' => 'Gustavo',
            'apellido' => 'Perez Molina',
            'telefono' => '3156285594',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

}
