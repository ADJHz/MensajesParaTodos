<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mensajes_plataforma', function (Blueprint $table) {
            $table->string('audio_display_mode', 30)
                ->default('cover')
                ->after('audio_end');
            $table->text('audio_lyrics')
                ->nullable()
                ->after('audio_display_mode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mensajes_plataforma', function (Blueprint $table) {
            $table->dropColumn(['audio_display_mode', 'audio_lyrics']);
        });
    }
};
