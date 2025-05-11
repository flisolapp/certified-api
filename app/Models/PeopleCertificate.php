<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeopleCertificate extends Model
{
    // protected $table = 'person_certificate';

    protected $fillable = [
        'people_id', 'edition_id', 'organizer_id', 'collaborator_id', 'talk_id', 'participant_id', 'name', 'federal_code', 'code', 'name_only', 'sent_at', 'last_view_at', 'created_at', 'updated_at', 'removed_at'
    ];

    public function person()
    {
        return $this->belongsTo(People::class, 'people_id');
    }

    public function edition()
    {
        return $this->belongsTo(Edition::class, 'edition_id');
    }

}
