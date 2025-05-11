<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('person_certificates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('edition_id');
            $table->unsignedBigInteger('organizer_id');
            $table->unsignedBigInteger('collaborator_id');
            $table->unsignedBigInteger('talk_id');
            $table->unsignedBigInteger('participant_id');
            $table->string('name');
            $table->string('federal_code')->nullable();;
            $table->string('code');
            $table->boolean('name_only');
            $table->dateTime('sent_at')->nullable();;
            $table->dateTime('last_view_at')->nullable();;
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('removed_at')->nullable();;
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('person_certificates');
    }
};
