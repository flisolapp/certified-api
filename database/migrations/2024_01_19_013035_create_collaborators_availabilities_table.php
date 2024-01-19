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
        Schema::create('collaborators_availabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collaborator_id');
            $table->foreign('collaborator_id')->references('id')->on('collaborators');
            $table->unsignedBigInteger('collaboration_availability_id');
            $table->foreign('collaboration_availability_id', 'collaborators_availabilities_ca_id_foreign')->references('id')->on('collaboration_availabilities');
            $table->timestamps();
            $table->timestamp('removed_at')->nullable();
            $table->index(['removed_at'], 'collaborators_availabilities_removed_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaborators_availabilities');
    }
};
