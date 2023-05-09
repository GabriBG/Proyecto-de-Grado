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
            'estudiantes_matriculados' => '16',
            'numero_grupo' => 'B512',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Grupo::create([
            'id' => 2,
            'estudiantes_matriculados' => '13',
            'numero_grupo' => 'B611',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
