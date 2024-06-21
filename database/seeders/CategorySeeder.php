<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory(10)
            ->recycle(User::factory()->create())
            ->hasSubCategories(fake()->numberBetween(1, 5))
            ->create();
    }
}
