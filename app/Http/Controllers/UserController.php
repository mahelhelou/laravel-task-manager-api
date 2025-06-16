<?php
namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{

    public function getProfile(string $id)
    {
        $user = User::findOrFail($id);

        // Access profile relationship (assumes hasOne or hasOneThrough)
        $profile = $user->profile;

        return response()->json($profile, 200);
    }

    public function getUserTasks(string $id)
    {
        $user = User::findOrFail($id);

        $tasks = $user->tasks;
        return response()->json($tasks, 200);
    }

    // Return a list of sample users
    public function userList()
    {
        $users = [
            ['id' => 1, 'name' => 'Omar'],
            ['id' => 2, 'name' => 'Hazem'],
            ['id' => 3, 'name' => 'Hayat'],
        ];

        return response()->json($users);
    }

    // Check if a user can join based on ID
    public function checkUser($id)
    {
        if ($id <= 10) {
            return response()->json(["message" => "Welcome! You have a seat."]);
        }

        return response()->json(["message" => "Sorry! You can't join us today."], 403);
    }
}
