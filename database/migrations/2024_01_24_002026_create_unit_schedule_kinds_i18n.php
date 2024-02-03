<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'unit_schedule_kinds_i18n' table.
 *
 * This migration class is responsible for setting up the 'unit_schedule_kinds_i18n' table in the database.
 * The table is designed to store internationalization (i18n) data for the various kinds of schedules associated
 * with units, allowing for the storage of schedule kinds in multiple languages. This enhances the accessibility
 * and usability of the system across different regions and languages. The table links to the 'unit_schedule_kinds'
 * table and includes columns for language and value (translated text). The class includes methods for creating
 * and dropping the table as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'unit_schedule_kinds_i18n' table.
     *
     * When invoked, this method sets up the structure of the 'unit_schedule_kinds_i18n' table,
     * defining columns for the internationalization of schedule kinds. It includes a reference to
     * the 'unit_schedule_kinds' table, language specification, and the translated value. Indexes
     * are created for efficient data retrieval based on language and value.
     */
    public function up(): void
    {
        Schema::create('unit_schedule_kinds_i18n', function (Blueprint $table) {
            // Description of the 'unit_schedule_kinds_i18n' table's purpose.
            $table->comment('Internationalization of Kinds of Schedule of Unit');

            // Creating a unique identifier for each internationalization record.
            $table->id()->comment('Identification');

            // Column for linking to the 'unit_schedule_kinds' table.
            $table->unsignedBigInteger('parent_id')->comment('Identification of Kinds of Schedule of Unit');
            $table->foreign('parent_id')->references('id')->on('unit_schedule_kinds');

            // Columns for specifying the language and the translated value.
            $table->string('language', 10)->comment('Language');
            $table->string('value', 255)->comment('Value');

            // Setting up indexes for efficient data retrieval.
            $table->index(['language'], 'unit_schedule_kinds_i18n_language_index');
            $table->index(['value'], 'unit_schedule_kinds_i18n_value_index');
        });
    }

    /**
     * Reverses the migration by removing the 'unit_schedule_kinds_i18n' table.
     *
     * This method is executed during the rollback of the migration. It ensures the
     * removal of the 'unit_schedule_kinds_i18n' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_schedule_kinds_i18n');
    }

};
