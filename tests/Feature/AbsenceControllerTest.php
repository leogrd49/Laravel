<?php

namespace Tests\Feature;

use App\Mail\InfoMail;
use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AbsenceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_route_for_admin()
    {
        $admin = User::factory()->create(['admin' => true]);
        $response = $this->actingAs($admin)->get('/absence');
        $response->assertStatus(200);
        $response->assertViewHas('absences');
    }

    public function test_index_route_for_regular_user()
    {
        $user = User::factory()->create(['admin' => false]);
        $response = $this->actingAs($user)->get('/absence');
        $response->assertStatus(200);
        $response->assertViewHas('absences');
    }

    public function test_create_route_for_admin()
    {
        $admin = User::factory()->create(['admin' => true]);
        $response = $this->actingAs($admin)->get('/absence/create');
        $response->assertStatus(200);
        $response->assertViewHas(['users', 'motifs']);
    }

    public function test_create_route_for_regular_user()
    {
        $user = User::factory()->create(['admin' => false]);
        $response = $this->actingAs($user)->get('/absence/create');
        $response->assertStatus(200);
        $response->assertViewHas(['users', 'motifs']);
    }

    public function test_store_absence_as_admin()
    {
        Mail::fake();
        $admin = User::factory()->create(['admin' => true]);
        $user = User::factory()->create();
        $motif = Motif::factory()->create();

        $response = $this->actingAs($admin)->post('/absence', [
            'user_id' => $user->id,
            'motif_id' => $motif->id,
            'date_debut' => '2023-01-01',
            'date_fin' => '2023-01-05',
        ]);

        $response->assertRedirect(route('absence.index'));
        $this->assertDatabaseHas('absences', [
            'user_id' => $user->id,
            'motif_id' => $motif->id,
        ]);
        Mail::assertSent(InfoMail::class, 2); // One for user, one for admin
    }

    public function test_store_absence_as_regular_user_for_self()
    {
        Mail::fake();
        $user = User::factory()->create(['admin' => false]);
        $motif = Motif::factory()->create();

        $response = $this->actingAs($user)->post('/absence', [
            'user_id' => $user->id,
            'motif_id' => $motif->id,
            'date_debut' => '2023-01-01',
            'date_fin' => '2023-01-05',
        ]);

        $response->assertRedirect(route('absence.index'));
        $this->assertDatabaseHas('absences', [
            'user_id' => $user->id,
            'motif_id' => $motif->id,
        ]);
        Mail::assertSent(InfoMail::class, 2); // One for user, one for admin
    }

    public function test_store_absence_as_regular_user_for_other()
    {
        $user = User::factory()->create(['admin' => false]);
        $otherUser = User::factory()->create();
        $motif = Motif::factory()->create();

        $response = $this->actingAs($user)->post('/absence', [
            'user_id' => $otherUser->id,
            'motif_id' => $motif->id,
            'date_debut' => '2023-01-01',
            'date_fin' => '2023-01-05',
        ]);

        $response->assertRedirect(route('absence.index'));
        $response->assertSessionHas('error', 'Vous ne pouvez pas créer une absence pour un autre utilisateur.');
        $this->assertDatabaseMissing('absences', [
            'user_id' => $otherUser->id,
            'motif_id' => $motif->id,
        ]);
    }

    public function test_store_absence_with_invalid_data()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/absence', [
            'user_id' => $user->id,
            'motif_id' => 999, // Invalid motif_id
            'date_debut' => '2023-01-01',
            'date_fin' => '2022-12-31', // End date before start date
        ]);

        $response->assertSessionHasErrors(['motif_id', 'date_fin']);
    }

    public function test_edit_route_as_admin()
    {
        $admin = User::factory()->create(['admin' => true]);
        $absence = Absence::factory()->create();
        $response = $this->actingAs($admin)->get("/absence/{$absence->id}/edit");
        $response->assertStatus(200);
        $response->assertViewHas(['absence', 'users', 'motifs']);
    }

    public function test_edit_route_as_user_own_absence()
    {
        $user = User::factory()->create(['admin' => false]);
        $absence = Absence::factory()->create(['user_id' => $user->id, 'status' => 'en_attente']);
        $response = $this->actingAs($user)->get("/absence/{$absence->id}/edit");
        $response->assertStatus(200);
    }

    public function test_edit_route_as_user_other_absence()
    {
        $user = User::factory()->create(['admin' => false]);
        $absence = Absence::factory()->create(['status' => 'en_attente']);
        $response = $this->actingAs($user)->get("/absence/{$absence->id}/edit");
        $response->assertRedirect(route('absence.index'));
        $response->assertSessionHas('error', 'Vous ne pouvez pas modifier cette absence.');
    }

    public function test_edit_route_as_user_validated_absence()
    {
        $user = User::factory()->create(['admin' => false]);
        $absence = Absence::factory()->create(['user_id' => $user->id, 'status' => 'valide']);
        $response = $this->actingAs($user)->get("/absence/{$absence->id}/edit");
        $response->assertRedirect(route('absence.index'));
        $response->assertSessionHas('error', 'Vous ne pouvez pas modifier cette absence.');
    }

    public function test_update_absence_as_admin()
    {
        $admin = User::factory()->create(['admin' => true]);
        $absence = Absence::factory()->create();
        $newMotif = Motif::factory()->create();

        $response = $this->actingAs($admin)->put("/absence/{$absence->id}", [
            'user_id' => $absence->user_id,
            'motif_id' => $newMotif->id,
            'date_debut' => '2023-02-01',
            'date_fin' => '2023-02-05',
            'status' => 'valide',
        ]);

        $response->assertRedirect(route('absence.index'));
        $this->assertDatabaseHas('absences', [
            'id' => $absence->id,
            'motif_id' => $newMotif->id,
            'date_debut' => '2023-02-01',
            'date_fin' => '2023-02-05',
            'status' => 'valide',
        ]);
    }

    public function test_update_absence_as_user_own_absence()
    {
        $user = User::factory()->create(['admin' => false]);
        $absence = Absence::factory()->create(['user_id' => $user->id, 'status' => 'en_attente']);
        $newMotif = Motif::factory()->create();

        $response = $this->actingAs($user)->put("/absence/{$absence->id}", [
            'user_id' => $user->id,
            'motif_id' => $newMotif->id,
            'date_debut' => '2023-02-01',
            'date_fin' => '2023-02-05',
        ]);

        $response->assertRedirect(route('absence.index'));
        $this->assertDatabaseHas('absences', [
            'id' => $absence->id,
            'motif_id' => $newMotif->id,
            'date_debut' => '2023-02-01',
            'date_fin' => '2023-02-05',
        ]);
    }

    public function test_update_absence_as_user_other_absence()
    {
        $user = User::factory()->create(['admin' => false]);
        $absence = Absence::factory()->create(['status' => 'en_attente']);

        $response = $this->actingAs($user)->put("/absence/{$absence->id}", [
            'user_id' => $absence->user_id,
            'motif_id' => $absence->motif_id,
            'date_debut' => '2023-02-01',
            'date_fin' => '2023-02-05',
        ]);

        $response->assertRedirect(route('absence.index'));
        $response->assertSessionHas('error', 'Vous ne pouvez pas modifier cette absence.');
    }

    public function test_update_absence_as_user_validated_absence()
    {
        $user = User::factory()->create(['admin' => false]);
        $absence = Absence::factory()->create(['user_id' => $user->id, 'status' => 'valide']);

        $response = $this->actingAs($user)->put("/absence/{$absence->id}", [
            'user_id' => $user->id,
            'motif_id' => $absence->motif_id,
            'date_debut' => '2023-02-01',
            'date_fin' => '2023-02-05',
        ]);

        $response->assertRedirect(route('absence.index'));
        $response->assertSessionHas('error', 'Vous ne pouvez pas modifier cette absence.');
    }

    public function test_destroy_absence_as_admin()
    {
        Mail::fake();
        $admin = User::factory()->create(['admin' => true]);
        $absence = Absence::factory()->create();

        $response = $this->actingAs($admin)->delete("/absence/{$absence->id}");

        $response->assertRedirect(route('absence.index'));
        $this->assertDatabaseMissing('absences', ['id' => $absence->id]);
        Mail::assertSent(InfoMail::class);
    }

    public function test_destroy_absence_as_user_own_absence()
    {
        Mail::fake();
        $user = User::factory()->create(['admin' => false]);
        $absence = Absence::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete("/absence/{$absence->id}");

        $response->assertRedirect(route('absence.index'));
        $this->assertDatabaseMissing('absences', ['id' => $absence->id]);
        Mail::assertSent(InfoMail::class);
    }

    public function test_destroy_absence_as_user_other_absence()
    {
        $user = User::factory()->create(['admin' => false]);
        $otherUser = User::factory()->create();
        $absence = Absence::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->actingAs($user)->delete("/absence/{$absence->id}");

        $response->assertRedirect(route('absence.index'));
        $response->assertSessionHas('error', 'Vous ne pouvez pas supprimer cette absence.');
        $this->assertDatabaseHas('absences', ['id' => $absence->id]);
    }
}
