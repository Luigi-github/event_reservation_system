<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->text(),
            'date' => fake()->date(),
            'location' => fake()->city(),
            'price' => fake()->randomFloat(),
            'attendee_limit' => fake()->numberBetween(100, 10000),
            'created_at' => fake()->date(),
            'updated_at' => fake()->date()
        ];
    }
}
