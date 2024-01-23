<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Talk extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'talks';

    public function edition(): BelongsTo
    {
        return $this->belongsTo(Edition::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(TalkSubject::class);
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(TalkShift::class);
    }

    public function kind(): BelongsTo
    {
        return $this->belongsTo(TalkKind::class);
    }

    public function speakers(): HasMany
    {
        return $this->hasMany(Speaker::class);
    }
}
