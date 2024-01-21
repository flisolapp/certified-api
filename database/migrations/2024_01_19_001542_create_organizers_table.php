<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'organizers' table.
 *
 * This migration class is responsible for setting up the 'organizers' table in the database.
 * The table is designed to store information about organizers, linking them to specific editions
 * and units. It includes the personal identification of each organizer and contains methods for
 * creating and dropping the table as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'organizers' table.
     *
     * This method, when called, sets up the structure of the 'organizers' table,
     * defining columns for linking organizers to editions, units, and individuals,
     * and creating timestamps for tracking the creation, update, and removal of records.
     * It also sets up an index for efficient data retrieval.
     */
    public function up(): void
    {
        Schema::create('organizers', function (Blueprint $table) {
            // Description of the 'organizers' table's purpose.
            $table->comment('Organizers');

            // Creating a unique identifier for each organizer record.
            $table->id()->comment('Identification');

            // Columns for linking to the 'editions', 'units', and 'persons' tables.
            $table->unsignedBigInteger('edition_id')->comment('Identification of Edition');
            $table->foreign('edition_id')->references('id')->on('editions');
            $table->unsignedBigInteger('unit_id')->comment('Identification of Unit');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->unsignedBigInteger('person_id')->comment('Identification of Person');
            $table->foreign('person_id')->references('id')->on('persons');

            // Timestamps for tracking the creation, update, and removal of records.
            $table->timestamp('created_at')->nullable()->comment('When created');
            $table->timestamp('updated_at')->nullable()->comment('When updated');
            $table->timestamp('removed_at')->nullable()->comment('When removed');

            // Setting up an index on the 'removed_at' column for efficient data retrieval.
            $table->index(['removed_at'], 'organizers_removed_at_index');
        });
    }

    /**
     * Reverses the migration by removing the 'organizers' table.
     *
     * This method is executed during the rollback of the migration. It ensures the
     * removal of the 'organizers' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizers');
    }

};
