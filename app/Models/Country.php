<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';

    public function translates(): HasMany
    {
        return $this->hasMany(CountryI18n::class);
    }

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }

    public function persons(): HasMany
    {
        return $this->hasMany(Person::class);
    }
}
