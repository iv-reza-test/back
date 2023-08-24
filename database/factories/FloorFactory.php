<?php

namespace Database\Factories;

use App\Models\Entrance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Floor>
 */
class FloorFactory extends Factory {
    public function definition(): array {
        return [
            'name' => $this->faker->name,
            'entrance_id' => Entrance::factory()
        ];
    }
}
