<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Database\Factories\AbsenceFactory;

/**
 * @property int $user_id
 * @property int $motif_id
 * @property string $date_debut
 * @property string $date_fin
 */
class Absence extends Model
{
    /** @use HasFactory<AbsenceFactory>  */
    use HasFactory;

    /**
     * Définir la relation avec l'utilisateur.
     *
     * @return BelongsTo<User, Absence>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Définir la relation avec le motif.
     *
     * @return BelongsTo<Motif, Absence>
     */
    public function motif(): BelongsTo
    {
        return $this->belongsTo(Motif::class, 'motif_id');
    }

    /**
     * Get the factory instance for the model.
     *
     * @return AbsenceFactory
     */
    protected static function newFactory()
    {
        return \Database\Factories\AbsenceFactory::new();
    }
}
