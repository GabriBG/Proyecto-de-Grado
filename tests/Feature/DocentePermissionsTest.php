<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

class DocentePermissionsTest extends TestCase
{
    use RefreshDatabase;

    protected $docente;

    protected function setUp(): void
    {
        parent::setUp();

        // Migrar y ejecutar seeders
        Artisan::call('migrate');
        Artisan::call('db:seed', ['--class' => 'RoleSeeder']);

        // Crear el usuario Docente y asignar el rol
        $this->docente = User::factory()->create();
        $this->docente->assignRole('Docente');
    }

    public function test_docente_solo_gestiona_clases_y_asistencia()
{
    $this->actingAs($this->docente);

    $response = $this->get(route('clase.index'));
    $response->assertStatus(200);

    $response = $this->post(route('clase.store'), [
        'grupo_id' => 1,
        'asignatura_id' => 1,
        'fecha' => now(),
        'horario' => '08:00-10:00',
    ]);
    $response->assertStatus(302);

    // Acceso prohibido
    $response = $this->get(route('persona.index'));
    $response->assertStatus(403);

    $response = $this->get(route('grupo.index'));
    $response->assertStatus(403);
}


public function test_docente_no_puede_generar_reportes()
{
    $this->actingAs($this->docente);

    $response = $this->get(route('reporte.reporteDocente', ['id' => 1]));
    $response->assertStatus(403); // No autorizado
}

}
