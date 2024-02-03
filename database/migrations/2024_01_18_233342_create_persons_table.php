<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating and managing the 'persons' table.
 *
 * This migration class is responsible for establishing the 'persons' table in the database,
 * intended to store detailed information about individuals. It covers a wide range of data,
 * including personal details, contact information, addresses, and relational links to other
 * tables such as countries, states, cities, and more. The class includes methods for creating
 * and dropping the table as part of the database migration process.
 */
return new class extends Migration {

    /**
     * Executes the migration to create the 'persons' table.
     *
     * This method, when invoked, sets up the structure of the 'persons' table,
     * defining columns for various types of information and creating indexes for
     * efficient data retrieval and querying.
     */
    public function up(): void
    {
        Schema::create('persons', function (Blueprint $table) {
            // Description of the 'persons' table's purpose.
            $table->comment('Persons');

            // Creating a unique identifier for each person.
            $table->id()->comment('Identification');

            // Columns for relational links to other tables, including self-referencing.
            $table->unsignedBigInteger('parent_id')->nullable()->comment('Identification of Parent');
            $table->foreign('parent_id')->references('id')->on('persons');

            // Columns for personal information such as name and federal code.
            $table->string('name', 80)->comment('Name');
            $table->string('federal_code', 50)->nullable()->comment('Federal Code');

            // Contact information columns including email, password and phone number.
            $table->string('email', 150)->nullable()->unique()->comment('E-mail');
            $table->timestamp('email_verified_at')->nullable()->comment('When e-mail was verified');
            $table->string('password', 60)->nullable()->comment('Password');
            $table->unsignedBigInteger('phone_country_id')->nullable()->comment('Identification of Country of Phone');
            $table->foreign('phone_country_id')->references('id')->on('countries');
            $table->string('phone_code', 10)->nullable()->comment('Phone Code');
            $table->string('phone', 40)->nullable()->comment('Phone');

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

            // Geographical data columns for spatial analysis.
            $table->decimal('address_lat', 15, 10)->nullable()->comment('Latitude of Address');
            $table->decimal('address_lon', 15, 10)->nullable()->comment('Longitude of Address');
            $table->point('address_location')->nullable()->comment('Location of Address (for Spatial Analysis Functions)');

            // Columns for additional personal details like photo, bio, and website.
            $table->string('photo', 255)->nullable()->comment('Photo');
            $table->text('bio')->nullable()->comment('Biography');
            $table->string('site', 255)->nullable()->comment('Site');
            $table->tinyInteger('use_free')->comment('Use free softwares?');
            $table->unsignedBigInteger('distro_id')->nullable()->comment('Identification of Distribution');
            $table->foreign('distro_id')->references('id')->on('distros');
            $table->unsignedBigInteger('student_info_id')->nullable()->comment('Identification of Information of Student');
            $table->foreign('student_info_id')->references('id')->on('student_infos');
            $table->string('student_place', 255)->nullable()->comment('Place of Student');
            $table->string('student_course', 255)->nullable()->comment('Place of Course');

            $table->tinyInteger('active')->nullable()->comment('Active');

            // Timestamps for tracking the creation, update, and removal of records.
            $table->timestamp('created_at')->nullable()->comment('When created');
            $table->timestamp('updated_at')->nullable()->comment('When updated');
            $table->timestamp('removed_at')->nullable()->comment('When removed');

            // Setting up indexes for efficient data retrieval.
            $table->index(['name'], 'persons_name_index');
            $table->index(['federal_code'], 'persons_federal_code_index');
            $table->index(['email'], 'persons_email_index');
            $table->index(['email_verified_at'], 'persons_email_verified_at_index');
            $table->index(['phone_code'], 'persons_phone_code_index');
            $table->index(['phone'], 'persons_phone_index');
            $table->index(['address'], 'persons_address_index');
            $table->index(['address_neighborhood'], 'persons_address_neighborhood_index');
            $table->index(['address_city'], 'persons_address_city_index');
            $table->index(['address_state'], 'persons_address_state_index');
            $table->index(['address_country'], 'persons_address_country_index');
            $table->index(['address_zipcode'], 'persons_address_zipcode_index');
            $table->index(['address_lat'], 'persons_address_lat_index');
            $table->index(['address_lon'], 'persons_address_lon_index');
            $table->index(['address_location'], 'persons_address_location_index');
            $table->index(['site'], 'persons_site_index');
            $table->index(['use_free'], 'persons_use_free_index');
            $table->index(['student_place'], 'persons_student_place_index');
            $table->index(['student_course'], 'persons_student_course_index');
            $table->index(['active'], 'persons_active_index');
            $table->index(['removed_at'], 'persons_removed_at_index');
        });
    }

    /**
     * Reverses the migration by removing the 'persons' table.
     *
     * This method is called when the migration needs to be rolled back. It handles
     * the removal of the 'persons' table from the database, undoing the changes made in the up() method.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }

};
