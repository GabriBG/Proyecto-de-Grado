<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grupo;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grupo::create([
            'id' => 1,
            'estudiantes_matriculados' => '10',
            'numero_grupo' => '6-1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Grupo::create([
            'id' => 2,
            'estudiantes_matriculados' => '13',
            'numero_grupo' => '6-3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Grupo::create([
            'id' => 3,
            'estudiantes_matriculados' => '20',
            'numero_grupo' => '8-1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Grupo::create([
            'id' => 4,
            'estudiantes_matriculados' => '23',
            'numero_grupo' => '8-3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Grupo::create([
            'id' => 5,
            'estudiantes_matriculados' => '21',
            'numero_grupo' => '11-2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Grupo::create([
            'id' => 6,
            'estudiantes_matriculados' => '30',
            'numero_grupo' => '4-1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
