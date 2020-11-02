<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Testing\MimeType;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function testAuthor()
    {
        $author = User::factory()->create();
        $task = Task::factory()->create(['created_by' => $author]);
        $this->assertEquals($author->id, $task->author->id);
    }

    public function testAssignee()
    {
        $assignee = User::factory()->create();
        $task = Task::factory()->create(['assigned_to' => $assignee]);
        $this->assertEquals($assignee->id, $task->assignee->id);
    }

    public function testCategory()
    {
        $category = Category::factory()->create();
        $task = Task::factory()->create(['category_id' => $category->id]);
        $this->assertEquals($category->id, $task->category->id);
    }

    public function testFileIsImage()
    {
        Storage::fake('public');
        $filename = 'test.png';
        $file = UploadedFile::fake()->image($filename);
        $path = Storage::disk('public')->putFile('files',$file);
        $task = Task::factory()->create(['file_path' => $path]);
        $this->assertTrue($task->file_is_image);
    }

    public function testFileIsNotImage()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->create('test.txt','1200', MimeType::get('txt'));
        $path = Storage::disk('public')->putFile('files',$file);
        $task = Task::factory()->create(['file_path' => $path]);
        $this->assertNotTrue($task->file_is_image);
    }
}
