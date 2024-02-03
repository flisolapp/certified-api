<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'collaboration_availabilities_i18n' table.
 *
 * This migration class is tasked with establishing the 'collaboration_availabilities_i18n' table
 * in the database. This table is designed to store internationalized information regarding
 * various collaboration availabilities. The class includes methods for creating and dropping
 * the table as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'collaboration_availabilities_i18n' table.
     *
     * When activated, this method sets up the structure of the 'collaboration_availabilities_i18n' table,
     * defining columns for multilingual availability information and creating necessary indexes for efficient data access.
     */
    public function up(): void
    {
        Schema::create('collaboration_availabilities_i18n', function (Blueprint $table) {
            // Description of the 'collaboration_availabilities_i18n' table's purpose.
            $table->comment('Internationalization of Availabilities of Collaboration');

            // Creating a unique identifier for each entry in the table.
            $table->id()->comment('Identification');

            // Linking to the 'collaboration_availabilities' table with a foreign key.
            $table->unsignedBigInteger('parent_id')->comment('Identification of Availability of Collaboration');
            $table->foreign('parent_id', 'collaboration_availabilities_i18n_ca_id_foreign')->references('id')->on('collaboration_availabilities');

            // Adding columns to specify the language and the internationalized value.
            $table->string('language', 10)->comment('Language');
            $table->string('value', 255)->comment('Value');

            // Setting up indexes for efficient data retrieval.
            $table->index(['language'], 'collaboration_availabilities_i18n_language_index');
            $table->index(['value'], 'collaboration_availabilities_i18n_value_index');
        });
    }

    /**
     * Reverses the migration by removing the 'collaboration_availabilities_i18n' table.
     *
     * This method is invoked during the rollback of the migration. It takes care of
     * deleting the 'collaboration_availabilities_i18n' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaboration_availabilities_i18n');
    }

};
