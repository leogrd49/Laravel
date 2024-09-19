<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Database\Factories\MotifFactory;

/**
 * @property int $id
 * @property string $Libelle
 * @property bool $is_accessible_salarie
 */
class Motif extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Définir la relation avec les absences.
     *
     * @return HasMany<Absence>
     */
    public function absences(): HasMany
    {
        return $this->hasMany(Absence::class, 'motif_id');
    }

    /**
     * Get the factory instance for the model.
     *
     * @return MotifFactory
     */
    protected static function newFactory()
    {
        return \Database\Factories\MotifFactory::new();
    }

    /**
     * Get the casts for the model.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_accessible_salarie' => 'boolean',
            'field_name' => 'array',
        ];
    }
}
