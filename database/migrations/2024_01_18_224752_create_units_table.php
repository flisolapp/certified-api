<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'units' table.
 *
 * This migration is responsible for setting up the 'units' table in the database.
 * The table is designed to store information about various units, including their names,
 * acronyms, addresses, and operational details, as well as their relationships to editions,
 * cities, states, and countries. It encompasses methods for creating and dropping the table
 * as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'units' table.
     *
     * This method sets up the structure of the 'units' table, defining columns for storing detailed
     * information about each unit, including location details and operational timings, and establishes
     * relationships with other entities. It also sets up indexes for efficient data retrieval.
     */
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            // Description of the 'units' table's purpose.
            $table->comment('Units');

            // Creating a unique identifier for each unit record.
            $table->id()->comment('Identification');

            // Column for linking units to editions.
            $table->unsignedBigInteger('edition_id')->comment('Identification of Edition');
            $table->foreign('edition_id')->references('id')->on('editions');

            // Columns for unit details such as name and acronym.
            $table->string('name', 80)->comment('Name');
            $table->string('acronym', 30)->comment('Acronym');

            // Columns for detailed address information.
            $table->string('address', 255)->nullable()->comment('Address');
            $table->string('address_neighborhood', 255)->nullable()->comment('Neighborhood of Address');
            $table->unsignedBigInteger('address_city_id')->nullable()->comment('Identification of City of Address');
            $table->foreign('address_city_id')->references('id')->on('cities');
            $table->string('address_city', 255)->nullable()->comment('City of Address');
            $table->unsignedBigInteger('address_state_id')->nullable()->comment('Identification of State of Address');
            $table->foreign('address_state_id')->references('id')->on('states');
            $table->string('address_state', 255)->nullable()->comment('State of Address');
            $table->unsignedBigInteger('address_country_id')->nullable()->comment('Identification of Country of Address');
            $table->foreign('address_country_id')->references('id')->on('countries');
            $table->string('address_country', 255)->nullable()->comment('Country of Address');
            $table->string('address_zipcode', 50)->nullable()->comment('ZIP Code of Address');
            $table->decimal('address_lat', 15, 10)->nullable()->comment('Latitude of Address');
            $table->decimal('address_lon', 15, 10)->nullable()->comment('Longitude of Address');
            $table->point('address_location')->nullable()->comment('Location of Address (for Spatial Analysis Functions)');

            // Column for active status of the unit.
            $table->tinyInteger('active')->comment('Active');

            // Timestamps for tracking the creation, update, and removal of records.
            $table->timestamp('created_at')->nullable()->comment('When created');
            $table->timestamp('updated_at')->nullable()->comment('When updated');
            $table->timestamp('removed_at')->nullable()->comment('When removed');

            // Setting up indexes for efficient data retrieval.
            $table->index(['name'], 'units_name_index');
            $table->index(['acronym'], 'units_acronym_index');
            $table->index(['address'], 'units_address_index');
            $table->index(['address_neighborhood'], 'units_address_neighborhood_index');
            $table->index(['address_city'], 'units_address_city_index');
            $table->index(['address_state'], 'units_address_state_index');
            $table->index(['address_country'], 'units_address_country_index');
            $table->index(['address_zipcode'], 'units_address_zipcode_index');
            $table->index(['address_lat'], 'units_address_lat_index');
            $table->index(['address_lon'], 'units_address_lon_index');
            $table->index(['address_location'], 'units_address_location_index');
            $table->index(['active'], 'units_active_index');
            $table->index(['removed_at'], 'units_removed_at_index');
        });
    }

    /**
     * Reverses the migration by removing the 'units' table.
     *
     * This method is executed during the rollback of the migration. It ensures the
     * removal of the 'units' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }

};
