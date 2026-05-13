<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE mensajes_plataforma ALTER COLUMN audio_pos_x SET DEFAULT 24");
        DB::statement("ALTER TABLE mensajes_plataforma ALTER COLUMN audio_pos_y SET DEFAULT 24");

        try {
            DB::statement("ALTER TABLE mensajes_plataforma MODIFY audio_pos_x TINYINT UNSIGNED NOT NULL DEFAULT 24");
            DB::statement("ALTER TABLE mensajes_plataforma MODIFY audio_pos_y TINYINT UNSIGNED NOT NULL DEFAULT 24");
        } catch (\Throwable $e) {
            // Ignore if SQL dialect doesn't support MODIFY.
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE mensajes_plataforma ALTER COLUMN audio_pos_x SET DEFAULT 22");
        DB::statement("ALTER TABLE mensajes_plataforma ALTER COLUMN audio_pos_y SET DEFAULT 20");

        try {
            DB::statement("ALTER TABLE mensajes_plataforma MODIFY audio_pos_x TINYINT UNSIGNED NOT NULL DEFAULT 22");
            DB::statement("ALTER TABLE mensajes_plataforma MODIFY audio_pos_y TINYINT UNSIGNED NOT NULL DEFAULT 20");
        } catch (\Throwable $e) {
            // Ignore if SQL dialect doesn't support MODIFY.
        }
    }
};
