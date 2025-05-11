<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW vw_collaborators AS
            SELECT
                e.year AS year,
                p.name AS name,
                p.email AS email,
                p.phone AS phone,
                p.student_place AS student_place,
                (
                    SELECT GROUP_CONCAT(ca2.name SEPARATOR '; ')
                    FROM collaborator_areas ca
                    JOIN collaboration_areas ca2 ON ca.collaboration_area_id = ca2.id
                    WHERE ca.collaborator_id = c.id
                ) AS areas,
                (
                    SELECT GROUP_CONCAT(ca3.name SEPARATOR '; ')
                    FROM collaborator_availabilities ca1
                    JOIN collaboration_shifts ca3 ON ca1.collaborator_shift_id = ca3.id
                    WHERE ca1.collaborator_id = c.id
                ) AS availabilities
            FROM collaborators c
            JOIN people p ON p.id = c.people_id
            JOIN editions e ON e.id = c.edition_id
            ORDER BY e.year DESC, p.name ASC
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vw_collaborators");
    }
};
