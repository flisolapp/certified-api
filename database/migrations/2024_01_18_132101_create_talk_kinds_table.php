<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'talk_kinds' table.
 *
 * This migration is responsible for establishing the 'talk_kinds' table in the database.
 * The table is designed to store different types or categories of talks or discussions.
 * It includes methods for creating and dropping the table as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Runs the migration to create the 'talk_kinds' table.
     *
     * This method is executed when the migration is invoked. It sets up the
     * structure of the 'talk_kinds' table, specifying columns for storing different kinds of talk
     * and setting up an index for efficient data retrieval.
     */
    public function up(): void
    {
        Schema::create('talk_kinds', function (Blueprint $table) {
            // Description of the 'talk_kinds' table's purpose.
            $table->comment('Kinds of Talk');

            // Creating a unique identifier for each record in the table.
            $table->id()->comment('Identification');

            // Adding a column to store the kind or category of the talk.
            $table->string('value', 255)->comment('Value');

            // Setting up an index on the 'value' column, named 'talk_kinds_value_index', for optimized search performance.
            $table->index(['value'], 'talk_kinds_value_index');
        });
    }

    /**
     * Reverses the migration by removing the 'talk_kinds' table.
     *
     * This method is executed during the rollback of the migration. It ensures the
     * removal of the 'talk_kinds' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('talk_kinds');
    }

};
