<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estudiante;

class EstudiantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estudiante::create([
            'id' => 1,
            'id_grupo' => 1,
            'nombres' => 'Rafael',
            'apellidos' => 'Mejia Borja',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 2,
            'id_grupo' => 1,
            'nombres' => 'Lucía',
            'apellidos' => 'González Pérez',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 3,
            'id_grupo' => 1,
            'nombres' => 'Miguel',
            'apellidos' => 'Santos López',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 4,
            'id_grupo' => 1,
            'nombres' => 'Ana',
            'apellidos' => 'Martínez Fernández',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 5,
            'id_grupo' => 1,
            'nombres' => 'Juan',
            'apellidos' => 'Rodríguez García',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 6,
            'id_grupo' => 1,
            'nombres' => 'Sofía',
            'apellidos' => 'Hernández Ruiz',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 7,
            'id_grupo' => 1,
            'nombres' => 'Carlos',
            'apellidos' => 'Ramírez Torres',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 8,
            'id_grupo' => 1,
            'nombres' => 'María',
            'apellidos' => 'Navarro Sánchez',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 9,
            'id_grupo' => 1,
            'nombres' => 'José',
            'apellidos' => 'Ortega Díaz',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 10,
            'id_grupo' => 1,
            'nombres' => 'Isabel',
            'apellidos' => 'Vega Márquez',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 11,
            'id_grupo' => 2,
            'nombres' => 'Luis',
            'apellidos' => 'Carvajal Rodriguez',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 12,
            'id_grupo' => 2,
            'nombres' => 'Ana',
            'apellidos' => 'Gomez Martinez',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 13,
            'id_grupo' => 2,
            'nombres' => 'Carlos',
            'apellidos' => 'Lopez Garcia',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 14,
            'id_grupo' => 2,
            'nombres' => 'Maria',
            'apellidos' => 'Perez Fernandez',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 15,
            'id_grupo' => 2,
            'nombres' => 'Jose',
            'apellidos' => 'Hernandez Ruiz',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 16,
            'id_grupo' => 2,
            'nombres' => 'Laura',
            'apellidos' => 'Ramirez Sanchez',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 17,
            'id_grupo' => 2,
            'nombres' => 'Javier',
            'apellidos' => 'Diaz Morales',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 18,
            'id_grupo' => 2,
            'nombres' => 'Sofia',
            'apellidos' => 'Castro Vargas',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 19,
            'id_grupo' => 2,
            'nombres' => 'Miguel',
            'apellidos' => 'Mendoza Gutierrez',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 20,
            'id_grupo' => 2,
            'nombres' => 'Daniela',
            'apellidos' => 'Santos Peña',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 21,
            'id_grupo' => 2,
            'nombres' => 'Fernando',
            'apellidos' => 'Vargas Romero',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 22,
            'id_grupo' => 2,
            'nombres' => 'Valeria',
            'apellidos' => 'Ortiz Herrera',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Estudiante::create([
            'id' => 23,
            'id_grupo' => 2,
            'nombres' => 'Raul',
            'apellidos' => 'Navarro Flores',
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
