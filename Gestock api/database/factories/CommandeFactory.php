<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\commende>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['pending', 'completed', 'canceled']),
            'lest_product' => $this->faker->word,
            'in_client' => \App\Models\Client::factory(), // Link to a client.
            'in_user' => \App\Models\User::factory(), // Link to a user.
        ];

    }
}
