<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TalkShiftI18n extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'talk_shifts_i18n';

    public $timestamps = false;

    public function parent(): BelongsTo
    {
        return $this->belongsTo(TalkShift::class);
    }
}
