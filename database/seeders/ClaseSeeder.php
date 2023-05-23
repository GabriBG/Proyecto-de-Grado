<?php

namespace Database\Seeders;

use App\Models\Clase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'aula_id' => '1',
            'modalidad' => 'Presencial',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Clase::create([
            'id' => 2,
            'grupoasignado_id' => '2',
            'horario_id' => '2',
            'aula_id' => '2',
            'modalidad' => 'Presencial',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
