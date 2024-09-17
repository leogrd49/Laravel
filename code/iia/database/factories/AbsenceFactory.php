<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Motif;
use App\Models\Absence;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absence>
 */
class AbsenceFactory extends Factory
{
    protected $model = Absence::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Générer une date de début
        $startDate = $this->faker->dateTimeBetween('-1 year', 'now');

        // Générer une date de fin qui est après la date de début
        $endDate = $this->faker->dateTimeBetween($startDate, '+1 month');

        return [
            'motif_id' => Motif::inRandomOrder()->value('id'),
            'user_id' => User::inRandomOrder()->value('id'),
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }
}
