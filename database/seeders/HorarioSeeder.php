<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Horario;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Horario::create([
            'id' => 1,
            'id_asignatura' => '1',
            'jornada' => 'Nocturna',
            'hora_inicio' => '18:30',
            'hora_final' => '21:30',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Horario::create([
            'id' => 2,
            'id_asignatura' => '2',
            'jornada' => 'Diurna',
            'hora_inicio' => '07:30',
            'hora_final' => '10:30',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
    }
}
