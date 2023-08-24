<?php

namespace Database\Factories;

use App\Models\House;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entrance>
 */
class EntranceFactory extends Factory {

    public function definition(): array {
        return [
            'name' => $this->faker->name,
            'house_id'  => House::factory()
        ];
    }
}
