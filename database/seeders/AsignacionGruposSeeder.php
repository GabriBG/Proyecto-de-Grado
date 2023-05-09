<?php

namespace Database\Seeders;

use App\Models\Asignacion_Grupo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsignacionGruposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Asignacion_Grupo::create([
            'id' => 1,
            'id_grupo' => '1',
            'id_asignatura' => '1',
            'id_persona' => '4',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Asignacion_Grupo::create([
            'id' => 2,
            'id_grupo' => '2',
            'id_asignatura' => '2',
            'id_persona' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
