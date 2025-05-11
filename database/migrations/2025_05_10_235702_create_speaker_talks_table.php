<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('speaker_talks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('speaker_id');
            $table->unsignedBigInteger('talk_id');
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('removed_at')->nullable();;
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('speaker_talks');
    }
};
