<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('edition', function (Blueprint $table) {
            $table->id();
            $table->string('year');  // original type: char(4)
            $table->string('options');
            $table->unsignedBigInteger('active');
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('removed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('edition');
    }
};
