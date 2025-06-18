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
                'name'     => 'Mahmoud Elhelou',
                'email'    => 'mahmoud@example.com',
                'password' => Hash::make('password'), // 🔐 never use plain text in real projects
            ],
            [
                'name'     => 'Sara Ali',
                'email'    => 'sara@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name'     => 'Tariq Nassar',
                'email'    => 'tariq@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name'       => $user['name'],
                'email'      => $user['email'],
                'password'   => $user['password'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
