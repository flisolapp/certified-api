<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('participant', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edition_id');
            $table->unsignedBigInteger('person_id');
            $table->date('presented_at');
            $table->date('prizedraw_confirmation_at');
            $table->date('prizedraw_winner_at');
            $table->unsignedBigInteger('prizedraw_order');
            $table->string('prizedraw_description');
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('removed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participant');
    }
};
