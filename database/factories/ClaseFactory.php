<?php

namespace Database\Factories;

use App\Models\Clase;
use App\Models\Asignacion_Grupo;
use App\Models\Horario;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClaseFactory extends Factory
{
    protected $model = Clase::class;

    public function definition()
    {
        return [
            'grupoasignado_id' => Asignacion_Grupo::factory(), // Asume que tienes una relación con la tabla asignación de grupos
            'horario_id' => Horario::factory(),               // Asume que tienes una relación con la tabla horarios
            'fecha' => $this->faker->date(),                  // Genera una fecha aleatoria
            'observacionClase' => $this->faker->optional()->sentence(), // Genera una observación opcional
            'asistencia' => $this->faker->randomElement(['asistida', 'no asistida', 'pendiente']), // Estado de la asistencia
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
