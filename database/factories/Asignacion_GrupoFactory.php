<?php

namespace Database\Factories;

use App\Models\Asignacion_Grupo;
use App\Models\Grupo;
use App\Models\Asignatura;
use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;

class Asignacion_GrupoFactory extends Factory
{
    protected $model = Asignacion_Grupo::class;

    public function definition()
    {
        return [
            'grupo_id' => Grupo::factory(),         // Genera un Grupo asociado
            'asignatura_id' => Asignatura::factory(), // Genera una Asignatura asociada
            'persona_id' => Persona::factory(),     // Genera una Persona (docente) asociada
            'aula' => $this->faker->numberBetween(1, 50), // Número de aula aleatorio
            'sede' => $this->faker->randomElement(['Principal', 'Simon Bolivar', 'Parroquial']), // Sede aleatoria
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
