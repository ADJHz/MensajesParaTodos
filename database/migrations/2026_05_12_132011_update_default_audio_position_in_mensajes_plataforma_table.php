<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE mensajes_plataforma ALTER COLUMN audio_pos_x SET DEFAULT 14");
        DB::statement("ALTER TABLE mensajes_plataforma ALTER COLUMN audio_pos_y SET DEFAULT 14");

        // MySQL compatibility path
        try {
            DB::statement("ALTER TABLE mensajes_plataforma MODIFY audio_pos_x TINYINT UNSIGNED NOT NULL DEFAULT 14");
            DB::statement("ALTER TABLE mensajes_plataforma MODIFY audio_pos_y TINYINT UNSIGNED NOT NULL DEFAULT 14");
        } catch (\Throwable $e) {
            // Ignore if the SQL dialect doesn't support MODIFY.
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE mensajes_plataforma ALTER COLUMN audio_pos_x SET DEFAULT 88");
        DB::statement("ALTER TABLE mensajes_plataforma ALTER COLUMN audio_pos_y SET DEFAULT 88");

        try {
            DB::statement("ALTER TABLE mensajes_plataforma MODIFY audio_pos_x TINYINT UNSIGNED NOT NULL DEFAULT 88");
            DB::statement("ALTER TABLE mensajes_plataforma MODIFY audio_pos_y TINYINT UNSIGNED NOT NULL DEFAULT 88");
        } catch (\Throwable $e) {
            // Ignore if the SQL dialect doesn't support MODIFY.
        }
    }
};
