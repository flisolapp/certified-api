<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('collaborator_availabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collaborator_id');
            $table->unsignedBigInteger('collaborator_shift_id');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->timestamp('removed_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collaborator_availabilities');
    }
};
