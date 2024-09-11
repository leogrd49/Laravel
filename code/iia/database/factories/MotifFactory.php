<?php

namespace Database\Factories;
use App\Models\Motif;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Motif>
 */
class MotifFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'libelle' => fake()->realText(10),
            'is_accessible_salarie' => $this->faker->boolean(chanceOfGettingTrue:60),
        ];
    }
}
