<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pivotData = [
            ['category_id' => 1, 'task_id' => 1],
            ['category_id' => 2, 'task_id' => 1],
            ['category_id' => 1, 'task_id' => 2],
            ['category_id' => 3, 'task_id' => 3],
            ['category_id' => 2, 'task_id' => 4],
            ['category_id' => 1, 'task_id' => 5],
        ];

        DB::table('category_task')->insert($pivotData);
    }
}
