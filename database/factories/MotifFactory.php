<?php

namespace Database\Factories;

use App\Models\Motif;
use Illuminate\Database\Eloquent\Factories\Factory;

class MotifFactory extends Factory
{
    protected $model = Motif::class;

    public function definition()
    {
        return [
            'libelle' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
    }
}
