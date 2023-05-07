<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aula;

class AulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Aula::create([
            'id' => 1,
            'nomenclatura' => 'B302',
            'sede' => 'Norte',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Aula::create([
            'id' => 2,
            'nomenclatura' => 'C103',
            'sede' => 'Sur',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
