<?php

namespace App\Models;

use Database\Factories\MotifFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motif extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'libelle',
        'is_accessible_salarie',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_accessible_salarie' => 'boolean',
    ];

    /**
     * Define the relation with absences.
     *
     * @return HasMany
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
}
