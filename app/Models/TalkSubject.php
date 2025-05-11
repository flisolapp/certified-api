<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TalkSubject extends Model
{
    protected $table = 'talk_subject';

    protected $fillable = [
        'name'
    ];

}
