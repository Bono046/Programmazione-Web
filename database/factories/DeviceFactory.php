<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'imei' => strtoupper($this->faker->bothify('###############')),
            'serial' => $this->faker->numerify('DEV-####'),
            'iccid' => $this->faker->numerify('####################')
        ];
    }
}
