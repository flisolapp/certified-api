<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    // protected $table = 'collaborator';

    protected $fillable = [
        'edition_id', 'people_id', 'audited_at', 'audit_note', 'approved_at', 'confirmed_at', 'created_at', 'updated_at', 'removed_at'
    ];

    public function person()
    {
        return $this->belongsTo(People::class, 'people_id');
    }

}
