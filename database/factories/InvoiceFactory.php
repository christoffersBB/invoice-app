<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_number' => $this->faker->unique()->numerify('INV-####'),
            'client_id' => \App\Models\Client::factory(),
            'project_id' => \App\Models\Project::factory(),
            'amount' => $this->faker->randomFloat(2, 100, 10000),
            'status' => $this->faker->randomElement(['Pending', 'Paid', 'Overdue']),
            'created_at' => $this->faker->dateTimeBetween('-2 month', 'now'),
            'updated_at' => now(),
        ];
    }
}
