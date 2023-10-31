<?php

namespace Database\Factories;

use App\Models\Device;
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
            'name'     => fake()->unique()->name,
            'type'     => rand(1, count(Device::TYPES)),
            'model'    => fake()->colorName,
            'status'   => 1,
            'location' => fake()->word,
            'user_id'  => null,
        ];
    }
}
