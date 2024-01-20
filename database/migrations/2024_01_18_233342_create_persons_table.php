<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('responsible_id')->nullable();
            $table->foreign('responsible_id')->references('id')->on('persons');
            $table->string('name', 80);
            $table->string('federal_code', 50);
            $table->string('email', 150);
            $table->string('phone', 40);
            $table->string('address', 255)->nullable();
            $table->string('address_neighborhood', 255)->nullable();
            $table->unsignedBigInteger('address_city_id')->nullable();
            $table->foreign('address_city_id')->references('id')->on('cities');
            $table->string('address_city', 255)->nullable();
            $table->unsignedBigInteger('address_state_id')->nullable();
            $table->foreign('address_state_id')->references('id')->on('states');
            $table->string('address_state', 255)->nullable();
            $table->unsignedBigInteger('address_country_id')->nullable();
            $table->foreign('address_country_id')->references('id')->on('countries');
            $table->string('address_country', 255)->nullable();
            $table->string('photo', 255)->nullable();
            $table->text('bio')->nullable();
            $table->string('site', 255)->nullable();
            $table->tinyInteger('use_free');
            $table->unsignedBigInteger('distro_id')->nullable();
            $table->foreign('distro_id')->references('id')->on('distros');
            $table->unsignedBigInteger('student_info_id')->nullable();
            $table->foreign('student_info_id')->references('id')->on('student_infos');
            $table->string('student_place', 255)->nullable();
            $table->string('student_course', 255)->nullable();
            $table->timestamp('created_at')->nullable()->comment('When this it\'s created');
            $table->timestamp('updated_at')->nullable()->comment('When this it\'s updated');
            $table->timestamp('removed_at')->nullable()->comment('When this it\'s removed');
            $table->index(['name'], 'persons_name_index');
            $table->index(['federal_code'], 'persons_federal_code_index');
            $table->index(['email'], 'persons_email_index');
            $table->index(['phone'], 'persons_phone_index');
            $table->index(['address'], 'persons_address_index');
            $table->index(['address_neighborhood'], 'persons_address_neighborhood_index');
            $table->index(['address_city'], 'persons_address_city_index');
            $table->index(['address_state'], 'persons_address_state_index');
            $table->index(['address_country'], 'persons_address_country_index');
            $table->index(['site'], 'persons_site_index');
            $table->index(['use_free'], 'persons_use_free_index');
            $table->index(['student_place'], 'persons_student_place_index');
            $table->index(['student_course'], 'persons_student_course_index');
            $table->index(['removed_at'], 'persons_removed_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
