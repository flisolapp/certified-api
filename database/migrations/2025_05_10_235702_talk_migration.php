<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('talk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edition_id');
            $table->string('title');
            $table->string('description');
            $table->string('shift');  // original type: char(1)
            $table->string('kind');  // original type: char(1)
            $table->unsignedBigInteger('talk_subject_id');
            $table->string('slide_file');
            $table->string('slide_url');
            $table->string('internal_note');
            $table->date('audited_at');
            $table->string('audit_note');
            $table->unsignedBigInteger('approved');
            $table->date('confirmed_at');
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('removed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('talk');
    }
};
