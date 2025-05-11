<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaboratorArea extends Model
{
    protected $table = 'collaborator_area';

    protected $fillable = [
        'collaborator_id', 'collaboration_area_id', 'created_at', 'updated_at', 'removed_at'
    ];

}
