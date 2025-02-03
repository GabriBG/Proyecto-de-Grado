<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class LoginFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_puede_logearse_con_credenciales_validas()
    {
        // Crea un usuario en la base de datos de prueba
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Simula el login
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // Verifica si el usuario fue autenticado y redirigido correctamente
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_usuario_no_puede_logearse_con_credenciales_invalidas()
    {
        // Simula intento de login con credenciales incorrectas
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        // Verifica que no se haya autenticado y que haya redirección
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
}
