<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->optional()->phoneNumber(),
            'document_number' => fake()->unique()->numerify('##########'),
            'address' => fake()->optional()->address(),
            'city' => fake()->optional()->city(),
            'status' => fake()->randomElement(['active','inactive']),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
