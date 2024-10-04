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
            'jornada' => 'Mañana',
            'hora_inicio' => '8:30',
            'hora_final' => '10:00',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Horario::create([
            'id' => 2,
            'jornada' => 'Sabatina',
            'hora_inicio' => '7:45',
            'hora_final' => '8:30',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Horario::create([
            'id' => 3,
            'jornada' => 'Mañana',
            'hora_inicio' => '10:00',
            'hora_final' => '11:30',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Horario::create([
            'id' => 4,
            'jornada' => 'Sabatina',
            'hora_inicio' => '7:00',
            'hora_final' => '7:45',
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
