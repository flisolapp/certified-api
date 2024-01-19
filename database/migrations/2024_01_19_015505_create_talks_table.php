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
        Schema::create('talks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edition_id');
            $table->foreign('edition_id')->references('id')->on('editions');
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->unsignedBigInteger('talk_subject_id');
            $table->foreign('talk_subject_id')->references('id')->on('talk_subjects');
            $table->string('title', 80);
            $table->char('description');
            $table->unsignedBigInteger('shift_id');
            $table->foreign('shift_id')->references('id')->on('talk_shifts');
            $table->unsignedBigInteger('kind_id');
            $table->foreign('kind_id')->references('id')->on('talk_kinds');
            $table->string('slide_file', 255)->nullable();
            $table->string('slide_url', 255)->nullable();
            $table->text('internal_note')->nullable();
            $table->timestamp('audited_at')->nullable();
            $table->text('audit_note')->nullable();
            $table->tinyInteger('approved')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamps();
            $table->timestamp('removed_at')->nullable();
            $table->index(['title'], 'talks_title_index');
            $table->index(['audited_at'], 'talks_audited_at_index');
            $table->index(['approved'], 'talks_approved_index');
            $table->index(['confirmed_at'], 'talks_confirmed_at_index');
            $table->index(['removed_at'], 'talks_removed_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talks');
    }
};
