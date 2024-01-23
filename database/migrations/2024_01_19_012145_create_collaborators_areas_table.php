<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'collaborators_areas' table.
 *
 * This migration class is responsible for establishing the 'collaborators_areas' table in the database.
 * The table is intended to store information about the specific areas of collaboration for each collaborator,
 * linking them to both the collaborators and the collaboration areas. It includes timestamps for the creation,
 * update, and removal of records. The class encompasses methods for creating and dropping the table
 * as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'collaborators_areas' table.
     *
     * When invoked, this method sets up the structure of the 'collaborators_areas' table,
     * defining columns for the identification of collaborators and their associated areas of collaboration.
     * It includes timestamps for tracking the creation, update, and removal of these associations and
     * sets up indexes for efficient data retrieval.
     */
    public function up(): void
    {
        Schema::create('collaborators_areas', function (Blueprint $table) {
            // Description of the 'collaborators_areas' table's purpose.
            $table->comment('Areas of Collaborators');

            // Creating a unique identifier for each record.
            $table->id()->comment('Identification');

            // Columns for linking to the 'collaborators' and 'collaboration_areas' tables.
            $table->unsignedBigInteger('collaborator_id')->comment('Identification of Collaborator');
            $table->foreign('collaborator_id')->references('id')->on('collaborators');
            $table->unsignedBigInteger('collaboration_area_id')->comment('Identification of Area of Collaboration');
            $table->foreign('collaboration_area_id')->references('id')->on('collaboration_areas');

            // Timestamps for tracking the creation, update, and removal of records.
            $table->timestamp('created_at')->nullable()->comment('When created');
            $table->timestamp('updated_at')->nullable()->comment('When updated');
            $table->timestamp('removed_at')->nullable()->comment('When removed');

            // Setting up an index on the 'removed_at' column for efficient data retrieval.
            $table->index(['removed_at'], 'collaborators_areas_removed_at_index');
        });
    }

    /**
     * Reverses the migration by removing the 'collaborators_areas' table.
     *
     * This method is executed during the rollback of the migration. It takes care of
     * deleting the 'collaborators_areas' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaborators_areas');
    }

};
