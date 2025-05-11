<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('person_certificate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('edition_id');
            $table->unsignedBigInteger('organizer_id');
            $table->unsignedBigInteger('collaborator_id');
            $table->unsignedBigInteger('talk_id');
            $table->unsignedBigInteger('participant_id');
            $table->string('name');
            $table->string('federal_code');
            $table->string('code');
            $table->unsignedBigInteger('name_only');
            $table->date('sent_at');
            $table->date('last_view_at');
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('removed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('person_certificate');
    }
};
