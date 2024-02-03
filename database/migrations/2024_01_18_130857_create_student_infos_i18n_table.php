<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and handling the 'student_infos_i18n' table.
 *
 * This migration is focused on establishing the 'student_infos_i18n' table in the database,
 * designed for storing internationalized information associated with student records. It
 * includes functionalities to create and drop this table, integral to the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'student_infos_i18n' table.
     *
     * When activated, this method sets up the structure of the 'student_infos_i18n' table,
     * defining columns for storing multilingual student information and creating necessary indexes.
     */
    public function up(): void
    {
        Schema::create('student_infos_i18n', function (Blueprint $table) {
            // Description of the 'student_infos_i18n' table's purpose.
            $table->comment('Internationalization of Information of Students');

            // Adding a unique identifier for each record.
            $table->id()->comment('Identification');

            // Linking to the 'student_infos' table with a foreign key.
            $table->unsignedBigInteger('parent_id')->comment('Identification of Information of Student');
            $table->foreign('parent_id')->references('id')->on('student_infos');

            // Adding columns for specifying the language and the translated information.
            $table->string('language', 10)->comment('Language');
            $table->string('value', 255)->comment('Value');

            // Setting up indexes for efficient data retrieval.
            $table->index(['language'], 'student_infos_i18n_language_index');
            $table->index(['value'], 'student_infos_i18n_value_index');
        });
    }

    /**
     * Reverses the migration by removing the 'student_infos_i18n' table.
     *
     * This method is executed during a rollback of the migration. It takes care of
     * deleting the 'student_infos_i18n' table from the database, reversing the setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_infos_i18n');
    }

};
