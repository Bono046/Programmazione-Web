<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Race>
 */
class RaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Rally del ' . $this->faker->state(),
            'start_date' => $start = $this->faker->dateTimeBetween('now', '+1 month'),
            'end_date' => (clone $start)->modify('+1 week'),
        ];
    }
}
