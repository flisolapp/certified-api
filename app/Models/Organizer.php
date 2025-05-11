<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    // protected $table = 'organizer';

    protected $fillable = [
        'edition_id', 'person_id', 'created_at', 'updated_at', 'removed_at'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

}
