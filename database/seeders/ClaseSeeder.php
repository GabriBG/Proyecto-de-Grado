<?php

namespace Database\Seeders;

use App\Models\Clase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clase::create([
            'id' => 1,
            'grupoasignado_id' => '1',
            'horario_id' => '1',
            'modalidad' => 'presencial',
            'fecha' => Carbon::create(2023, 6, 3),
            'asistencia' => 'asistida',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Clase::create([
            'id' => 2,
            'grupoasignado_id' => '2',
            'horario_id' => '2',
            'modalidad' => 'presencial',
            'fecha' => Carbon::create(2023, 6, 6),
            'asistencia' => 'pendiente',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
