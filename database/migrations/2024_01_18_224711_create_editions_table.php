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
        Schema::create('editions', function (Blueprint $table) {
            $table->id();
            $table->char('year', 4);
            $table->tinyInteger('active');
            $table->timestamps();
            $table->timestamp('removed_at')->nullable();
            $table->index(['year'], 'editions_year_index');
            $table->index(['active'], 'editions_active_index');
            $table->index(['removed_at'], 'editions_removed_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('editions');
    }
};
