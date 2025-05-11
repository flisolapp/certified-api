<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distro extends Model
{
    protected $table = 'distro';

    protected $fillable = [
        'name'
    ];

}
