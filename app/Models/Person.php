<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'persons';

    public function children(): HasMany
    {
        return $this->hasMany(Person::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function addressCityById(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function addressStateById(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function addressCountryById(): BelongsTo
    {
        return $this->belongsTo(Country::class);
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
