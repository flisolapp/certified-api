<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'countries_i18n' table.
 *
 * This migration is responsible for setting up the 'countries_i18n' table in the database.
 * The table is designed to store internationalized names of countries, facilitating multilingual support.
 * It includes methods for creating and dropping the table as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Runs the migration to create the 'countries_i18n' table.
     *
     * This method is executed when the migration is invoked. It establishes the
     * structure of the 'countries_i18n' table, specifying columns for storing internationalized
     * country names and language information, and setting up an index for efficient data retrieval.
     */
    public function up(): void
    {
        Schema::create('countries_i18n', function (Blueprint $table) {
            // Description of the 'countries_i18n' table's purpose.
            $table->comment('Internationalization of Countries');

            // Creating a unique identifier for each record in the table.
            $table->id()->comment('Identification');

            // Linking to the 'countries' table with a foreign key.
            $table->unsignedBigInteger('parent_id')->comment('Identification of Country');
            $table->foreign('parent_id')->references('id')->on('countries');

            // Adding columns to specify the language and the internationalized name.
            $table->string('language', 10)->comment('Language');
            $table->string('name', 255)->comment('Name');

            // Setting up an index on the 'name' column, named 'countries_i18n_name_index', for optimized search performance.
            $table->index(['name'], 'countries_i18n_name_index');
        });
    }

    /**
     * Reverses the migration by removing the 'countries_i18n' table.
     *
     * This method is executed during the rollback of the migration. It ensures the
     * removal of the 'countries_i18n' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries_i18n');
    }

};
