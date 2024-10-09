<?php

namespace Tests\Feature;

use App\Http\Requests\AbsenceRequest;
use App\Models\Motif;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class AbsenceRequestTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testValidationPasses()
    {
        $user = User::factory()->create();
        $motif = Motif::factory()->create();

        $data = [
            'user_id' => $user->id,
            'motif_id' => $motif->id,
            'date_debut' => '2023-01-01',
            'date_fin' => '2023-01-02',
        ];

        $request = new AbsenceRequest;
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($request->authorize());
        $this->assertTrue($validator->passes());
    }

    public function testUserIdIsRequired()
    {
        $motif = Motif::factory()->create();

        $data = [
            'motif_id' => $motif->id,
            'date_debut' => '2023-01-01',
            'date_fin' => '2023-01-02',
        ];

        $request = new AbsenceRequest;
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('user_id', $validator->errors()->toArray());
    }

    public function testMotifIdIsRequired()
    {
        $user = User::factory()->create();

        $data = [
            'user_id' => $user->id,
            'date_debut' => '2023-01-01',
            'date_fin' => '2023-01-02',
        ];

        $request = new AbsenceRequest;
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('motif_id', $validator->errors()->toArray());
    }

    public function testDateDebutIsBeforeDateFin()
    {
        $user = User::factory()->create();
        $motif = Motif::factory()->create();

        $data = [
            'user_id' => $user->id,
            'motif_id' => $motif->id,
            'date_debut' => '2023-01-02',
            'date_fin' => '2023-01-01',
        ];

        $request = new AbsenceRequest;
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('date_debut', $validator->errors()->toArray());
    }
}
