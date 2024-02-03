<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'countries' table.
 *
 * This migration is responsible for setting up the 'countries' table in the database.
 * The table is intended to store information about countries, including names, ISO codes,
 * geographic coordinates, and timestamps for creation, updates, and removal.
 * It includes methods for creating and dropping the table as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Runs the migration to create the 'countries' table.
     *
     * This method is executed when the migration is invoked. It establishes the
     * structure of the 'countries' table, specifying columns for storing country information
     * and setting up indexes for efficient data retrieval.
     */
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            // Description of the 'countries' table's purpose.
            $table->comment('Countries');

            // Creating a unique identifier for each country.
            $table->id()->comment('Identification');

            // Adding columns for country name, ISO codes and phone code.
            $table->string('name', 255)->comment('Name');
            $table->char('iso2', 2)->nullable()->comment('ISO-2');
            $table->char('iso3', 3)->nullable()->comment('ISO-3');
            $table->char('phone_code', 255)->nullable()->comment('Phone Code');

            // Storing geographic coordinates and location for spatial analysis.
            $table->decimal('lat', 15, 10)->nullable()->comment('Latitude');
            $table->decimal('lon', 15, 10)->nullable()->comment('Longitude');
            $table->point('location')->nullable()->comment('Location (for Spatial Analysis Functions)');

            // Timestamps for tracking creation, updates, and removal of records.
            $table->timestamp('created_at')->nullable()->comment('When created');
            $table->timestamp('updated_at')->nullable()->comment('When updated');
            $table->timestamp('removed_at')->nullable()->comment('When removed');

            // Setting up indexes for efficient data retrieval.
            $table->index(['name'], 'countries_name_index');
            $table->index(['iso2'], 'countries_iso2_index');
            $table->index(['iso3'], 'countries_iso3_index');
            $table->index(['phone_code'], 'countries_phone_code_index');
            $table->index(['removed_at'], 'countries_removed_at_index');
        });
    }

    /**
     * Reverses the migration by removing the 'countries' table.
     *
     * This method is executed during the rollback of the migration. It takes care of
     * deleting the 'countries' table from the database, reversing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }

};
