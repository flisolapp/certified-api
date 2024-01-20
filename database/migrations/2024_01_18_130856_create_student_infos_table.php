<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and handling the 'student_infos' table.
 *
 * This migration is responsible for creating the 'student_infos' table in the database,
 * intended to store information about students in a format suitable for internationalization.
 * The class includes methods for creating and dropping the table, integral to the database
 * migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'student_infos' table.
     *
     * This method is invoked when the migration is executed and it sets up
     * the structure of the 'student_infos' table. It includes defining columns
     * for storing student information and setting up an index for efficient data retrieval.
     */
    public function up(): void
    {
        Schema::create('student_infos', function (Blueprint $table) {
            // Description of the 'student_infos' table purpose.
            $table->comment('Informations of Students');

            // Adding a unique identifier for each record in the table.
            $table->id()->comment('Identification');

            // Adding a column to store student information.
            $table->string('value', 255)->comment('Value');

            // Setting up an index on the 'value' column for better search performance.
            $table->index(['value'], 'student_infos_value_index');
        });
    }

    /**
     * Reverses the migration by removing the 'student_infos' table.
     *
     * This method is called when the migration needs to be rolled back. It takes care of
     * deleting the 'student_infos' table from the database, reversing the changes made.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_infos');
    }

};
