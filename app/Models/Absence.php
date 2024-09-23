<?php

namespace App\Models;

use Database\Factories\AbsenceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $motif_id
 * @property string $date_debut
 * @property string $date_fin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Motif $motif
 * @property-read \App\Models\User $user
 *
 * @method static \Database\Factories\AbsenceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Absence newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Absence newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Absence query()
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereDateDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereDateFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereMotifId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Absence extends Model
{
    /** @use HasFactory<AbsenceFactory>  */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'motif_id',
        'date_debut',
        'date_fin',
        'status'
    ];


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
