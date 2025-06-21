<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'     => 'admin',
                'email'    => 'admin@example.com',
                'isAdmin'  => 1,
                'password' => '123',
            ],
            [
                'name'     => 'sara',
                'email'    => 'sara@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name'     => 'tariq',
                'email'    => 'tariq@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name'       => $user['name'],
                'email'      => $user['email'],
                'isAdmin'    => $user['isAdmin'] ?? 0,
                'password'   => $user['password'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
