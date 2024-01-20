<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'editions' table.
 *
 * This migration is responsible for setting up the 'editions' table in the database.
 * The table is designed to store information about different editions, such as year of the edition
 * and its active status. It includes methods for creating and dropping the table as part of
 * the database migration process.
 */
return new class extends Migration {

    /**
     * Runs the migration to create the 'editions' table.
     *
     * This method is executed when the migration is invoked. It sets up the
     * structure of the 'editions' table, specifying columns for storing edition details
     * like year and active status, and setting up indexes for efficient data retrieval.
     */
    public function up(): void
    {
        Schema::create('editions', function (Blueprint $table) {
            // Description of the 'editions' table's purpose.
            $table->comment('Editions');

            // Creating a unique identifier for each edition record.
            $table->id()->comment('Identification');

            // Adding columns for the year of the edition and its active status.
            $table->char('year', 4)->comment('Year');
            $table->tinyInteger('active')->comment('Active');

            // Timestamps for tracking the creation, update, and removal of records.
            $table->timestamp('created_at')->nullable()->comment('When created');
            $table->timestamp('updated_at')->nullable()->comment('When updated');
            $table->timestamp('removed_at')->nullable()->comment('When removed');

            // Setting up indexes for efficient data retrieval.
            $table->index(['year'], 'editions_year_index');
            $table->index(['active'], 'editions_active_index');
            $table->index(['removed_at'], 'editions_removed_at_index');
        });
    }

    /**
     * Reverses the migration by removing the 'editions' table.
     *
     * This method is executed during the rollback of the migration. It ensures the
     * removal of the 'editions' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('editions');
    }

};
