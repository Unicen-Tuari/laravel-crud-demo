<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function testGuestCantCreateTask()
    {
        $response = $this->get(route('tasks.create'));
        $response->assertRedirect('login');
    }

    public function testUserRoleCantCreateTask()
    {
        $user = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($user)
                ->get(route('tasks.create'));
        $response->assertForbidden();
    }

    public function testManagerRoleCanCreateTask()
    {
        $user = User::factory()->create(['role' => 'manager']);
        $response = $this->actingAs($user)
            ->get(route('tasks.create'));
        $response->assertStatus(200);
        $response->assertSee('Asegurate de incluir un nombre y descripción representativo.');
        
    }

    public function testAuthorCanViewTask()
    {
        $task = Task::factory()->create();
        $user = $task->author;
        $response = $this->actingAs($user)->get('tasks/'.$task->id);
        $response->assertStatus(200);
        $response->assertSee($task->name);
    }

    public function testAssigneeCanViewTask()
    {
        $task = Task::factory()->create();
        $user = $task->assignee;
        $response = $this->actingAs($user)->get('tasks/'.$task->id);
        $response->assertStatus(200);
        $response->assertSee($task->name);
    }

    public function testNotAuthorNorAssigneeCantViewTask()
    {
        $task = Task::factory()->create();
        $user = User::factory()->create(['role' => 'manager']);
        $response = $this->actingAs($user)->get('tasks/'.$task->id);
        $response->assertForbidden();
    }

    public function testStoreTask()
    {
        $user = User::factory()->create(['role' => 'manager']);
        $response = $this->actingAs($user)->post('tasks', 
        ['name' => 'My Task', 
        'description' => 'This is a description',
        'assigned_to' => $user->id
        ]);
        $response->assertRedirect('/tasks');
        $task = Task::first();
        $this->assertEquals($task->name, 'My Task');
        $this->assertEquals($task->description, 'This is a description');
        $this->assertEquals($task->assignee->id, $user->id);
    }
    
    public function testAuthorCanEditTask()
    {
        $task = Task::factory()->create();
        $user = $task->author;
        $response = $this->actingAs($user)->get('tasks/'.$task->id.'/edit/');
        $response->assertStatus(200);
        $response->assertSee($task->name);
    }

    public function testEditTask()
    {
        $task = Task::factory()->create();
        $user = $task->author;
        $response = $this->actingAs($user)->put('tasks/'.$task->id, 
        ['name' => 'My Task', 
        'description' => 'This is a description',
        'assigned_to' => $user->id
        ]);
        $task = Task::first();
        $this->assertEquals($task->name, 'My Task');
        $this->assertEquals($task->description, 'This is a description');
        $this->assertEquals($task->assignee->id, $user->id);
    }

    public function testDestroyTask()
    {
        $task = Task::factory()->create();
        $user = $task->author;
        $response = $this->actingAs($user)->delete('tasks/'.$task->id);
        $task = Task::all();
        $this->assertEquals($task->count(), 0);
    }

    public function testViewTasksList()
    {
        $task = Task::factory()->create();
        $user = $task->author;
        $response = $this->actingAs($user)->get('tasks');
        $response->assertSee(Str::limit($task->name,25));
        $response->assertSee($task->created_at);
    }



}
