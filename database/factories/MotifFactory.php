<?php

namespace Database\Factories;

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
            'Libelle' => fake()->realText(20),
            'is-accessible-salarie' => fake()->boolean(chanceOfGettingTrue: 50),
        ];
    }
}
