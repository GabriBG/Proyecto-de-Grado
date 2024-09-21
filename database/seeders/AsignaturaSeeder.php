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
            'nombre' => 'Sistemas',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Asignatura::create([
            'id' => 2,
            'codigo' => '3123',
            'nombre' => 'Matematicas',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Asignatura::create([
            'id' => 3,
            'codigo' => '1928',
            'nombre' => 'Fisica',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Asignatura::create([
            'id' => 4,
            'codigo' => '1982',
            'nombre' => 'Algebra',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        Asignatura::create([
            'id' => 5,
            'codigo' => '1772',
            'nombre' => 'Sociales',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Asignatura::create([
            'id' => 6,
            'codigo' => '0029',
            'nombre' => 'Artistica',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
