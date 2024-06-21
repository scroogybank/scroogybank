<?php

namespace Database\Factories;

use App\Models\AccountGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'description' => fake()->optional()->sentence,
            'icon' => fake()->optional()->imageUrl,
            'main_currency' => fake()->randomKey(config('money.currencies')),
            'original_balance' => fake()->numberBetween(0, 10_000),
            'archived' => fake()->boolean(10),
            'opening_date' => fake()->date(),

            'user_ulid' => User::factory(),
            'account_group_ulid' => AccountGroup::factory(),
        ];
    }
}
