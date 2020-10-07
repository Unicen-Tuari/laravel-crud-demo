<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGuestCantCreateTask()
    {
        $response = $this->get(route('tasks.create'));
        $response->assertRedirect('login');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserRoleCantCreateTask()
    {
        $user = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($user)
                ->get(route('tasks.create'));
        $response->assertForbidden();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testManagerRoleCanCreateTask()
    {
        $user = User::factory()->create(['role' => 'manager']);
        $response = $this->actingAs($user)
            ->get(route('tasks.create'));
        $response->assertStatus(200);
    }
}
