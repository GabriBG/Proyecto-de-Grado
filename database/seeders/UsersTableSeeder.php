<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
    
        User::create([
            'id' => 1,
            'username' => 'GabrielBG',
            'email' => 'gabrielbg2218@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1qazxsw2'),
            'created_at' => now(),
            'updated_at' => now()
        ])->assignRole('Admin');

        User::create([
            'id' => 2,
            'username' => 'ASanchez ',
            'email' => 'AlejoSanchez@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('A.Sanchez2023'),
            'created_at' => now(),
            'updated_at' => now()
        ])->assignRole('Docente');

        User::create([
            'id' => 3,
            'username' => 'LAlvarez',
            'email' => 'LMontoya@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('L.Montoya2023'),
            'created_at' => now(),
            'updated_at' => now()
        ])->assignRole('Director');

    }
}
