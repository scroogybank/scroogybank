<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kind' => fake()->randomElement(['expense', 'income', 'transfer', 'receivables', 'payables', 'system']),
            'name' => fake()->words(5, true),
            'icon' => fake()->optional()->imageUrl,
            'color' => fake()->optional()->hexColor(),
            'visible' => fake()->boolean(90),

            'user_ulid' => User::factory(),
        ];
    }
}
