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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edition_id');
            $table->foreign('edition_id')->references('id')->on('editions');
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')->references('id')->on('persons');
            $table->timestamp('checkin_at')->nullable();
            $table->timestamp('checkout_at')->nullable();
            $table->timestamp('created_at')->nullable()->comment('When this it\'s created');
            $table->timestamp('updated_at')->nullable()->comment('When this it\'s updated');
            $table->timestamp('removed_at')->nullable()->comment('When this it\'s removed');
            $table->index(['checkin_at'], 'participants_checkin_at_index');
            $table->index(['checkout_at'], 'participants_checkout_at_index');
            $table->index(['removed_at'], 'participants_removed_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
