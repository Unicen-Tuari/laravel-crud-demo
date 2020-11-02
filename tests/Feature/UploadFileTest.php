<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadFileTest extends TestCase
{

    public function testManagerCanUploadFile()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('test.txt','1200');

        $task = Task::factory()->make()->toArray();
        $task['fileToUpload'] = $file;

        $user = User::factory()->create(['role' => 'manager']);

        $response = $this->actingAs($user)->post('/tasks', $task);

        $response->assertRedirect('/tasks');

        // Assert the file was stored...
        Storage::disk('public')->assertExists('files/' . $file->hashName());

        $task = Task::first();
        $this->assertNotEmpty($task->file_path);

    }
}
