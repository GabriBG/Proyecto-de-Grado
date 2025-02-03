<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clase>
 */
class AsignaturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->numberBetween(1, 100),
            'nombre' => $this->faker->sentence(),  // Hora de inicio en formato de 24 horas
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
