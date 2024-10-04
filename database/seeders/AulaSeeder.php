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
            'sede' => 'Principal',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Aula::create([
            'id' => 2,
            'nomenclatura' => 'A102',
            'sede' => 'Principal',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Aula::create([
            'id' => 3,
            'nomenclatura' => 'A103',
            'sede' => 'Simon Bolivar',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Aula::create([
            'id' => 4,
            'nomenclatura' => 'A303',
            'sede' => 'Simon Bolivar',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Aula::create([
            'id' => 5,
            'nomenclatura' => 'C103',
            'sede' => 'Parroquial',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
