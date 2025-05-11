<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collaborators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edition_id');
            $table->unsignedBigInteger('person_id');
            $table->dateTime('audited_at')->nullable();
            $table->string('audit_note')->nullable();
            $table->unsignedBigInteger('approved')->nullable();
            $table->dateTime('confirmed_at')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('removed_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collaborators');
    }
};
