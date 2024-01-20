<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'collaboration_availabilities' table.
 *
 * This migration class is responsible for setting up the 'collaboration_availabilities' table in the database.
 * The table is designed to store different states or conditions of availability for collaboration.
 * It includes methods for creating and dropping the table as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'collaboration_availabilities' table.
     *
     * When executed, this method establishes the structure of the 'collaboration_availabilities' table,
     * including defining columns for storing availability states and setting up an index for efficient data retrieval.
     */
    public function up(): void
    {
        Schema::create('collaboration_availabilities', function (Blueprint $table) {
            // Description of the 'collaboration_availabilities' table's purpose.
            $table->comment('Availabilities of Collaboration');

            // Creating a unique identifier for each record in the table.
            $table->id()->comment('Identification');

            // Adding a column to store the specific availability condition or state.
            $table->string('value', 255)->comment('Value');

            // Setting up an index on the 'value' column, named 'collaboration_availabilities_value_index', for optimized search performance.
            $table->index(['value'], 'collaboration_availabilities_value_index');
        });
    }

    /**
     * Reverses the migration by removing the 'collaboration_availabilities' table.
     *
     * This method is executed during a rollback of the migration. It takes care of
     * deleting the 'collaboration_availabilities' table from the database, reversing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaboration_availabilities');
    }

};
