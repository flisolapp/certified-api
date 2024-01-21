<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'speakers' table.
 *
 * This migration class is responsible for establishing the 'speakers' table in the database,
 * which is intended to store information about individuals who serve as speakers at various events.
 * The table links each speaker to specific editions, units, talks, and personal profiles,
 * and it includes timestamps for various key events in the lifecycle of the record.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'speakers' table.
     *
     * This method, when invoked, sets up the structure of the 'speakers' table.
     * It defines columns for the identification of speakers, their association with editions, units,
     * and talks, along with timestamps for check-in, check-out, creation, updates, and removal.
     * Additionally, indexes are created for efficient data retrieval and querying.
     */
    public function up(): void
    {
        Schema::create('speakers', function (Blueprint $table) {
            // Description of the 'speakers' table's purpose.
            $table->comment('Speakers');

            // Creating a unique identifier for each speaker record.
            $table->id()->comment('Identification');

            // Columns for linking speakers to editions, units, and persons.
            $table->unsignedBigInteger('edition_id')->comment('Identification of Edition');
            $table->foreign('edition_id')->references('id')->on('editions');
            $table->unsignedBigInteger('unit_id')->comment('Identification of Unit');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->unsignedBigInteger('person_id')->comment('Identification of Person');
            $table->foreign('person_id')->references('id')->on('persons');

            // Column for linking speakers to specific talks.
            $table->unsignedBigInteger('talk_id')->comment('Identification of Talk');
            $table->foreign('talk_id')->references('id')->on('talks');

            // Timestamps for check-in and check-out events.
            $table->timestamp('checkin_at')->nullable()->comment('When check-in was done');
            $table->timestamp('checkout_at')->nullable()->comment('When check-out was done');

            // Timestamps for tracking the creation, update, and removal of records.
            $table->timestamp('created_at')->nullable()->comment('When created');
            $table->timestamp('updated_at')->nullable()->comment('When updated');
            $table->timestamp('removed_at')->nullable()->comment('When removed');

            // Setting up an index on the 'removed_at' column for efficient data retrieval.
            $table->index(['removed_at'], 'speakers_removed_at_index');
        });
    }

    /**
     * Reverses the migration by removing the 'speakers' table.
     *
     * This method is executed during the rollback of the migration. It ensures the
     * removal of the 'speakers' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('speakers');
    }

};
