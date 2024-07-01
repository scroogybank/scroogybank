<?php

namespace Database\Factories;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\Models\Account;
use App\Models\Category;
use App\Models\Store;
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
            'external_id' => fake()->optional()->uuid(),

            'user_ulid' => User::factory(),
            'account_ulid' => Account::factory(),
            'category_ulid' => Category::factory(),
            'store_ulid' => Store::factory(),
        ];
    }

    /**
     * Create a transaction not assigned to a store.
     *
     * @return Factory
     */
    public function withoutStore(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'store_ulid' => null,
        ]);
    }
}
