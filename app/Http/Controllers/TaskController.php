<?php
namespace App\Http\Controllers;

use App\Http\Requests\AddCategoriesToTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a list of all users tasks (Admin)
     */
    public function getAllTasks()
    {
        $tasks = Task::all();

        return response()->json($tasks, 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                                      // $tasks = Task::all(); // Will return all users' tasks (Not wanted and insecure and lack of privacy)
        $tasks = Auth::user()->tasks; // From User.php (Model relationships)

        return response()->json($tasks, 200);
    }

    /**
     * Add categories to task
     */
    public function addCategoriesToTask(AddCategoriesToTaskRequest $request, string $taskId)
    {
        $task = Task::findOrFail($taskId);
        // $task->categories()->attach($request->validated()['categories']);
        // $task->categories()->attach($request->input('category_id'));
        // $task->categories()->attach($request->category_id);
        // $task->categories()->attach($request->validated()['category_id']);

        // More safe
        // $task->categories()->attach($request->input('category_id'));

        // Prevent duplicating categories for the same task
        $task->categories()->syncWithoutDetaching($request->input('category_id'));

        return response()->json(['message' => 'Successfully added categories to task.'], 201);
    }

    /**
     * Get categories of a specific task
     */
    public function getCategoriesOfTask($taskId)
    {
        $task       = Task::findOrFail($taskId);
        $categories = $task->categories;

        return response()->json($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        // Let the user logged in to create tasks directly (Remove the field from StoreTaskRequest)
        $user_id                   = Auth::user()->id;
        $incomingFields            = $request->validated();
        $incomingFields['user_id'] = $user_id;
        // $request->validated()['user_id'] = $user_id;
        $task = Task::create($incomingFields);

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $user_id = Auth::user()->id;
        $task    = Task::findOrFail($id);

        // Authorized ? Update task : show "Unauthenticated" message
        if ($task->user_id != $user_id) {
            return response()->json(['message' => 'Unauthorized.'], 200);
        }

        $task->update($request->validated());

        return response()->json($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json($task, 200);
    }

    public function getTaskCreator(string $id)
    {
        $task = Task::findOrFail($id);

        $user = $task->user;
        return response()->json($user, 200);
    }
}
