<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'collaborators_availabilities' table.
 *
 * This migration class is responsible for setting up the 'collaborators_availabilities' table in the database.
 * The table is designed to store information about the availabilities of collaborators, linking them to
 * specific collaboration availabilities. This association helps in organizing and managing the availability
 * status of each collaborator. The class includes methods for creating and dropping the table as part of
 * the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'collaborators_availabilities' table.
     *
     * When invoked, this method sets up the structure of the 'collaborators_availabilities' table,
     * defining columns for the identification of collaborators and their associated availabilities.
     * It includes timestamps for tracking the creation, update, and removal of these associations and
     * sets up indexes for efficient data retrieval.
     */
    public function up(): void
    {
        Schema::create('collaborators_availabilities', function (Blueprint $table) {
            // Description of the 'collaborators_availabilities' table's purpose.
            $table->comment('Areas of Collaborators');

            // Creating a unique identifier for each record.
            $table->id()->comment('Identification');

            // Columns for linking to the 'collaborators' and 'collaboration_availabilities' tables.
            $table->unsignedBigInteger('collaborator_id')->comment('Identification of Collaborator');
            $table->foreign('collaborator_id')->references('id')->on('collaborators');
            $table->unsignedBigInteger('collaboration_availability_id')->comment('Identification of Availability of Collaboration');
            $table->foreign('collaboration_availability_id', 'collaborators_availabilities_ca_id_foreign')->references('id')->on('collaboration_availabilities');

            // Timestamps for tracking the creation, update, and removal of records.
            $table->timestamp('created_at')->nullable()->comment('When created');
            $table->timestamp('updated_at')->nullable()->comment('When updated');
            $table->timestamp('removed_at')->nullable()->comment('When removed');

            // Setting up an index on the 'removed_at' column for efficient data retrieval.
            $table->index(['removed_at'], 'collaborators_availabilities_removed_at_index');
        });
    }

    /**
     * Reverses the migration by removing the 'collaborators_availabilities' table.
     *
     * This method is executed during the rollback of the migration. It ensures the
     * removal of the 'collaborators_availabilities' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaborators_availabilities');
    }

};
