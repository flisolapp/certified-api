<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Edition extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'editions';

    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }

    public function organizers(): HasMany
    {
        return $this->hasMany(Organizer::class);
    }

    public function collaborators(): HasMany
    {
        return $this->hasMany(Collaborator::class);
    }
}
