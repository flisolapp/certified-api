<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    // protected $table = 'collaborator';

    protected $fillable = [
        'edition_id', 'person_id', 'audited_at', 'audit_note', 'approved', 'confirmed_at', 'created_at', 'updated_at', 'removed_at'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

}
