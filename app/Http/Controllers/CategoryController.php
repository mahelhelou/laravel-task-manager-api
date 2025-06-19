<?php
namespace App\Http\Controllers;

use App\Http\Requests\AddTasksToCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                                                // $categories = Category::all(); // Returns all users' categories
        $categories = Auth::user()->categories; // Model's method

        return response()->json($categories, 200);
    }

    public function addTasksToCategory(AddTasksToCategoryRequest $request, string $categoryId)
    {
        $category = Category::findOrFail($categoryId);

        // $category->tasks()->attach($request->validated()['task_id']);
        // $category->tasks()->attach($request->input('task_id'));

        // Prevent duplicating tasks for the same category
        $category->tasks()->syncWithoutDetaching($request->input('task_id'));

        return response()->json(['message' => 'Successfully added tasks to category.'], 201);
    }

    /**
     * Get tasks of category
     */
    public function getTasksOfCategory(string $categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $tasks    = $category->tasks;

        return response()->json($tasks, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $incomingFields            = $request->validated();
        $incomingFields['user_id'] = Auth::user()->id;

        $category = Category::create($incomingFields);

        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);

        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $user_id  = Auth::user()->id;
        $category = Category::findOrFail($id);

        // Authorized (Category ownwer) ? Update category : Show "Unauthorized" message
        if ($category->user_id != $user_id) {
            return response()->json(['message' => 'Unauthorized.'], 200);
        }

        $category->update($request->validated());

        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json($category, 200);
    }
}
