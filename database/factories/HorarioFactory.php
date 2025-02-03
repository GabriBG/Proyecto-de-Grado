<?php

namespace Database\Factories;
use App\Models\Horario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clase>
 */
class HorarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $jornadas = ['diurna', 'sabanita'];
        return [
            'jornada' => $this->faker->randomElement($jornadas),
            'hora_inicio' => $this->faker->time('H:i'),  // Hora de inicio en formato de 24 horas
            'hora_final' => $this->faker->time('H:i'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
