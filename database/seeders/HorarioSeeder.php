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
            'hora_inicio' => '07:30',
            'hora_final' => '09:00',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Horario::create([
            'id' => 2,
            'jornada' => 'Tarde',
            'hora_inicio' => '02:30',
            'hora_final' => '03:30',
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
