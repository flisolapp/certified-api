<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW vw_talk AS
            SELECT
                e.year,
                ts.name AS talk_subject,
                t.id AS talk_id,
                t.title,
                t.description,
                CASE t.shift
                    WHEN 'M' THEN 'Manhã'
                    ELSE 'Tarde'
                END AS shift,
                CASE t.kind
                    WHEN 'O' THEN 'Oficina'
                    ELSE 'Palestra'
                END AS kind,
                p.id AS person_id,
                p.name,
                p.email,
                p.phone
            FROM talks t
            JOIN talk_subjects ts ON ts.id = t.talk_subject_id
            JOIN speaker_talks st ON st.talk_id = t.id
            JOIN persons p ON p.id = st.speaker_id
            JOIN editions e ON e.id = t.edition_id
            WHERE t.id <> 35
              AND t.removed_at IS NULL
            ORDER BY e.year DESC, ts.name ASC, t.title ASC
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vw_talk");
    }
};
