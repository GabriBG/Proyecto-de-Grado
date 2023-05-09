<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call([UsersTableSeeder::class]);
        $this->call([PersonaSeeder::class]);
        $this->call([AsignaturaSeeder::class]);
        $this->call([GrupoSeeder::class]);
        $this->call([HorarioSeeder::class]);
        $this->call([AulaSeeder::class]);
        $this->call([AsignacionGruposSeeder::class]);
    }
}
