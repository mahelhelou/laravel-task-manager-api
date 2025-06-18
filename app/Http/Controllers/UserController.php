<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        // 1. Validate the request inputs (name, email, password)
        $request->validate([
            'name'     => 'required|string|max:40',
            'email'    => 'required|string|email|max:40|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // 2. Create the request in the database
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Show a success/failure message
        return response()->json([
            'message' => "Welcome {$user['name']}! You have registered successfully.",
            'user'    => $user,
        ], 201);
    }

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
