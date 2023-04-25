<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Asignatura;

class AsignaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Asignatura::create([
            'id' => 1,
            'codigo' => '3125',
            'nombre' => 'Bases de datos',
            'creditos' => '3',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Asignatura::create([
            'id' => 2,
            'codigo' => '3123',
            'nombre' => 'Programacion III',
            'creditos' => '3',
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
