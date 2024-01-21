<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'collaborators' table.
 *
 * This migration class is responsible for establishing the 'collaborators' table in the database,
 * intended to store information about individuals who collaborate in various capacities.
 * It includes linking collaborators to specific editions and units, and tracks their audit status,
 * approval status, check-in, and check-out times. The class includes methods for creating and
 * dropping the table as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'collaborators' table.
     *
     * This method, when invoked, sets up the structure of the 'collaborators' table,
     * defining columns for the identification of collaborators, their relationships with editions
     * and units, audit details, and timestamps for various states including creation, updates, and removal.
     * It also sets up indexes for efficient data retrieval and querying.
     */
    public function up(): void
    {
        Schema::create('collaborators', function (Blueprint $table) {
            // Description of the 'collaborators' table's purpose.
            $table->comment('Collaborators');

            // Creating a unique identifier for each collaborator record.
            $table->id()->comment('Identification');

            // Columns for linking to the 'editions' and 'units' tables.
            $table->unsignedBigInteger('edition_id')->comment('Identification of Edition');
            $table->foreign('edition_id')->references('id')->on('editions');
            $table->unsignedBigInteger('unit_id')->comment('Identification of Unit');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->unsignedBigInteger('person_id')->comment('Identification of Person');
            $table->foreign('person_id')->references('id')->on('persons');

            // Columns for audit details and approval status.
            $table->timestamp('audited_at')->nullable()->comment('When audited');
            $table->text('audit_note')->nullable()->comment('Notes of audit');
            $table->tinyInteger('approved')->nullable()->comment('Approved status');

            // Timestamps for check-in and check-out.
            $table->timestamp('checkin_at')->nullable()->comment('When check-in was done');
            $table->timestamp('checkout_at')->nullable()->comment('When check-out was done');

            // Timestamps for tracking the creation, update, and removal of records.
            $table->timestamp('created_at')->nullable()->comment('When created');
            $table->timestamp('updated_at')->nullable()->comment('When updated');
            $table->timestamp('removed_at')->nullable()->comment('When removed');

            // Setting up indexes for efficient data retrieval.
            $table->index(['audited_at'], 'collaborators_audited_at_index');
            $table->index(['approved'], 'collaborators_approved_index');
            $table->index(['checkin_at'], 'collaborators_checkin_at_index');
            $table->index(['checkout_at'], 'collaborators_checkout_at_index');
            $table->index(['removed_at'], 'collaborators_removed_at_index');
        });
    }

    /**
     * Reverses the migration by removing the 'collaborators' table.
     *
     * This method is executed during the rollback of the migration. It takes care of
     * deleting the 'collaborators' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaborators');
    }

};
