<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Persona;
use App\Models\Asignacion_Grupo;
use App\Models\Clase;
use App\Models\Grupo;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

class DirectorPermissionsTest extends TestCase
{
    use RefreshDatabase;

    protected $director;

    protected function setUp(): void
    {
        parent::setUp();

        // Migrar y ejecutar seeders
        Artisan::call('migrate');
        Artisan::call('db:seed', ['--class' => 'RoleSeeder']);

        // Crear el usuario Director y asignar el rol
        $this->director = User::factory()->create();
        $this->director->assignRole('Director');
    }

    public function test_director_puede_gestionar_recursos_excepto_personas()
{
    $this->actingAs($this->director);

    // Acceso permitido
    $response = $this->get(route('docente.index'));
    $response->assertStatus(200);

    $response = $this->post(route('docente.store'), [
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'password' => 'password123',
    ]);
    $response->assertStatus(302);

    // Acceso prohibido
    $response = $this->get(route('persona.index'));
    $response->assertStatus(403); // Prohibido
}


public function test_director_puede_generar_reportes()
{
    $user = User::factory()->create(); // Crear usuario
    $docente = Persona::factory()->create(['id_usuario' => $user->id]); // Crear docente asociado

    $grupo = Grupo::factory()->create(); // Crear grupo
    Asignacion_Grupo::factory()->create(['persona_id' => $docente->id, 'grupo_id' => $grupo->id]); // Crear asignación

    $clase = Clase::factory()->create(['grupoasignado_id' => $grupo->id, 'asistencia' => 'asistida']); // Crear clase

    // Actuar como el usuario director
    $this->actingAs($this->director);

    // Realizar la petición y verificar el resultado
    $response = $this->get(route('reporte.reporteClasePDF', ['id' => $clase->id]));
    $response->assertStatus(200);
}



}
