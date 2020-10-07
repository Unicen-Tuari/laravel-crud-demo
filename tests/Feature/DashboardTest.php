<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test del Dashboard de la aplicación como usuario.
     *
     * @return void
     */
    public function testCasSeeDashboardAsUser()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/dashboard');

        $response->assertStatus(200);
    }

    /**
     * Test del Dashboard de la aplicación.
     *
     * @return void
     */
    public function testGuestIsRedirectToLogin()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('login');
    }

}
