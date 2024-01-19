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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edition_id');
            $table->foreign('edition_id')->references('id')->on('editions');
            $table->string('name', 80);
            $table->string('acronym', 30);
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
            $table->date('when_at')->nullable();
            $table->time('when_start_at')->nullable();
            $table->time('when_end_at')->nullable();
            $table->tinyInteger('active');
            $table->timestamps();
            $table->timestamp('removed_at')->nullable();
            $table->index(['name'], 'units_name_index');
            $table->index(['acronym'], 'units_acronym_index');
            $table->index(['address'], 'units_address_index');
            $table->index(['address_neighborhood'], 'units_address_neighborhood_index');
            $table->index(['address_city'], 'units_address_city_index');
            $table->index(['address_state'], 'units_address_state_index');
            $table->index(['address_country'], 'units_address_country_index');
            $table->index(['when_at'], 'units_when_at_index');
            $table->index(['when_start_at'], 'units_when_start_at_index');
            $table->index(['when_end_at'], 'units_when_end_at_index');
            $table->index(['active'], 'units_active_index');
            $table->index(['removed_at'], 'units_removed_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
