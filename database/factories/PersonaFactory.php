<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class PersonaFactory extends Factory
{
    protected $model = Persona::class;

    public function definition()
    {
        return [
            'id_usuario' => User::factory(),
            'documento_identidad' => $this->faker->unique()->numerify('###########'),  // Genera un número único de 11 dígitos
            'nombre' => $this->faker->firstName(),  // Genera un nombre
            'apellido' => $this->faker->lastName(),  // Genera un apellido
            'telefono' => $this->faker->phoneNumber(),  // Genera un número de teléfono
        ];
    }
}
