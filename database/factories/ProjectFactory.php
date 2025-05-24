<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => \App\Models\Client::factory(),
            'name' => $this->faker->domainName(),
            'description' => $this->faker->sentence,
            'rate' => $this->faker->randomFloat(2, 50, 500),
            'total_hours' => $this->faker->numberBetween(1, 100),
        ];
    }
}
