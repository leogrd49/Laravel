<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motif extends Model
{
    use HasFactory;

    public function absences(){
        return $this->hasMany(Absence::class);  // Assuming Absence model has a foreign key 'motif_id' that references this model's 'id' field
    }
}
