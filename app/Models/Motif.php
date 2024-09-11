<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $Libelle
 * @property bool $is-accessible-salarie
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Motif newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Motif newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Motif query()
 * @method static \Illuminate\Database\Eloquent\Builder|Motif whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motif whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motif whereIsAccessibleSalarie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motif whereLibelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motif whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Motif extends Model
{
    use HasFactory;

    protected function casts():array {
        return[
            'is-accessible-salarie' => 'boolean',
        ];
    }
}
