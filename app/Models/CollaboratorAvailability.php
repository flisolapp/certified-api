<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaboratorAvailability extends Model
{
    // protected $table = 'collaborator_availability';

    protected $fillable = [
        'collaborator_id', 'collaborator_shift_id', 'created_at', 'updated_at', 'removed_at'
    ];

}
