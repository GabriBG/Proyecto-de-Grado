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
            'grupo_id' => '1',
            'asignatura_id' => '1',
            'persona_id' => '4',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Asignacion_Grupo::create([
            'id' => 2,
            'grupo_id' => '2',
            'asignatura_id' => '2',
            'persona_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
