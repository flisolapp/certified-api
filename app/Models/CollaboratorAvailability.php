<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaboratorAvailability extends Model
{
    protected $table = 'collaborator_availability';

    protected $fillable = [
        'name'
    ];

}
