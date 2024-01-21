<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating the 'distros' table.
 *
 * This migration establishes a new table named 'distros' in the database,
 * dedicated to storing information about various open source distributions.
 * The class includes methods for both the creation and deletion of this table
 * as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'distros' table.
     *
     * This method is activated when the migration is executed. It outlines the
     * structure of the 'distros' table, including defining the necessary columns
     * and setting up an index for efficient data access.
     */
    public function up(): void
    {
        Schema::create('distros', function (Blueprint $table) {
            // Description of the 'distros' table purpose.
            $table->comment('Distributions');

            // Adding a unique identifier for each entry in the table.
            $table->id()->comment('Identification');

            // Adding a column to store the name of the distribution.
            $table->string('name', 80)->comment('Name');

            // Setting up an index on the 'name' column for optimized search performance.
            $table->index(['name'], 'distros_name_index');
        });
    }

    /**
     * Reverses the migration by removing the 'distros' table.
     *
     * This method is executed when the migration needs to be rolled back. It ensures the
     * removal of the 'distros' table from the database, reversing the changes introduced.
     */
    public function down(): void
    {
        Schema::dropIfExists('distros');
    }

};
