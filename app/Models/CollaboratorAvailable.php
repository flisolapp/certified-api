<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaboratorAvailable extends Model
{
    protected $table = 'collaborator_available';

    protected $fillable = [
        'collaborator_id', 'collaborator_availability_id', 'created_at', 'updated_at', 'removed_at'
    ];

}
