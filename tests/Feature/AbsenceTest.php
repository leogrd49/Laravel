<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Absence;
use App\Models\User;

class AbsenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_absence()
    {
        $user = User::factory()->create();
        $absenceData = [
            'user_id' => $user->id,
            'start_date' => '2023-01-01',
            'end_date' => '2023-01-05',
            'reason' => 'Vacation'
        ];

        $response = $this->actingAs($user)->post('/absence', $absenceData);

        $response->assertStatus(302); // Assuming it redirects after creation
        $this->assertDatabaseHas('absences', $absenceData);
    }
}
