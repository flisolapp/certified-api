<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'person_certificates' table.
 *
 * This migration class is responsible for establishing the 'person_certificates' table in the database.
 * The table is designed to store information about certificates awarded to individuals in various roles,
 * such as participants, speakers, organizers, or collaborators. It links to multiple tables representing
 * different roles and tracks certificate details including names, codes, and viewing history. The class
 * includes methods for creating and dropping the table as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'person_certificates' table.
     *
     * When invoked, this method sets up the structure of the 'person_certificates' table,
     * defining columns for the identification of certificates and their associations with persons,
     * organizers, collaborators, speakers, and participants. It includes timestamps for tracking
     * the creation, update, and removal of records, as well as the last viewing date of the certificate.
     * Indexes are created for efficient data retrieval and querying.
     */
    public function up(): void
    {
        Schema::create('person_certificates', function (Blueprint $table) {
            // Description of the 'person_certificates' table's purpose.
            $table->comment('Certificates of Person');

            // Creating a unique identifier for each certificate record.
            $table->id()->comment('Identification');

            // Columns for linking certificates to editions, units, and persons.
            $table->unsignedBigInteger('edition_id')->comment('Identification of Edition');
            $table->foreign('edition_id')->references('id')->on('editions');
            $table->unsignedBigInteger('unit_id')->comment('Identification of Unit');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->unsignedBigInteger('person_id')->comment('Identification of Person');
            $table->foreign('person_id')->references('id')->on('persons');

            // Additional columns for linking to organizers, collaborators, speakers, and participants.
            $table->unsignedBigInteger('organizer_id')->comment('Identification of Organizer');
            $table->foreign('organizer_id')->references('id')->on('organizers');
            $table->unsignedBigInteger('collaborator_id')->comment('Identification of Collaborator');
            $table->foreign('collaborator_id')->references('id')->on('collaborators');
            $table->unsignedBigInteger('speaker_id')->comment('Identification of Speaker');
            $table->foreign('speaker_id')->references('id')->on('speakers');
            $table->unsignedBigInteger('participant_id')->comment('Identification of Participant');
            $table->foreign('participant_id')->references('id')->on('participants');

            // Columns for certificate details such as name, federal code, and unique code.
            $table->string('name', 80)->comment('Name');
            $table->string('federal_code', 50)->nullable()->comment('Federal Code');
            $table->string('code', 20)->nullable()->comment('Code');

            // Timestamp for tracking the last viewing date of the certificate.
            $table->timestamp('last_view_at')->nullable()->comment('The last time it was viewed');

            // Timestamps for tracking the creation, update, and removal of records.
            $table->timestamp('created_at')->nullable()->comment('When created');
            $table->timestamp('updated_at')->nullable()->comment('When updated');
            $table->timestamp('removed_at')->nullable()->comment('When removed');

            // Setting up indexes for efficient data retrieval.
            $table->index(['name'], 'person_certificates_name_index');
            $table->index(['federal_code'], 'person_certificates_federal_code_index');
            $table->index(['code'], 'person_certificates_code_index');
            $table->index(['last_view_at'], 'person_certificates_last_view_at_index');
            $table->index(['removed_at'], 'person_certificates_removed_at_index');
        });
    }

    /**
     * Reverses the migration by removing the 'person_certificates' table.
     *
     * This method is executed during the rollback of the migration. It ensures the
     * removal of the 'person_certificates' table from the database, undoing the initial setup.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_certificates');
    }

};
