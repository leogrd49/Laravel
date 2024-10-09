<?php

namespace Tests\Feature;

use App\Models\Motif;
use App\Models\User;
use App\Models\Absence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MotifTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_motif()
    {
        $motifData = [
            'libelle' => 'Test Motif',
            'description' => 'This is a test motif',
            'is-accessible-salarie' => true,
        ];

        $motif = Motif::create($motifData);

        $this->assertDatabaseHas('motifs', $motifData);
        $this->assertInstanceOf(Motif::class, $motif);
    }

    public function test_can_update_motif()
    {
        $motif = Motif::factory()->create();
        $updatedData = [
            'libelle' => 'Updated Motif',
            'description' => 'This is an updated motif',
            'is-accessible-salarie' => false,
        ];

        $motif->update($updatedData);

        $this->assertDatabaseHas('motifs', $updatedData);
    }

    public function test_can_delete_motif()
    {
        $motif = Motif::factory()->create();

        $motif->delete();

        $this->assertSoftDeleted($motif);
    }

    public function test_motif_has_absences_relation()
    {
        $motif = Motif::factory()->create();
        $absence = Absence::factory()->create(['motif_id' => $motif->id]);

        $this->assertTrue($motif->absences->contains($absence));
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $motif->absences);
    }

    public function test_motif_factory_creates_valid_instance()
    {
        $motif = Motif::factory()->create();

        $this->assertNotNull($motif->libelle);
        $this->assertNotNull($motif->description);
    }

    public function test_motif_has_correct_fillable_attributes()
    {
        $motif = new Motif();

        $this->assertEquals(['libelle', 'is-accessible-salarie', 'description'], $motif->getFillable());
    }

    public function test_can_retrieve_motif_with_absences()
    {
        $motif = Motif::factory()->create();
        Absence::factory()->count(3)->create(['motif_id' => $motif->id]);

        $retrievedMotif = Motif::with('absences')->find($motif->id);

        $this->assertCount(3, $retrievedMotif->absences);
    }
}
