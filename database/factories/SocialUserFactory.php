<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SocialUser>
 */
class SocialUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'provider_user_id' => fake()->unique()->uuid,
            'provider' => fake()->randomElement(['facebook', 'google', 'github']),

            'user_ulid' => User::factory(),
        ];
    }
}
