<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clase>
 */
class GrupoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'estudiantes_matriculados' => $this->faker->numberBetween(1, 50),
            'numero_grupo' => $this->faker->numberBetween(1, 100),  // Hora de inicio en formato de 24 horas
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
