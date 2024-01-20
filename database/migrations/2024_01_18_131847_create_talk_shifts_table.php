<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'talk_shifts' table.
 *
 * This migration is responsible for setting up the 'talk_shifts' table in the database.
 * The table is intended to store different shifts or time slots of talks or discussions.
 * It includes methods for creating and dropping the table as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Runs the migration to create the 'talk_shifts' table.
     *
     * This method is executed when the migration is invoked. It establishes the
     * structure of the 'talk_shifts' table, specifying columns for storing talk shift details
     * and setting up an index for efficient data retrieval.
     */
    public function up(): void
    {
        Schema::create('talk_shifts', function (Blueprint $table) {
            // Description of the 'talk_shifts' table's purpose.
            $table->comment('Shifts of Talk');

            // Creating a unique identifier for each record in the table.
            $table->id()->comment('Identification');

            // Adding a column to store the shift or time slot of the talk.
            $table->string('value', 255)->comment('Value');

            // Setting up an index on the 'value' column, named 'talk_shifts_value_index', for optimized search performance.
            $table->index(['value'], 'talk_shifts_value_index');
        });
    }

    /**
     * Reverses the migration by removing the 'talk_shifts' table.
     *
     * This method is executed during the rollback of the migration. It takes care of
     * deleting the 'talk_shifts' table from the database, reversing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('talk_shifts');
    }

};
