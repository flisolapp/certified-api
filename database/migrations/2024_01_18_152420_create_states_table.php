<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'states' table.
 *
 * This migration is responsible for establishing the 'states' table in the database.
 * The table is designed to store information about states, including their names, codes,
 * geographical data, and timestamps for creation, updates, and removal. It also includes
 * a relationship with the 'countries' table. The class encompasses methods for creating
 * and dropping the table as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Runs the migration to create the 'states' table.
     *
     * This method is executed when the migration is invoked. It sets up the
     * structure of the 'states' table, specifying columns for storing state information,
     * geographical coordinates, and timestamps, along with setting up indexes for efficient data retrieval.
     */
    public function up(): void
    {
        Schema::create('states', function (Blueprint $table) {
            // Description of the 'states' table's purpose.
            $table->comment('States');

            // Creating a unique identifier for each state.
            $table->id()->comment('Identification');

            // Linking to the 'countries' table with a foreign key.
            $table->unsignedBigInteger('country_id')->comment('Identification of Country');
            $table->foreign('country_id')->references('id')->on('countries');

            // Adding columns for state name, code, and geographical data.
            $table->string('name', 255)->comment('Name');
            $table->string('code', 10)->nullable()->comment('Code');
            $table->decimal('lat', 15, 10)->nullable()->comment('Latitude');
            $table->decimal('lon', 15, 10)->nullable()->comment('Longitude');
            $table->point('location')->nullable()->comment('Location (for Spatial Analysis Functions)');

            // If the state has cities in the database.
            $table->tinyInteger('cities_found')->nullable()->comment('If the state has cities in the database');

            // Timestamps for tracking the creation, update, and removal of records.
            $table->timestamp('created_at')->nullable()->comment('When created');
            $table->timestamp('updated_at')->nullable()->comment('When updated');
            $table->timestamp('removed_at')->nullable()->comment('When removed');

            // Setting up indexes for efficient data retrieval.
            $table->index(['name'], 'states_name_index');
            $table->index(['code'], 'states_code_index');
            $table->index(['removed_at'], 'states_removed_at_index');
        });
    }

    /**
     * Reverses the migration by removing the 'states' table.
     *
     * This method is executed during the rollback of the migration. It takes care of
     * deleting the 'states' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }

};
