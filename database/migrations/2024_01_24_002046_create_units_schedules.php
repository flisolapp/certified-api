<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'units_schedules' table.
 *
 * This migration class is responsible for establishing the 'units_schedules' table in the database.
 * The table is designed to store schedule information related to various units, linking them to specific
 * editions. It tracks the start and end times of activities or events at these units, along with a
 * description of the schedule. The class includes methods for creating and dropping the table as part
 * of the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'units_schedules' table.
     *
     * When invoked, this method sets up the structure of the 'units_schedules' table,
     * defining columns for linking the schedules to specific editions and units,
     * and providing details like start time, end time, and description. It includes timestamps
     * for tracking the creation, update, and removal of records, and sets up indexes for efficient
     * data retrieval and querying.
     */
    public function up(): void
    {
        Schema::create('units_schedules', function (Blueprint $table) {
            $table->comment('Schedules of Unit');
            $table->id()->comment('Identification');
            $table->unsignedBigInteger('edition_id')->comment('Identification of Edition');
            $table->foreign('edition_id')->references('id')->on('editions');
            $table->unsignedBigInteger('unit_id')->comment('Identification of Unit');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->unsignedBigInteger('kind_id')->comment('Identification of Kind of Schedule of Unit');
            $table->foreign('kind_id')->references('id')->on('unit_schedule_kinds');
            $table->unsignedBigInteger('talk_id')->nullable()->comment('Identification of Talk');
            $table->foreign('talk_id')->references('id')->on('talks');
            $table->unsignedBigInteger('unit_room_id')->nullable()->comment('Identification of Room of Unit');
            $table->foreign('unit_room_id')->references('id')->on('units_rooms');
            $table->date('start_at')->nullable()->comment('It\'s started at');
            $table->time('end_at')->nullable()->comment('It\'s ended at');
            $table->string('color', 20)->nullable()->comment('Color');
            $table->tinyInteger('active')->comment('Active');
            $table->string('description')->nullable()->comment('Description');
            $table->timestamp('created_at')->nullable()->comment('When created');
            $table->timestamp('updated_at')->nullable()->comment('When updated');
            $table->timestamp('removed_at')->nullable()->comment('When removed');
            $table->index(['start_at'], 'units_schedules_start_at_index');
            $table->index(['end_at'], 'units_schedules_end_at_index');
            $table->index(['description'], 'units_schedules_description_index');
            $table->index(['active'], 'units_schedules_active_index');
            $table->index(['removed_at'], 'units_schedules_removed_at_index');
        });
    }

    /**
     * Reverses the migration by removing the 'units_schedules' table.
     *
     * This method is executed during the rollback of the migration. It takes care of
     * deleting the 'units_schedules' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('units_schedules');
    }

};
