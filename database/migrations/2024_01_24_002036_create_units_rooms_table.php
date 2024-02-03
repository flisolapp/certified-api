<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'table_units_rooms' table.
 *
 * This migration class is responsible for setting up the 'table_units_rooms' table in the database.
 * The table is designed to store information about rooms within various units, linking them to specific
 * editions and units. It tracks room names, their order, and active status, providing a structured way
 * to organize and manage room details. The class includes methods for creating and dropping the table
 * as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'table_units_rooms' table.
     *
     * When invoked, this method sets up the structure of the 'table_units_rooms' table,
     * defining columns for the identification of rooms and their associations with units and editions.
     * It includes room names, order within the unit, and active status. Timestamps track the creation,
     * update, and removal of records. Indexes are created for efficient data retrieval and querying.
     */
    public function up(): void
    {
        Schema::create('units_rooms', function (Blueprint $table) {
            // Description of the 'table_units_rooms' table's purpose.
            $table->comment('Rooms of Unit');

            // Creating a unique identifier for each room record.
            $table->id()->comment('Identification');

            // Columns for linking rooms to editions and units.
            $table->unsignedBigInteger('edition_id')->comment('Identification of Edition');
            $table->foreign('edition_id')->references('id')->on('editions');
            $table->unsignedBigInteger('unit_id')->comment('Identification of Unit');
            $table->foreign('unit_id')->references('id')->on('units');

            // Columns for room details such as name, color and order.
            $table->string('name', 255)->comment('Name');
            $table->string('color', 20)->comment('Color');
            $table->string('order')->default(0)->comment('Order');

            // Column for active status of the room.
            $table->tinyInteger('active')->comment('Active');

            // Timestamps for tracking the creation, update, and removal of records.
            $table->timestamp('created_at')->nullable()->comment('When created');
            $table->timestamp('updated_at')->nullable()->comment('When updated');
            $table->timestamp('removed_at')->nullable()->comment('When removed');

            // Setting up indexes for efficient data retrieval.
            $table->index(['name'], 'table_units_rooms_name_index');
            $table->index(['order'], 'table_units_rooms_order_index');
            $table->index(['active'], 'units_schedules_active_index');
            $table->index(['removed_at'], 'units_schedules_removed_at_index');
        });
    }

    /**
     * Reverses the migration by removing the 'table_units_rooms' table.
     *
     * This method is executed during the rollback of the migration. It ensures the
     * removal of the 'table_units_rooms' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('units_rooms');
    }

};
