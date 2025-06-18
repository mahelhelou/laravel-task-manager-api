<?php
namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'title'       => 'Design Landing Page',
                'description' => null,
                'priority'    => 2,
                'user_id'     => 1,
            ],
            [
                'title'       => 'API Integration',
                'description' => 'Integrate external payment API into the checkout process.',
                'priority'    => 4,
                'user_id'     => 2,
            ],
            [
                'title'       => 'Write Unit Tests',
                'description' => 'Ensure all controllers are covered by unit tests.',
                'priority'    => 5,
                'user_id'     => 1,
            ],
            [
                'title'       => 'Database Optimization',
                'description' => 'Analyze and optimize slow queries in production.',
                'priority'    => 2,
                'user_id'     => 3,
            ],
            [
                'title'       => 'Deploy to Production',
                'description' => null,
                'priority'    => 1,
                'user_id'     => 2,
            ],
        ];

        foreach ($tasks as $task) {
            Task::create([
                'title'       => $task['title'],
                'description' => $task['description'],
                'priority'    => $task['priority'],
                'user_id'     => $task['user_id'],
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
