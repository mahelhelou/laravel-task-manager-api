<?php
namespace App\Http\Controllers;

use App\Http\Requests\AddTasksToCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

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
        $category = Category::create($request->validated());

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
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
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
