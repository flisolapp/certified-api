<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'cities' table.
 *
 * This migration is responsible for setting up the 'cities' table in the database.
 * The table is designed to store information about cities, including their names,
 * geographical coordinates, and relationships with countries and states.
 * It includes methods for creating and dropping the table as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Runs the migration to create the 'cities' table.
     *
     * This method is executed when the migration is invoked. It sets up the
     * structure of the 'cities' table, specifying columns for storing city information,
     * geographical coordinates, and timestamps, along with setting up indexes for efficient data retrieval.
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            // Description of the 'cities' table's purpose.
            $table->comment('Cities');

            // Creating a unique identifier for each city.
            $table->id()->comment('Identification');

            // Linking to the 'countries' and 'states' tables with foreign keys.
            $table->unsignedBigInteger('country_id')->comment('Identification of Country');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->unsignedBigInteger('state_id')->comment('Identification of State');
            $table->foreign('state_id')->references('id')->on('states');

            // Adding columns for city name and geographical data.
            $table->string('name', 255)->comment('Name');
            $table->decimal('lat', 15, 10)->nullable()->comment('Latitude');
            $table->decimal('lon', 15, 10)->nullable()->comment('Longitude');
            $table->point('location')->nullable()->comment('Location (for Spatial Analysis Functions)');

            // Timestamps for tracking the creation, update, and removal of records.
            $table->timestamp('created_at')->nullable()->comment('When created');
            $table->timestamp('updated_at')->nullable()->comment('When updated');
            $table->timestamp('removed_at')->nullable()->comment('When removed');

            // Setting up indexes for efficient data retrieval.
            $table->index(['name'], 'cities_name_index');
            $table->index(['lat'], 'cities_lat_index');
            $table->index(['lon'], 'cities_lon_index');
            $table->index(['location'], 'cities_location_index');
            $table->index(['removed_at'], 'cities_removed_at_index');
        });
    }

    /**
     * Reverses the migration by removing the 'cities' table.
     *
     * This method is executed during the rollback of the migration. It takes care of
     * deleting the 'cities' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }

};
