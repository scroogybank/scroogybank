<?php

namespace Database\Factories;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
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
            'amount' => new Money(
                fake()->numberBetween(100, 1000),
                new Currency(fake()->randomKey(config('money.currencies')))
            ),
            'note' => fake()->optional()->text(),
            'registered_at' => fake()->dateTime(),
            'status' => fake()->optional()->randomElement(['cleared', 'reconciled']),

            'user_ulid' => User::factory(),
        ];
    }
}
