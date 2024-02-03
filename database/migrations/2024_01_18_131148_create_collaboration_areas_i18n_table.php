<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'collaboration_areas_i18n' table.
 *
 * This migration class sets up the 'collaboration_areas_i18n' table in the database,
 * designed to store internationalized information about different collaboration areas.
 * It includes methods for both creating and deleting this table as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'collaboration_areas_i18n' table.
     *
     * When activated, this method establishes the structure of the 'collaboration_areas_i18n' table,
     * defining columns for storing multilingual details of collaboration areas and setting up indexes for efficient data access.
     */
    public function up(): void
    {
        Schema::create('collaboration_areas_i18n', function (Blueprint $table) {
            // Description of the 'collaboration_areas_i18n' table's purpose.
            $table->comment('Internationalization of Areas of Collaboration');

            // Creating a unique identifier for each entry in the table.
            $table->id()->comment('Identification');

            // Linking to the 'collaboration_areas' table with a foreign key.
            $table->unsignedBigInteger('parent_id')->comment('Identification of Area of Collaboration');
            $table->foreign('parent_id')->references('id')->on('collaboration_areas');

            // Adding columns to specify the language and the internationalized value.
            $table->string('language', 10)->comment('Language');
            $table->string('value', 255)->comment('Value');

            // Setting up indexes for efficient data retrieval.
            $table->index(['language'], 'collaboration_areas_i18n_language_index');
            $table->index(['value'], 'collaboration_areas_i18n_value_index');
        });
    }

    /**
     * Reverses the migration by removing the 'collaboration_areas_i18n' table.
     *
     * This method is invoked during the rollback of the migration. It ensures the
     * removal of the 'collaboration_areas_i18n' table from the database, undoing the setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaboration_areas_i18n');
    }

};
