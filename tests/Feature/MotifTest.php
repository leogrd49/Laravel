<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Motif;
use App\Models\User;

class MotifTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_motif()
    {
        $admin = User::factory()->create(['admin' => true]);
        $motifData = [
            'libelle' => 'New Motif',
            'description' => 'This is a new motif'
        ];

        $response = $this->actingAs($admin)->post('/motif', $motifData);

        $response->assertStatus(302); // Assuming it redirects after creation
        $this->assertDatabaseHas('motifs', $motifData);
    }
}
