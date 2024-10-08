<?php

namespace Database\Factories;

use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class AbsenceFactory extends Factory
{
    protected $model = Absence::class;

    public function definition()
    {
        $dateDebut = Carbon::now()->addDays(random_int(0, 30));
        $dateFin = (clone $dateDebut)->addDays(random_int(1, 7));

        return [
            'motif_id' => Motif::factory(),
            'user_id' => User::factory(),
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
        ];
    }
}
