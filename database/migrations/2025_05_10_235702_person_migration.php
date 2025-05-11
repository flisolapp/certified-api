<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('person', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('federal_code');
            $table->string('email');
            $table->string('phone');
            $table->string('photo');
            $table->string('bio');
            $table->string('site');
            $table->unsignedBigInteger('use_free');
            $table->unsignedBigInteger('distro_id');
            $table->unsignedBigInteger('student_info_id');
            $table->string('student_place');
            $table->string('student_course');
            $table->string('address_state');  // original type: char(2)
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('removed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('person');
    }
};
