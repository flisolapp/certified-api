<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('person_certificates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edition_id');
            $table->foreign('edition_id')->references('id')->on('editions');
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')->references('id')->on('persons');
            $table->unsignedBigInteger('organizer_id');
            $table->foreign('organizer_id')->references('id')->on('organizers');
            $table->unsignedBigInteger('collaborator_id');
            $table->foreign('collaborator_id')->references('id')->on('collaborators');
            $table->unsignedBigInteger('speaker_id');
            $table->foreign('speaker_id')->references('id')->on('speakers');
            $table->unsignedBigInteger('participant_id');
            $table->foreign('participant_id')->references('id')->on('participants');
            $table->string('name', 80);
            $table->string('federal_code', 50)->nullable();
            $table->string('code', 20)->nullable();
            $table->timestamp('last_view_at')->nullable();
            $table->timestamps();
            $table->timestamp('removed_at')->nullable();
            $table->index(['name'], 'person_certificates_name_index');
            $table->index(['federal_code'], 'person_certificates_federal_code_index');
            $table->index(['code'], 'person_certificates_code_index');
            $table->index(['last_view_at'], 'person_certificates_last_view_at_index');
            $table->index(['removed_at'], 'person_certificates_removed_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_certificates');
    }
};
