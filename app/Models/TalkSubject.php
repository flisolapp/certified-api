<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TalkSubject extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'talk_subjects';

    public $timestamps = false;

    public function translates(): HasMany
    {
        return $this->hasMany(TalkSubjectI18n::class);
    }
}
