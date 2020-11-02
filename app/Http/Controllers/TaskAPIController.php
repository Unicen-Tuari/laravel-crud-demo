<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskAPIController extends Controller
{
    //

    public function index(Request $request){
        $tasks = Task::where('assigned_to', $request->user()->id)->get();

        return TaskResource::collection($tasks);
    }
}
