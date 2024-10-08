<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Motif;

class MotifControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_route()
    {
        $admin = User::factory()->create(['admin' => true]);
        $response = $this->actingAs($admin)->get('/motif');
        $response->assertStatus(200);
        $response->assertViewHas('motifs');
    }

    public function test_create_route()
    {
        $admin = User::factory()->create(['admin' => true]);
        $response = $this->actingAs($admin)->get('/motif/create');
        $response->assertStatus(200);
    }

    public function test_store_motif()
    {
        $admin = User::factory()->create(['admin' => true]);
        $motifData = [
            'libelle' => 'Test Motif',
            'is_accessible_salarie' => '1',
        ];

        $response = $this->actingAs($admin)->post('/motif', $motifData);

        $response->assertRedirect(route('motif.index'));
        $this->assertDatabaseHas('motifs', [
            'libelle' => 'Test Motif',
            'is_accessible_salarie' => true,
        ]);
    }

    public function test_store_motif_with_invalid_data()
    {
        $admin = User::factory()->create(['admin' => true]);
        $motifData = [
            'libelle' => '', // Invalid: empty libelle
            'is_accessible_salarie' => '1',
        ];

        $response = $this->actingAs($admin)->post('/motif', $motifData);

        $response->assertSessionHasErrors('libelle');
    }

    public function test_show_motif()
    {
        $admin = User::factory()->create(['admin' => true]);
        $motif = Motif::factory()->create();

        $response = $this->actingAs($admin)->get("/motif/{$motif->id}");

        $response->assertStatus(200);
        $response->assertViewHas('motif');
    }

    public function test_edit_route()
    {
        $admin = User::factory()->create(['admin' => true]);
        $motif = Motif::factory()->create();

        $response = $this->actingAs($admin)->get("/motif/{$motif->id}/edit");

        $response->assertStatus(200);
        $response->assertViewHas('motif');
    }

    public function test_update_motif()
    {
        $admin = User::factory()->create(['admin' => true]);
        $motif = Motif::factory()->create();
        $updatedData = [
            'libelle' => 'Updated Motif',
            'is_accessible_salarie' => '0',
        ];

        $response = $this->actingAs($admin)->put("/motif/{$motif->id}", $updatedData);

        $response->assertRedirect(route('motif.index'));
        $this->assertDatabaseHas('motifs', [
            'id' => $motif->id,
            'libelle' => 'Updated Motif',
            'is_accessible_salarie' => false,
        ]);
    }

    public function test_update_motif_with_invalid_data()
    {
        $admin = User::factory()->create(['admin' => true]);
        $motif = Motif::factory()->create();
        $updatedData = [
            'libelle' => '', // Invalid: empty libelle
            'is_accessible_salarie' => '0',
        ];

        $response = $this->actingAs($admin)->put("/motif/{$motif->id}", $updatedData);

        $response->assertSessionHasErrors('libelle');
    }

    public function test_destroy_motif()
    {
        $admin = User::factory()->create(['admin' => true]);
        $motif = Motif::factory()->create();

        $response = $this->actingAs($admin)->delete("/motif/{$motif->id}");

        $response->assertRedirect(route('motif.index'));
        $this->assertDatabaseMissing('motifs', ['id' => $motif->id]);
    }

    public function test_non_admin_cannot_access_motif_routes()
    {
        $user = User::factory()->create(['admin' => false]);
        $motif = Motif::factory()->create();

        $this->actingAs($user)->get('/motif')->assertForbidden();
        $this->actingAs($user)->get('/motif/create')->assertForbidden();
        $this->actingAs($user)->post('/motif', [])->assertForbidden();
        $this->actingAs($user)->get("/motif/{$motif->id}")->assertForbidden();
        $this->actingAs($user)->get("/motif/{$motif->id}/edit")->assertForbidden();
        $this->actingAs($user)->put("/motif/{$motif->id}", [])->assertForbidden();
        $this->actingAs($user)->delete("/motif/{$motif->id}")->assertForbidden();
    }
}
