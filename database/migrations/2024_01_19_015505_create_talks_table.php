<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'talks' table.
 *
 * This migration class is responsible for setting up the 'talks' table in the database.
 * The table is intended to store information about various talks or presentations delivered
 * during events. It includes linking talks to specific editions, units, subjects, shifts, and kinds.
 * Additionally, it tracks the talk's title, description, slide details, and approval status.
 * The class encompasses methods for creating and dropping the table as part of the database
 * migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'talks' table.
     *
     * When invoked, this method sets up the structure of the 'talks' table,
     * defining columns for the identification of talks and their associations with subjects,
     * shifts, and kinds, along with details like title, description, slide information, and audit notes.
     * Timestamps track the creation, update, and removal of records, as well as audit and approval status.
     * Indexes are created for efficient data retrieval and querying.
     */
    public function up(): void
    {
        Schema::create('talks', function (Blueprint $table) {
            // Description of the 'talks' table's purpose.
            $table->comment('Talks');

            // Creating a unique identifier for each talk record.
            $table->id()->comment('Identification');

            // Columns for linking talks to editions, units, and talk subjects.
            $table->unsignedBigInteger('edition_id')->comment('Identification of Edition');
            $table->foreign('edition_id')->references('id')->on('editions');
            $table->unsignedBigInteger('unit_id')->comment('Identification of Unit');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->unsignedBigInteger('talk_subject_id')->comment('Identification of Subject of Talk');
            $table->foreign('talk_subject_id')->references('id')->on('talk_subjects');

            // Columns for talk details such as title, description, and slides.
            $table->string('title', 80)->comment('Title');
            $table->text('description')->comment('Description');
            $table->string('slide_file', 255)->nullable()->comment('File of Slide');
            $table->string('slide_url', 255)->nullable()->comment('URL of Slide');

            // Additional columns for talk types and internal notes.
            $table->unsignedBigInteger('talk_shift_id')->comment('Identification of Shift of Talk');
            $table->foreign('talk_shift_id')->references('id')->on('talk_shifts');
            $table->unsignedBigInteger('talk_kind_id')->comment('Identification of Kind of Talk');
            $table->foreign('talk_kind_id')->references('id')->on('talk_kinds');
            $table->text('internal_note')->nullable()->comment('Internal Note');

            // Timestamps for audit details, approval status, and confirmation.
            $table->timestamp('audited_at')->nullable()->comment('When audited');
            $table->text('audit_note')->nullable()->comment('Notes of audit');
            $table->tinyInteger('approved')->nullable()->comment('Approved status');
            $table->timestamp('confirmed_at')->nullable()->comment('When confirmed');

            // Timestamps for tracking the creation, update, and removal of records.
            $table->timestamp('created_at')->nullable()->comment('When created');
            $table->timestamp('updated_at')->nullable()->comment('When updated');
            $table->timestamp('removed_at')->nullable()->comment('When removed');

            // Setting up indexes for efficient data retrieval.
            $table->index(['title'], 'talks_title_index');
            $table->index(['audited_at'], 'talks_audited_at_index');
            $table->index(['approved'], 'talks_approved_index');
            $table->index(['confirmed_at'], 'talks_confirmed_at_index');
            $table->index(['removed_at'], 'talks_removed_at_index');
        });
    }

    /**
     * Reverses the migration by removing the 'talks' table.
     *
     * This method is executed during the rollback of the migration. It ensures the
     * removal of the 'talks' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('talks');
    }

};
