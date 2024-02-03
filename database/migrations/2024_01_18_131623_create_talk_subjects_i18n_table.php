<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'talk_subjects_i18n' table.
 *
 * This migration is responsible for setting up the 'talk_subjects_i18n' table in the database.
 * The table is intended to store internationalized subjects or topics of talks and discussions.
 * It includes methods for creating and dropping the table as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Runs the migration to create the 'talk_subjects_i18n' table.
     *
     * This method is executed when the migration is invoked. It establishes the
     * structure of the 'talk_subjects_i18n' table, specifying columns for storing
     * multilingual talk subjects and setting up indexes for efficient data retrieval.
     */
    public function up(): void
    {
        Schema::create('talk_subjects_i18n', function (Blueprint $table) {
            // Description of the 'talk_subjects_i18n' table's purpose.
            $table->comment('Internationalization of Subjects of Talk');

            // Creating a unique identifier for each record.
            $table->id()->comment('Identification');

            // Linking to the 'talk_subjects' table with a foreign key.
            $table->unsignedBigInteger('parent_id')->comment('Identification of Subject of Talk');
            $table->foreign('parent_id')->references('id')->on('talk_subjects');

            // Adding columns to specify the language and the internationalized value.
            $table->string('language', 10)->comment('Language');
            $table->string('value', 255)->comment('Value');

            // Setting up indexes for efficient data retrieval.
            $table->index(['language'], 'talk_subjects_i18n_language_index');
            $table->index(['value'], 'talk_subjects_i18n_value_index');
        });
    }

    /**
     * Reverses the migration by removing the 'talk_subjects_i18n' table.
     *
     * This method is executed during the rollback of the migration, ensuring the
     * removal of the 'talk_subjects_i18n' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('talk_subjects_i18n');
    }

};
