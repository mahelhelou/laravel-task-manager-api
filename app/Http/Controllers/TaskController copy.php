<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    // Code written manually using
    // Command: php artisan make:controller TaskController
    // Get all tasks
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks, 200);
    }

    // Create a new task
    // We have moved validation rules to StoreTaskRequest (php artisan make:request StoreTaskRequest)
    // public function store(Request $request)
    public function store(StoreTaskRequest $request)
    {
        // $task = Task::create([
        //     'title'       => $request->title,
        //     'description' => $request->description,
        //     'priority'    => $request->priority,
        // ]);

        // 1. Validate the incoming request fields using validation rules
        // Benefit: Will print meaningful error messages

        // Moved to StoreTaskRequest in /app/Requests/StoreTaskRequest
        // $incomingFields = $request->validate([
        //     'title'       => 'required|string|max:60',
        //     'description' => 'string|nullable',
        //     'priority'    => 'required|integer|min:1|max:5',
        // ]);

        // $task = Task::create($incomingFields);
        $task = Task::create($request->validated());
        return response()->json($task);

        // 2. Create a new task based on validated incoming fields

        return response()->json($task, 201);
    }

    // Update an existing task
    // public function update(Request $request, $id) {}
    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        // $task->update($request->all()); // Dangerous
        // $task->update($request->only('title', 'description', 'priority'));

        // 1. Validate the incoming fields request
        // $incomingFields = $request->validate([
        //     'title'       => 'sometimes|string|max:60',
        //     'description' => 'sometimes',
        //     'priority'    => 'sometimes|integer|min:1|max:5',
        // ]);

        // 2. Update the task in the DB
        // $task->update($incomingFields);
        $task->update($request->validated());

        return response()->json($task, 200);
    }

    // Remove task from the DB
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(null, 204);
    }

    // Get task by id
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return response()->json($task, 200);
    }
}
