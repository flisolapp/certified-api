<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'units';

    public function edition(): BelongsTo
    {
        return $this->belongsTo(Edition::class);
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

    public function schedules(): HasMany
    {
        return $this->hasMany(UnitSchedule::class);
    }

    public function organizers(): HasMany
    {
        return $this->hasMany(Organizer::class);
    }

    public function collaborators(): HasMany
    {
        return $this->hasMany(Collaborator::class);
    }

    public function speakers(): HasMany
    {
        return $this->hasMany(Speaker::class);
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function talks(): HasMany
    {
        return $this->hasMany(Talk::class);
    }
}
