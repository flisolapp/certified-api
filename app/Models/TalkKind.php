<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TalkKind extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'talk_kinds';

    public $timestamps = false;

    public function translates(): HasMany
    {
        return $this->hasMany(TalkKindI18n::class);
    }
}
