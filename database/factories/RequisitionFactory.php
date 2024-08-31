<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Requisition>
 */
class RequisitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'requisition_date' => fake()->dateTimeThisYear(),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
            'user_id' => fake()->numberBetween(1, 10),
        ];
    }
}
