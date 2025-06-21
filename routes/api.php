<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hello', function () {
    return 'Hello, world!';
});

Route::get('/hello', [HelloController::class, 'hello']);
Route::get('/users', [UserController::class, 'userList']);
Route::get('/user/{id}', [UserController::class, 'checkUser']);

// Task related routes
/*
Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
Route::get('/tasks/{id}', [TaskController::class, 'show']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
*/

Route::post('/users/register', [UserController::class, 'register']);
Route::post('/users/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
// Apply all above routes' function on the Task resource
    // Route::apiResource('tasks', TaskController::class)->middleware('auth:sanctum');
    Route::apiResource('tasks', TaskController::class);

    // Pay attention to this /task NOT /tasks
    Route::get('task/all', [TaskController::class, 'getAllTasks'])->middleware('mustBeAnAdmin');
    Route::get('/user/{id}/tasks', [UserController::class, 'getUserTasks']);
    Route::get('/tasks/{id}/user', [TaskController::class, 'getTaskCreator']);
    Route::post('/tasks/{id}/categories', [TaskController::class, 'addCategoriesToTask']);
    Route::get('/tasks/{id}/categories', [TaskController::class, 'getCategoriesOfTask']);

// Profile related routes
    Route::apiResource('profile', ProfileController::class);

// Category related routes
    Route::apiResource('categories', CategoryController::class);
    Route::post('/categories/{id}/tasks', [CategoryController::class, 'addTasksToCategory']);
    Route::get('/categories/{id}/tasks', [CategoryController::class, 'getTasksOfCategory']);

// Route::prefix('categories')->group(function () {
//     Route::apiResource('/', CategoryController::class);
//     // Route::get('/{id}', [CategoryController::class, 'show']);
//     Route::post('/{id}/tasks', [CategoryController::class, 'addTasksToCategory']);
//     Route::get('/{id}/tasks', [CategoryController::class, 'getTasksOfCategory']);
// });

// User related routes
// Route::get('/user/{id}/profile', [UserController::class, 'getProfile']);
    // Route::post('/users/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/users/logout', [UserController::class, 'logout']);
});
