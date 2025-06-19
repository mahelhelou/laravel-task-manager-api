<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Personal', 'user_id' => 1],
            ['name' => 'Work', 'user_id' => 1],
            ['name' => 'Life', 'user_id' => 2],
            ['name' => 'Health', 'user_id' => 2],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name'    => $category['name'],
                'user_id' => $category['user_id'],
            ]);
        }
    }
}
