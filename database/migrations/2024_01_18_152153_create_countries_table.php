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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->char('iso2', 2);
            $table->char('iso3', 3);
            $table->timestamps();
            $table->timestamp('removed_at')->nullable();
            $table->index(['name'], 'countries_name_index');
            $table->index(['iso2'], 'countries_iso2_index');
            $table->index(['iso3'], 'countries_iso3_index');
            $table->index(['removed_at'], 'countries_removed_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
