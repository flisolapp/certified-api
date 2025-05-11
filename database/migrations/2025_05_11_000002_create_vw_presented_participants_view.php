<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('
            CREATE OR REPLACE VIEW vw_presented_participants AS
            SELECT
                year,
                participant_id,
                people_id,
                name,
                email,
                phone,
                presented_at
            FROM vw_participants
            WHERE presented_at IS NOT NULL
        ');
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_presented_participants');
    }
};
