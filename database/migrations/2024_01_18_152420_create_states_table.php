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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('name', 255);
            $table->string('code', 10)->nullable();
            $table->timestamps();
            $table->timestamp('removed_at')->nullable();
            $table->index(['name'], 'states_name_index');
            $table->index(['code'], 'states_code_index');
            $table->index(['removed_at'], 'states_removed_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
