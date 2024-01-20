<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'collaboration_areas' table.
 *
 * This migration class is tasked with setting up the 'collaboration_areas' table in the database.
 * The table is intended to store different areas of collaboration. It includes methods for
 * creating and removing the table, forming a crucial part of the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'collaboration_areas' table.
     *
     * When this method is executed, it defines the structure of the 'collaboration_areas' table.
     * This includes specifying columns for storing collaboration area details and indexing for enhanced performance.
     */
    public function up(): void
    {
        Schema::create('collaboration_areas', function (Blueprint $table) {
            // Description of the 'collaboration_areas' table's purpose.
            $table->comment('Areas of Collaboration');

            // Creating a unique identifier for each record in the table.
            $table->id()->comment('Identification');

            // Adding a column to store the name or value of the collaboration area.
            $table->string('value', 255)->comment('Value');

            // Setting up an index on the 'value' column, named 'collaboration_areas_value_index', for efficient data retrieval.
            $table->index(['value'], 'collaboration_areas_value_index');
        });
    }

    /**
     * Reverses the migration by removing the 'collaboration_areas' table.
     *
     * This method is invoked during the rollback of the migration. It ensures the
     * removal of the 'collaboration_areas' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaboration_areas');
    }

};
