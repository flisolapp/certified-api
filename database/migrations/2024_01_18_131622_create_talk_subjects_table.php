<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'talk_subjects' table.
 *
 * This migration class is tasked with establishing the 'talk_subjects' table in the database.
 * The table is designed to store various subjects or topics of talks and discussions.
 * It includes methods for creating and removing the table, forming an essential part of the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'talk_subjects' table.
     *
     * When activated, this method sets up the structure of the 'talk_subjects' table,
     * defining columns for storing talk or discussion subjects and creating an index for efficient data retrieval.
     */
    public function up(): void
    {
        Schema::create('talk_subjects', function (Blueprint $table) {
            // Description of the 'talk_subjects' table's purpose.
            $table->comment('Subjects of Talk');

            // Creating a unique identifier for each entry in the table.
            $table->id()->comment('Identification');

            // Adding a column to store the subject or topic of the talk.
            $table->string('value', 255)->comment('Value');

            // Setting up an index on the 'value' column, named 'talk_subjects_value_index', for optimized search performance.
            $table->index(['value'], 'talk_subjects_value_index');
        });
    }

    /**
     * Reverses the migration by removing the 'talk_subjects' table.
     *
     * This method is executed during the rollback of the migration. It takes care of
     * deleting the 'talk_subjects' table from the database, reversing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('talk_subjects');
    }

};
