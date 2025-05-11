<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edition_id');
            $table->unsignedBigInteger('people_id');
            $table->timestamp('presented_at')->nullable();
            $table->timestamp('prizedraw_confirmation_at')->nullable();
            $table->timestamp('prizedraw_winner_at')->nullable();
            $table->unsignedBigInteger('prizedraw_order')->nullable();
            $table->string('prizedraw_description')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->timestamp('removed_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
