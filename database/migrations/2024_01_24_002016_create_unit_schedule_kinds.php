<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'unit_schedule_kinds' table.
 *
 * This migration class is responsible for establishing the 'unit_schedule_kinds' table in the database.
 * The table is designed to store different kinds of schedules associated with units. This classification
 * helps in organizing and categorizing the various types of schedules that can be assigned to a unit,
 * such as regular working hours, special event times, or maintenance periods. The table includes a
 * 'value' column to describe the kind of schedule. The class includes methods for creating and dropping
 * the table as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'unit_schedule_kinds' table.
     *
     * This method, when invoked, sets up the structure of the 'unit_schedule_kinds' table,
     * defining a column for storing the description (value) of each schedule kind. It also sets up an
     * index on the 'value' column for efficient data retrieval and querying.
     */
    public function up(): void
    {
        Schema::create('unit_schedule_kinds', function (Blueprint $table) {
            // Description of the 'unit_schedule_kinds' table's purpose.
            $table->comment('Kinds of Schedule of Unit');

            // Creating a unique identifier for each schedule kind record.
            $table->id()->comment('Identification');

            // Column for the description of the schedule kind.
            $table->string('value', 255)->comment('Value');

            // Setting up an index on the 'value' column for efficient data retrieval.
            $table->index(['value'], 'unit_schedule_kinds_value_index');
        });
    }

    /**
     * Reverses the migration by removing the 'unit_schedule_kinds' table.
     *
     * This method is executed during the rollback of the migration. It ensures the
     * removal of the 'unit_schedule_kinds' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_schedule_kinds');
    }

};
