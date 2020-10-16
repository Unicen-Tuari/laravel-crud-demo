<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Task;
use App\Models\Category;
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
}
