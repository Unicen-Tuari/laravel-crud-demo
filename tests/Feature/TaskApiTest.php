<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_read_assigned_tasks()
    {
        $user = User::factory()->create();

        $task = Task::factory()->create(
            [
                "assigned_to" => $user->id
            ]
        );

        Sanctum::actingAs(
            $user,
            ['view-tasks']
        );

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment([
            "assigned_to" => $user->id
        ]);
    }

    public function test_user_cant_read_unassigned_tasks()
    {
        $taskUser = User::factory()->create();

        $task = Task::factory()->create(
            [
                "assigned_to" => $taskUser->id
            ]
        );

        $apiUser = User::factory()->create();
        Sanctum::actingAs(
            $apiUser,
            ['view-tasks']
        );

        $response = $this->getJson('/api/tasks');
        $response->assertStatus(200);
        $response->assertJsonCount(0, 'data');
    }
}
