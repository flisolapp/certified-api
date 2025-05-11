<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('acronym');  // original type: char(2)
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('removed_at')->nullable();;
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
