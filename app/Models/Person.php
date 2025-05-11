<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'person';

    protected $fillable = [
        'name', 'federal_code', 'email', 'phone', 'photo', 'bio', 'site', 'use_free', 'distro_id', 'student_info_id', 'student_place', 'student_course', 'address_state', 'created_at', 'updated_at', 'removed_at'
    ];

}
