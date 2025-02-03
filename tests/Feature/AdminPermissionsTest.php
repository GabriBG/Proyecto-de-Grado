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

class AdminPermissionsTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Migrar y ejecutar seeders
        Artisan::call('migrate');
        Artisan::call('db:seed', ['--class' => 'RoleSeeder']);

        // Crear el usuario Admin y asignar el rol
        $this->admin = User::factory()->create();
        $this->admin->assignRole('Admin');

    }

    public function test_admin_puede_gestionar_todos_los_recursos()
    {
        $this->actingAs($this->admin);

        // Probar acceso a rutas de gestión de personas
        $response = $this->get(route('persona.index'));
        $response->assertStatus(200);

        $response = $this->post(route('persona.store'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'role' => 'Docente',
        ]);
        $response->assertStatus(302); // Redirección después de guardar

        // Probar acceso a rutas de gestión de grupos
        $response = $this->get(route('grupo.index'));
        $response->assertStatus(200);
    }

    public function test_admin_puede_generar_reportes()
    {
        $user = User::factory()->create(); // Crear usuario
        $docente = Persona::factory()->create(['id_usuario' => $user->id]); // Crear docente asociado

        $grupo = Grupo::factory()->create(); // Crear grupo
        Asignacion_Grupo::factory()->create(['persona_id' => $docente->id, 'grupo_id' => $grupo->id]); // Crear asignación

        Clase::factory()->create(['grupoasignado_id' => $grupo->id, 'asistencia' => 'no asistida']); // Crear clase

        $this->actingAs($this->admin); // Autenticar como Admin
        $response = $this->get(route('reporte.reporteDocente', ['id' => $docente->id]));
        $response->assertStatus(200);
    }


}
