<?php
namespace App\Http\Controllers;

class UserController extends Controller
{
    public function userList()
    {
        $users = [
            ['id' => 1, 'name' => 'Omar'],
            ['id' => 2, 'name' => 'Hazem'],
            ['id' => 3, 'name' => 'Hayat'],
        ];

        // foreach ($users as $user) {
        // echo $user['id'] . ' ' . $user['name'] . "\n";
        // }

        // return $users; // Returns json
        return response()->json($users);

    }

    public function checkUser($id)
    {
        if ($id <= 10) {
            return response()->json(["Message" => "Welcome! You have a seat."]);
        }

        return response()->json(["Message" => "Sorry! You can't join us today."], 403);
    }
}
