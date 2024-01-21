<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'participants' table.
 *
 * This migration class is responsible for establishing the 'participants' table in the database.
 * The table is intended to store information about individuals who participate in various events,
 * linking them to specific editions, units, and their personal profiles. It tracks the check-in and
 * check-out times of participants and includes timestamps for the creation, update, and removal of records.
 * Indexes are created for efficient data retrieval, particularly for check-in, check-out, and removal times.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'participants' table.
     *
     * When invoked, this method sets up the structure of the 'participants' table,
     * defining columns for linking participants to editions, units, and persons, and
     * creating timestamps for various key events. It also includes indexes for efficient
     * data retrieval and querying.
     */
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            // Description of the 'participants' table's purpose.
            $table->comment('Participants');

            // Creating a unique identifier for each participant record.
            $table->id()->comment('Identification');

            // Columns for linking participants to editions, units, and persons.
            $table->unsignedBigInteger('edition_id')->comment('Identification of Edition');
            $table->foreign('edition_id')->references('id')->on('editions');
            $table->unsignedBigInteger('unit_id')->comment('Identification of Unit');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->unsignedBigInteger('person_id')->comment('Identification of Person');
            $table->foreign('person_id')->references('id')->on('persons');

            // Timestamps for check-in and check-out events.
            $table->timestamp('checkin_at')->nullable()->comment('When check-in was done');
            $table->timestamp('checkout_at')->nullable()->comment('When check-out was done');

            // Timestamps for tracking the creation, update, and removal of records.
            $table->timestamp('created_at')->nullable()->comment('When created');
            $table->timestamp('updated_at')->nullable()->comment('When updated');
            $table->timestamp('removed_at')->nullable()->comment('When removed');

            // Setting up indexes for efficient data retrieval.
            $table->index(['checkin_at'], 'participants_checkin_at_index');
            $table->index(['checkout_at'], 'participants_checkout_at_index');
            $table->index(['removed_at'], 'participants_removed_at_index');
        });
    }

    /**
     * Reverses the migration by removing the 'participants' table.
     *
     * This method is executed during the rollback of the migration. It takes care of
     * deleting the 'participants' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }

};
