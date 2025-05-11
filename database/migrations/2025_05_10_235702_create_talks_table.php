<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('talks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edition_id');
            $table->string('title');
            $table->string('description');
            $table->string('shift');  // original type: char(1)
            $table->string('kind');  // original type: char(1)
            $table->unsignedBigInteger('talk_subject_id');
            $table->string('slide_file')->nullable();;
            $table->string('slide_url')->nullable();;
            $table->string('internal_note')->nullable();;
            $table->dateTime('audited_at')->nullable();;
            $table->string('audit_note')->nullable();;
            $table->boolean('approved')->nullable();;
            $table->dateTime('confirmed_at')->nullable();;
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('removed_at')->nullable();;
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('talks');
    }
};
