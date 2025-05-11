<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW vw_participants AS
            SELECT
                e.year AS year,
                pt.id AS participant_id,
                p.id AS person_id,
                p.name AS name,
                p.email AS email,
                p.phone AS phone,
                pt.presented_at AS presented_at
            FROM participants pt
            JOIN persons p ON pt.person_id = p.id
            JOIN editions e ON e.id = pt.edition_id
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vw_participants");
    }
};
